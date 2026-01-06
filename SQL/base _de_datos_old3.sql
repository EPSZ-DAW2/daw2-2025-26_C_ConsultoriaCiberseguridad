-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2026 a las 11:36:51
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `daw2_cybersec_manager`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1766737131),
('auditor', '2', 1766743766),
('cliente', '1', 1766742070),
('cliente', '3', 1766743766),
('cliente', '7', 1766748040),
('consultor', '4', 1766743766);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1766736841, 1766736841),
('auditor', 1, NULL, NULL, NULL, 1766736841, 1766736841),
('cliente', 1, NULL, NULL, NULL, 1766736840, 1766736840),
('consultor', 1, NULL, NULL, NULL, 1766736841, 1766736841),
('escribirCalendario', 2, 'Permiso exclusivo calendario', NULL, NULL, 1766736840, 1766736840),
('gestionarProyectos', 2, 'Crear proyectos y gestionar', NULL, NULL, 1766736840, 1766736840),
('subirDocs', 2, 'Subir documentación', NULL, NULL, 1766736840, 1766736840),
('verDocs', 2, 'Ver documentación sin borrar', NULL, NULL, 1766736840, 1766736840),
('verMisProyectos', 2, 'Ver Mis Proyectos y Formación', NULL, NULL, 1766736840, 1766736840),
('verPanel', 2, 'Entrar al panel de administración', NULL, NULL, 1766736840, 1766736840);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'auditor'),
('admin', 'cliente'),
('admin', 'consultor'),
('auditor', 'escribirCalendario'),
('auditor', 'verDocs'),
('auditor', 'verPanel'),
('cliente', 'verMisProyectos'),
('consultor', 'gestionarProyectos'),
('consultor', 'subirDocs'),
('consultor', 'verDocs'),
('consultor', 'verPanel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL COMMENT 'Nombre del curso (ej: "Concienciación Phishing")',
  `descripcion` text DEFAULT NULL COMMENT 'Descripción del contenido del curso',
  `imagen_portada` varchar(255) DEFAULT NULL COMMENT 'Ruta a la imagen de portada del curso o NULL si no tiene',
  `nota_minima_aprobado` decimal(4,2) NOT NULL DEFAULT 5.00 COMMENT 'Nota mínima para aprobar el cuestionario (ej: 5.00 sobre 10)',
  `activo` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Curso activo y disponible: 0=Inactivo, 1=Activo',
  `creado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'Usuario que creó el curso',
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `modificado_por` int(10) UNSIGNED DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cursos de formación e-learning en ciberseguridad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diapositivas`
--

CREATE TABLE `diapositivas` (
  `id` int(10) UNSIGNED NOT NULL,
  `curso_id` int(10) UNSIGNED NOT NULL COMMENT 'Curso al que pertenece (FK a cursos)',
  `numero_orden` int(10) UNSIGNED NOT NULL COMMENT 'Orden de la diapositiva (1, 2, 3, ...). Determina la secuencia.',
  `titulo` varchar(255) NOT NULL COMMENT 'Título de la diapositiva',
  `contenido_html` text DEFAULT NULL COMMENT 'Contenido explicativo en formato HTML o NULL si solo tiene multimedia',
  `imagen_url` varchar(255) DEFAULT NULL COMMENT 'Ruta a imagen/esquema explicativo o NULL si no tiene',
  `video_url` varchar(500) DEFAULT NULL COMMENT 'URL a video (YouTube, Vimeo, servidor propio) o NULL si no tiene',
  `creado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'Usuario que creó la diapositiva',
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `modificado_por` int(10) UNSIGNED DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Diapositivas/slides que componen cada curso';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `proyecto_id` int(10) UNSIGNED NOT NULL COMMENT 'Proyecto al que pertenece (FK a proyectos)',
  `nombre_archivo` varchar(255) NOT NULL COMMENT 'Nombre del archivo (ej: "Politica_Seguridad_v2.pdf")',
  `descripcion` text DEFAULT NULL COMMENT 'Descripción del contenido',
  `ruta_archivo` text NOT NULL COMMENT 'Ruta en el servidor donde se guarda el archivo',
  `tipo_documento` enum('Política','Procedimiento','Informe de Auditoría','Informe SOC','Plan de Acción','Certificado','Documentación Técnica','Otros') NOT NULL DEFAULT 'Otros' COMMENT 'Tipo de documento',
  `tamaño_bytes` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Tamaño del archivo en bytes',
  `version` varchar(20) DEFAULT '1.0' COMMENT 'Versión del documento',
  `visible_cliente` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Si el cliente puede verlo: 0=No, 1=Sí',
  `hash_verificacion` varchar(64) DEFAULT NULL COMMENT 'Hash SHA-256 para verificar integridad del archivo',
  `subido_por` int(10) UNSIGNED NOT NULL COMMENT 'Usuario que subió el documento (FK a usuarios)',
  `fecha_subida` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Cuándo se subió',
  `fecha_modificacion` datetime DEFAULT NULL COMMENT 'Si se modificó el archivo',
  `notas` text DEFAULT NULL COMMENT 'Notas adicionales sobre el documento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Documentos entregables de los proyectos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos_calendario`
--

CREATE TABLE `eventos_calendario` (
  `id` int(10) UNSIGNED NOT NULL,
  `proyecto_id` int(10) UNSIGNED NOT NULL COMMENT 'Proyecto relacionado (FK a proyectos)',
  `auditor_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Auditor responsable (FK a usuarios con rol=auditor)',
  `titulo` varchar(200) NOT NULL COMMENT 'Título del evento (ej: "Auditoría ISO 27001 - Fase 1")',
  `descripcion` text DEFAULT NULL COMMENT 'Descripción detallada',
  `fecha` date NOT NULL COMMENT 'Fecha del evento',
  `hora_inicio` time NOT NULL COMMENT 'Hora de inicio',
  `hora_fin` time DEFAULT NULL COMMENT 'Hora de finalización (puede no estar definida)',
  `tipo_evento` enum('Auditoría Interna','Auditoría de Certificación','Auditoría de Seguimiento','Reunión Cliente','Revisión Documental','Entrega Resultados','Otros') NOT NULL DEFAULT 'Otros' COMMENT 'Tipo de evento',
  `ubicacion` varchar(255) DEFAULT NULL COMMENT 'Lugar (dirección o "Virtual - Zoom")',
  `estado_evento` enum('Programado','Confirmado','En curso','Completado','Pospuesto','Cancelado') NOT NULL DEFAULT 'Programado' COMMENT 'Estado actual',
  `recordatorio_enviado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Si ya se envió recordatorio: 0=No, 1=Sí',
  `notas` text DEFAULT NULL COMMENT 'Notas adicionales',
  `creado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'Quién creó el evento',
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `modificado_por` int(10) UNSIGNED DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Calendario de eventos y auditorías';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL COMMENT 'Cliente que reporta (FK a usuarios con rol=cliente)',
  `analista_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Analista SOC asignado (FK a usuarios con rol=analista_soc)',
  `titulo` varchar(255) NOT NULL COMMENT 'Título breve de la incidencia',
  `descripcion` text NOT NULL COMMENT 'Descripción detallada del problema',
  `severidad` enum('Crítica','Alta','Media','Baja','Informativa') NOT NULL DEFAULT 'Media' COMMENT 'Nivel de severidad',
  `estado_incidencia` enum('Abierto','Asignado','En Análisis','En Contención','En Remediación','Resuelto','Cerrado','Falso Positivo') NOT NULL DEFAULT 'Abierto' COMMENT 'Estado actual',
  `categoria_incidencia` varchar(50) DEFAULT NULL COMMENT 'Categoría (malware, phishing, DDoS, etc.)',
  `fecha_reporte` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Cuándo se reportó',
  `fecha_asignacion` datetime DEFAULT NULL COMMENT 'Cuándo se asignó a un analista',
  `fecha_primera_respuesta` datetime DEFAULT NULL COMMENT 'Primera respuesta del analista',
  `fecha_resolucion` datetime DEFAULT NULL COMMENT 'Cuándo se resolvió',
  `tiempo_resolucion` int(10) UNSIGNED DEFAULT NULL COMMENT 'Minutos que tomó resolver (calculado)',
  `sla_cumplido` tinyint(1) DEFAULT NULL COMMENT 'Si se cumplió el SLA: 0=No, 1=Sí, NULL=No evaluado',
  `ip_origen` varchar(45) DEFAULT NULL COMMENT 'IP desde donde se detectó (IPv4 o IPv6)',
  `sistema_afectado` varchar(255) DEFAULT NULL COMMENT 'Sistema o servidor afectado',
  `acciones_tomadas` text DEFAULT NULL COMMENT 'Descripción de acciones realizadas',
  `notas_internas` text DEFAULT NULL COMMENT 'Notas del equipo SOC',
  `visible_cliente` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Si el cliente puede ver esta incidencia: 0=No, 1=Sí'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Sistema de ticketing SOC para incidencias de seguridad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1766693548),
('m140506_102106_rbac_init', 1766693551),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1766693552),
('m180523_151638_rbac_updates_indexes_without_prefix', 1766693552),
('m200409_110543_rbac_update_mssql_trigger', 1766693552);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_cuestionario`
--

CREATE TABLE `preguntas_cuestionario` (
  `id` int(10) UNSIGNED NOT NULL,
  `curso_id` int(10) UNSIGNED NOT NULL COMMENT 'Curso al que pertenece la pregunta (FK a cursos)',
  `enunciado_pregunta` text NOT NULL COMMENT 'Texto de la pregunta',
  `opcion_a` varchar(500) NOT NULL COMMENT 'Texto de la opción A',
  `opcion_b` varchar(500) NOT NULL COMMENT 'Texto de la opción B',
  `opcion_c` varchar(500) NOT NULL COMMENT 'Texto de la opción C',
  `opcion_correcta` enum('a','b','c') NOT NULL COMMENT 'Cuál es la respuesta correcta',
  `creado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'Usuario que creó la pregunta',
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `modificado_por` int(10) UNSIGNED DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Preguntas tipo test para evaluación de cursos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso_usuario`
--

CREATE TABLE `progreso_usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL COMMENT 'Cliente realizando el curso (FK a usuarios con rol=cliente)',
  `curso_id` int(10) UNSIGNED NOT NULL COMMENT 'Curso que está realizando (FK a cursos)',
  `diapositiva_actual` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Última diapositiva vista (número de orden)',
  `cuestionario_realizado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Si ya hizo el test final: 0=No, 1=Sí',
  `nota_obtenida` decimal(4,2) DEFAULT NULL COMMENT 'Nota del cuestionario (0-10) o NULL si no lo ha hecho',
  `fecha_inicio` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Cuándo empezó el curso',
  `fecha_fin` datetime DEFAULT NULL COMMENT 'Cuándo completó el curso (aprobó o suspendió)',
  `estado` enum('En curso','Aprobado','Suspenso') NOT NULL DEFAULT 'En curso' COMMENT 'Estado actual del progreso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Seguimiento del progreso individual de cada usuario en cada curso';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL COMMENT 'Nombre descriptivo (ej: "Implantación ENS para Empresa X")',
  `descripcion` text DEFAULT NULL COMMENT 'Descripción detallada del alcance',
  `cliente_id` int(10) UNSIGNED NOT NULL COMMENT 'ID del cliente que contrató (FK a usuarios con rol=cliente)',
  `servicio_id` int(10) UNSIGNED NOT NULL COMMENT 'ID del servicio contratado (FK a servicios)',
  `consultor_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del consultor asignado (FK a usuarios con rol=consultor)',
  `auditor_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del auditor asignado (FK a usuarios con rol=auditor)',
  `fecha_inicio` date NOT NULL COMMENT 'Fecha de inicio del proyecto',
  `fecha_fin_prevista` date DEFAULT NULL COMMENT 'Fecha estimada de finalización',
  `fecha_fin_real` date DEFAULT NULL COMMENT 'Fecha real de cierre (NULL si no ha finalizado)',
  `estado` enum('Planificación','En curso','En revisión','Finalizado','Cancelado','Suspendido') NOT NULL DEFAULT 'Planificación' COMMENT 'Estado actual del proyecto',
  `presupuesto` decimal(10,2) DEFAULT NULL COMMENT 'Presupuesto acordado en euros',
  `notas_internas` text DEFAULT NULL COMMENT 'Notas del equipo (no visibles para el cliente)',
  `creado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'Quién creó el proyecto',
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `modificado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'Quién lo modificó por última vez',
  `fecha_modificacion` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Proyectos contratados por clientes';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(200) NOT NULL COMMENT 'Nombre del servicio (ej: "Implantación ISO 27001")',
  `descripcion` text DEFAULT NULL COMMENT 'Descripción detallada del servicio',
  `categoria` enum('Gobernanza','Defensa','Auditoría') NOT NULL DEFAULT 'Gobernanza' COMMENT 'Categoría del servicio',
  `precio_base` decimal(10,2) DEFAULT NULL COMMENT 'Precio de referencia en euros (puede ser NULL si es variable)',
  `duracion_estimada` int(10) UNSIGNED DEFAULT NULL COMMENT 'Duración típica en días',
  `requiere_auditoria` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Si requiere auditoría posterior: 0=No, 1=Sí',
  `activo` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Visible en catálogo: 0=No, 1=Sí',
  `creado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del usuario que creó este servicio',
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Cuándo se creó',
  `modificado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del último usuario que lo modificó',
  `fecha_modificacion` datetime DEFAULT NULL ON UPDATE current_timestamp() COMMENT 'Última modificación'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Catálogo de servicios de ciberseguridad ofrecidos';

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `categoria`, `precio_base`, `duracion_estimada`, `requiere_auditoria`, `activo`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'Auditoría Web Básica', 'Análisis de vulnerabilidades OWASP Top 10 para sitios corporativos.', 'Auditoría', 450.00, 3, 1, 1, 1, '2026-01-02 10:35:52', NULL, NULL),
(2, 'Pentesting Interno', 'Simulación de ataque desde dentro de la red para verificar la seguridad de los endpoints.', 'Gobernanza', 1200.50, 7, 1, 1, 1, '2026-01-02 10:35:52', NULL, '2026-01-02 10:44:18'),
(3, 'Consultoría ISO 27001', 'Asesoramiento para la implantación de la normativa de seguridad de la información.', 'Gobernanza', 2500.00, 30, 0, 1, 1, '2026-01-02 10:35:52', NULL, '2026-01-02 10:44:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_presupuesto`
--

CREATE TABLE `solicitudes_presupuesto` (
  `id` int(10) UNSIGNED NOT NULL,
  `servicio_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Servicio de interés (FK a servicios), NULL si es consulta general',
  `nombre_contacto` varchar(150) NOT NULL COMMENT 'Nombre completo',
  `email_contacto` varchar(255) NOT NULL COMMENT 'Email para responder',
  `telefono_contacto` varchar(20) DEFAULT NULL COMMENT 'Teléfono (opcional)',
  `empresa` varchar(200) NOT NULL COMMENT 'Nombre de la empresa',
  `nif_cif` varchar(20) DEFAULT NULL COMMENT 'NIF/CIF fiscal (opcional)',
  `num_empleados` int(10) UNSIGNED DEFAULT NULL COMMENT 'Tamaño de la empresa',
  `sector_actividad` varchar(100) DEFAULT NULL COMMENT 'Sector (ej: Banca, Salud, Industrial)',
  `descripcion_necesidad` text NOT NULL COMMENT 'Qué necesita el cliente',
  `alcance_solicitado` text DEFAULT NULL COMMENT 'Alcance específico (opcional)',
  `presupuesto_estimado` decimal(10,2) DEFAULT NULL COMMENT 'Presupuesto máximo del cliente (opcional)',
  `fecha_inicio_deseada` date DEFAULT NULL COMMENT 'Cuándo desea empezar',
  `estado_solicitud` enum('Pendiente','En Revisión','Contactado','Presupuesto Enviado','Negociación','Contratado','Rechazado','Cancelado') NOT NULL DEFAULT 'Pendiente' COMMENT 'Estado del proceso comercial',
  `prioridad` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Prioridad: 1=Baja, 2=Media, 3=Alta, 4=Urgente',
  `fecha_solicitud` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Cuándo se recibió',
  `fecha_contacto` datetime DEFAULT NULL COMMENT 'Cuándo se contactó al cliente',
  `usuario_asignado_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Usuario de ventas asignado (FK a usuarios)',
  `notas_comerciales` text DEFAULT NULL COMMENT 'Notas del equipo de ventas',
  `origen_solicitud` varchar(50) NOT NULL DEFAULT 'Web' COMMENT 'Origen: Web, Teléfono, Email, Referido, Evento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Solicitudes de presupuesto desde la web pública';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'Correo electrónico único del usuario',
  `password` varchar(255) NOT NULL COMMENT 'Hash de la contraseña (usar bcrypt/Argon2)',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre del usuario',
  `apellidos` varchar(150) DEFAULT NULL COMMENT 'Apellidos del usuario',
  `rol` enum('invitado','cliente','consultor','auditor','analista_soc','admin') NOT NULL DEFAULT 'invitado' COMMENT 'Rol del usuario en el sistema RBAC',
  `empresa` varchar(200) DEFAULT NULL COMMENT 'Nombre de la empresa (solo para clientes)',
  `telefono` varchar(20) DEFAULT NULL COMMENT 'Teléfono de contacto',
  `direccion` text DEFAULT NULL COMMENT 'Dirección completa',
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de alta en el sistema',
  `ultimo_acceso` datetime DEFAULT NULL COMMENT 'Última vez que inició sesión',
  `intentos_acceso` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Contador de intentos fallidos de login',
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Si está bloqueado: 0=No, 1=Por intentos fallidos, 2=Por administrador',
  `fecha_bloqueo` datetime DEFAULT NULL COMMENT 'Cuándo se bloqueó la cuenta',
  `motivo_bloqueo` text DEFAULT NULL COMMENT 'Razón del bloqueo',
  `activo` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Usuario activo: 0=Inactivo, 1=Activo',
  `auth_key` varchar(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Usuarios del sistema con autenticación y control de roles';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `nombre`, `apellidos`, `rol`, `empresa`, `telefono`, `direccion`, `fecha_registro`, `ultimo_acceso`, `intentos_acceso`, `bloqueado`, `fecha_bloqueo`, `motivo_bloqueo`, `activo`, `auth_key`) VALUES
(1, 'admin@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Pedro', 'Admin', 'admin', NULL, NULL, NULL, '2025-12-26 10:41:09', NULL, 0, 0, NULL, NULL, 1, 'cIwcYPb9TnINim4_YhZ715O5PHhY7ei_'),
(2, 'auditor@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Estela', 'Auditora', 'auditor', 'Empresa Interna', NULL, NULL, '2025-12-26 11:09:25', NULL, 0, 0, NULL, NULL, 1, 'd605677f1938d8e599ad7659baaa6188'),
(3, 'cliente@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Ignacio', 'Cliente', 'cliente', 'Cliente S.L.', NULL, NULL, '2025-12-26 11:09:25', NULL, 0, 0, NULL, NULL, 1, '7bebcd29eedf811d20065f1cd17c08db'),
(4, 'consultor@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Jose', 'Consultor', 'consultor', 'Empresa Interna', NULL, NULL, '2025-12-26 11:09:25', NULL, 0, 0, NULL, NULL, 1, '624b20b9f12fe140cfebd39761912c1c'),
(5, 'invitado@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Marco', 'Invitado', 'invitado', 'Externa', NULL, NULL, '2025-12-26 11:09:25', NULL, 0, 0, NULL, NULL, 1, 'f95dda056831ec91385c2d01afcd0db8'),
(6, 'analistasoc@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Iris', 'Analista SOC', 'analista_soc', 'SOC 24/7', NULL, NULL, '2025-12-26 11:09:25', NULL, 0, 0, NULL, NULL, 1, 'fe28b3a15afe5fb6331b67813af64af1'),
(7, 'prueba@cibersec.com', '$2y$13$HOPt.sSvwbu.fHNrGxaaM.jGvjNwCDe/q5eT/PVoSkXK.z4RLU.Z.', 'prueba', NULL, 'invitado', NULL, NULL, NULL, '2025-12-26 12:20:39', NULL, 0, 0, NULL, NULL, 1, 'Lq5SZkO5XLxp4-UZauw4-K6gIKxdMIJB');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_activo` (`activo`),
  ADD KEY `fk_cursos_creador` (`creado_por`),
  ADD KEY `fk_cursos_modificador` (`modificado_por`);

--
-- Indices de la tabla `diapositivas`
--
ALTER TABLE `diapositivas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_curso` (`curso_id`),
  ADD KEY `idx_orden` (`curso_id`,`numero_orden`),
  ADD KEY `fk_diapositivas_creador` (`creado_por`),
  ADD KEY `fk_diapositivas_modificador` (`modificado_por`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_proyecto` (`proyecto_id`),
  ADD KEY `idx_tipo` (`tipo_documento`),
  ADD KEY `fk_documentos_usuario` (`subido_por`);

--
-- Indices de la tabla `eventos_calendario`
--
ALTER TABLE `eventos_calendario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_proyecto` (`proyecto_id`),
  ADD KEY `idx_fecha` (`fecha`),
  ADD KEY `idx_estado` (`estado_evento`),
  ADD KEY `fk_eventos_auditor` (`auditor_id`),
  ADD KEY `fk_eventos_creador` (`creado_por`),
  ADD KEY `fk_eventos_modificador` (`modificado_por`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cliente` (`cliente_id`),
  ADD KEY `idx_analista` (`analista_id`),
  ADD KEY `idx_severidad` (`severidad`),
  ADD KEY `idx_estado` (`estado_incidencia`),
  ADD KEY `idx_fecha` (`fecha_reporte`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `preguntas_cuestionario`
--
ALTER TABLE `preguntas_cuestionario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_curso` (`curso_id`),
  ADD KEY `fk_preguntas_creador` (`creado_por`),
  ADD KEY `fk_preguntas_modificador` (`modificado_por`);

--
-- Indices de la tabla `progreso_usuario`
--
ALTER TABLE `progreso_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_usuario_curso` (`usuario_id`,`curso_id`) COMMENT 'Un usuario solo puede tener un progreso activo por curso',
  ADD KEY `idx_usuario` (`usuario_id`),
  ADD KEY `idx_curso` (`curso_id`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cliente` (`cliente_id`),
  ADD KEY `idx_servicio` (`servicio_id`),
  ADD KEY `idx_estado` (`estado`),
  ADD KEY `fk_proyectos_consultor` (`consultor_id`),
  ADD KEY `fk_proyectos_auditor` (`auditor_id`),
  ADD KEY `fk_proyectos_creador` (`creado_por`),
  ADD KEY `fk_proyectos_modificador` (`modificado_por`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_categoria` (`categoria`),
  ADD KEY `idx_activo` (`activo`),
  ADD KEY `fk_servicios_creador` (`creado_por`),
  ADD KEY `fk_servicios_modificador` (`modificado_por`);

--
-- Indices de la tabla `solicitudes_presupuesto`
--
ALTER TABLE `solicitudes_presupuesto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_servicio` (`servicio_id`),
  ADD KEY `idx_estado` (`estado_solicitud`),
  ADD KEY `idx_fecha` (`fecha_solicitud`),
  ADD KEY `fk_solicitudes_usuario` (`usuario_asignado_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `idx_rol` (`rol`) COMMENT 'Índice para búsquedas por rol';

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `diapositivas`
--
ALTER TABLE `diapositivas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos_calendario`
--
ALTER TABLE `eventos_calendario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas_cuestionario`
--
ALTER TABLE `preguntas_cuestionario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `progreso_usuario`
--
ALTER TABLE `progreso_usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitudes_presupuesto`
--
ALTER TABLE `solicitudes_presupuesto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_cursos_creador` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cursos_modificador` FOREIGN KEY (`modificado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `diapositivas`
--
ALTER TABLE `diapositivas`
  ADD CONSTRAINT `fk_diapositivas_creador` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_diapositivas_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_diapositivas_modificador` FOREIGN KEY (`modificado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `fk_documentos_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_documentos_usuario` FOREIGN KEY (`subido_por`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `eventos_calendario`
--
ALTER TABLE `eventos_calendario`
  ADD CONSTRAINT `fk_eventos_auditor` FOREIGN KEY (`auditor_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eventos_creador` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eventos_modificador` FOREIGN KEY (`modificado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eventos_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `fk_incidencias_analista` FOREIGN KEY (`analista_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_incidencias_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `preguntas_cuestionario`
--
ALTER TABLE `preguntas_cuestionario`
  ADD CONSTRAINT `fk_preguntas_creador` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_preguntas_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_preguntas_modificador` FOREIGN KEY (`modificado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `progreso_usuario`
--
ALTER TABLE `progreso_usuario`
  ADD CONSTRAINT `fk_progreso_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_progreso_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `fk_proyectos_auditor` FOREIGN KEY (`auditor_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proyectos_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proyectos_consultor` FOREIGN KEY (`consultor_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proyectos_creador` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proyectos_modificador` FOREIGN KEY (`modificado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proyectos_servicio` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `fk_servicios_creador` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_servicios_modificador` FOREIGN KEY (`modificado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitudes_presupuesto`
--
ALTER TABLE `solicitudes_presupuesto`
  ADD CONSTRAINT `fk_solicitudes_servicio` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_solicitudes_usuario` FOREIGN KEY (`usuario_asignado_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
