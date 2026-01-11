-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2026 a las 12:44:15
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

CREATE DATABASE IF NOT EXISTS `daw2_cybersec_manager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `daw2_cybersec_manager`;

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
('admin', '1', 1707020813),
('analista_soc', '6', 1707020813),
('auditor', '2', 1707020813),
('cliente_admin', '9', 1707020813),
('cliente_user', '7', 1707020813),
('cliente_user', '8', 1707020813),
('comercial', '11', 1707020813),
('consultor', '4', 1707020813),
('manager', '10', 1707020813);

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
('admin', 1, NULL, NULL, NULL, 1707020746, 1707020746),
('analista_soc', 1, NULL, NULL, NULL, 1707020746, 1707020746),
('asignarRecursos', 2, 'Asignar consultores/auditores a proyectos', NULL, NULL, 1707020746, 1707020746),
('auditor', 1, NULL, NULL, NULL, 1707020746, 1707020746),
('cliente_admin', 1, NULL, NULL, NULL, 1707020746, 1707020746),
('cliente_user', 1, NULL, NULL, NULL, 1707020746, 1707020746),
('comercial', 1, NULL, NULL, NULL, 1707020746, 1707020746),
('consultor', 1, NULL, NULL, NULL, 1707020746, 1707020746),
('escribirCalendario', 2, 'Permiso exclusivo calendario', NULL, NULL, 1707020746, 1707020746),
('gestionarCatalogo', 2, 'Editar catálogo de servicios', NULL, NULL, 1707020746, 1707020746),
('gestionarCRM', 2, 'Gestionar clientes potenciales y leads', NULL, NULL, 1707020746, 1707020746),
('gestionarEmpresa', 2, 'Dashboard empresa y gestionar empleados', NULL, NULL, 1707020746, 1707020746),
('gestionarFormacion', 2, 'Gestionar cursos de formación y contenido educativo', NULL, NULL, 1707020746, 1707020746),
('gestionarProyectos', 2, 'Crear proyectos y gestionar', NULL, NULL, 1707020746, 1707020746),
('gestionarTickets', 2, 'Gestionar incidencias SOC', NULL, NULL, 1707020746, 1707020746),
('manager', 1, NULL, NULL, NULL, 1707020746, 1707020746),
('reportarIncidencia', 2, 'Crear tickets de incidencias', NULL, NULL, 1707020746, 1707020746),
('subirDocs', 2, 'Subir documentación', NULL, NULL, 1707020746, 1707020746),
('verCalendario', 2, 'Ver calendario de eventos', NULL, NULL, 1707020746, 1707020746),
('verDocs', 2, 'Ver documentación sin borrar', NULL, NULL, 1707020746, 1707020746),
('verFacturacion', 2, 'Ver facturas de la empresa', NULL, NULL, 1707020746, 1707020746),
('verMisCursos', 2, 'Acceder a formación asignada', NULL, NULL, 1707020746, 1707020746),
('verMisProyectos', 2, 'Ver Mis Proyectos y Formación', NULL, NULL, 1707020746, 1707020746),
('verMonitorizacion', 2, 'Ver dashboard SOC 24/7', NULL, NULL, 1707020746, 1707020746),
('verProyectos', 2, 'Ver proyectos (solo lectura)', NULL, NULL, 1707020746, 1707020746),
('verRentabilidad', 2, 'Ver métricas de rentabilidad y reportes', NULL, NULL, 1707020746, 1707020746);

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
('admin', 'analista_soc'),
('admin', 'auditor'),
('admin', 'cliente_admin'),
('admin', 'cliente_user'),
('admin', 'comercial'),
('admin', 'consultor'),
('admin', 'manager'),
('analista_soc', 'gestionarTickets'),
('analista_soc', 'verCalendario'),
('analista_soc', 'verMonitorizacion'),
('analista_soc', 'verProyectos'),
('auditor', 'escribirCalendario'),
('auditor', 'verCalendario'),
('auditor', 'verDocs'),
('auditor', 'verProyectos'),
('cliente_admin', 'gestionarEmpresa'),
('cliente_admin', 'reportarIncidencia'),
('cliente_admin', 'verFacturacion'),
('cliente_admin', 'verMisCursos'),
('cliente_admin', 'verMisProyectos'),
('cliente_user', 'reportarIncidencia'),
('cliente_user', 'verMisCursos'),
('comercial', 'escribirCalendario'),
('comercial', 'gestionarCatalogo'),
('comercial', 'gestionarCRM'),
('comercial', 'verCalendario'),
('comercial', 'verProyectos'),
('consultor', 'gestionarFormacion'),
('consultor', 'gestionarProyectos'),
('consultor', 'subirDocs'),
('consultor', 'verCalendario'),
('consultor', 'verDocs'),
('consultor', 'verProyectos'),
('manager', 'asignarRecursos'),
('manager', 'escribirCalendario'),
('manager', 'verCalendario'),
('manager', 'verDocs'),
('manager', 'verProyectos'),
('manager', 'verRentabilidad');

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
  `servicio_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del servicio de formación al que pertenece el curso (FK a servicios)',
  `nombre` varchar(200) NOT NULL COMMENT 'Nombre del curso (ej: "Concienciación Phishing")',
  `descripcion` text DEFAULT NULL COMMENT 'Descripción del contenido del curso',
  `video_url` varchar(255) DEFAULT NULL,
  `imagen_portada` varchar(255) DEFAULT NULL COMMENT 'Ruta a la imagen de portada del curso o NULL si no tiene',
  `nota_minima_aprobado` decimal(4,2) NOT NULL DEFAULT 5.00 COMMENT 'Nota mínima para aprobar el cuestionario (ej: 5.00 sobre 10)',
  `activo` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Curso activo y disponible: 0=Inactivo, 1=Activo',
  `creado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'Usuario que creó el curso',
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `modificado_por` int(10) UNSIGNED DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cursos de formación e-learning en ciberseguridad';

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `servicio_id`, `nombre`, `descripcion`, `video_url`, `imagen_portada`, `nota_minima_aprobado`, `activo`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 8, 'Introducción al Phishing', 'Aprende a identificar y protegerte de los ataques de suplantación de identidad. Este curso te enseñará los fundamentos del phishing, ejemplos reales y medidas de protección esenciales.', 'https://www.youtube.com/watch?v=iN4-rdfx3ZE', NULL, 7.00, 1, NULL, '2026-01-09 10:00:00', NULL, NULL);

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

--
-- Volcado de datos para la tabla `diapositivas`
--

INSERT INTO `diapositivas` (`id`, `curso_id`, `numero_orden`, `titulo`, `contenido_html`, `imagen_url`, `video_url`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 1, 1, '¿Qué es el Phishing?', '<p>El <strong>Phishing</strong> es una técnica de ciberdelincuencia que utiliza el fraude, el engaño y el timo para manipular a sus víctimas y hacer que revelen información personal confidencial.</p><ul><li>Suplantación de bancos</li><li>Correos falsos de RRHH</li><li>Premios inexistentes</li></ul>', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8f/Phishing_trusted_bank.svg/1200px-Phishing_trusted_bank.svg.png', NULL, NULL, '2026-01-09 10:00:00', NULL, NULL),
(2, 1, 2, 'Ejemplo en Video', '<p>Mira este video para entender cómo operan los cibercriminales en tiempo real.</p>', NULL, 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', NULL, '2026-01-09 10:00:00', NULL, NULL),
(3, 1, 3, 'Cómo protegerse', '<h3>Tips de Seguridad</h3><ol><li>Verifica siempre el remitente (@empresa.com no @gmail.com).</li><li>No hagas clic en enlaces sospechosos ("Tu cuenta ha sido bloqueada").</li><li>Activa el doble factor de autenticación (2FA).</li></ol><p>¡Estás listo para el examen!</p>', NULL, NULL, NULL, '2026-01-09 10:00:00', NULL, NULL);

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

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `cliente_id`, `analista_id`, `titulo`, `descripcion`, `severidad`, `estado_incidencia`, `categoria_incidencia`, `fecha_reporte`, `fecha_asignacion`, `fecha_primera_respuesta`, `fecha_resolucion`, `tiempo_resolucion`, `sla_cumplido`, `ip_origen`, `sistema_afectado`, `acciones_tomadas`, `notas_internas`, `visible_cliente`) VALUES
(1, 7, NULL, 'Correo sospechoso', 'Algo malo pasa', 'Media', 'Abierto', 'Phising', '2026-01-08 12:01:07', NULL, NULL, NULL, NULL, NULL, '192.100.1.230', 'Servidor web principla', NULL, NULL, 1);

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
('m130524_201442_init', 1767868578),
('m140506_102106_rbac_init', 1766693551),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1766693552),
('m180523_151638_rbac_updates_indexes_without_prefix', 1766693552),
('m190124_110200_add_verification_token_column_to_user_table', 1767868579),
('m200409_110543_rbac_update_mssql_trigger', 1766693552),
('m260105_000001_add_video_url_to_cursos_table', 1767868579),
('m260108_103409_add_recovery_email_column_to_usuarios_table', 1767868580),
('m260108_105433_add_totp_secret_column_to_usuarios_table', 1767869720);

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

--
-- Volcado de datos para la tabla `preguntas_cuestionario`
--

INSERT INTO `preguntas_cuestionario` (`id`, `curso_id`, `enunciado_pregunta`, `opcion_a`, `opcion_b`, `opcion_c`, `opcion_correcta`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 1, '¿Cuál de los siguientes es un indicio claro de Phishing?', 'El correo viene de @mibanco.com.', 'El correo tiene faltas de ortografía y mete urgencia ("¡Hazlo ya!").', 'El correo incluye mi nombre completo.', 'b', NULL, '2026-01-09 10:00:00', NULL, NULL),
(2, 1, 'Si recibo un correo sospechoso, ¿qué debo hacer?', 'Responder preguntando si es real.', 'Hacer clic en el enlace para verificar.', 'Contactar a la entidad por otro medio oficial y borrar el correo.', 'c', NULL, '2026-01-09 10:00:00', NULL, NULL),
(3, 1, '¿Qué significa el candado verde en el navegador?', 'Que el sitio es 100% legítimo y seguro.', 'Que la conexión está cifrada, pero el sitio podría ser fraudulento.', 'Que Google ha verificado la empresa.', 'b', NULL, '2026-01-09 10:00:00', NULL, NULL);

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
  `categoria` enum('Consultoría','Ciberseguridad','Formación') NOT NULL DEFAULT 'Ciberseguridad' COMMENT 'Categoría del servicio',
  `precio_base` decimal(10,2) DEFAULT NULL COMMENT 'Precio de referencia en euros (puede ser NULL si es variable)',
  `duracion_estimada` int(10) UNSIGNED DEFAULT NULL COMMENT 'Duración típica en días',
  `requiere_auditoria` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Si requiere auditoría posterior: 0=No, 1=Sí',
  `activo` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Visible en catálogo: 0=No, 1=Sí',
  `Mas_informacion` text NOT NULL,
  `creado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del usuario que creó este servicio',
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Cuándo se creó',
  `modificado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del último usuario que lo modificó',
  `fecha_modificacion` datetime DEFAULT NULL ON UPDATE current_timestamp() COMMENT 'Última modificación'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Catálogo de servicios de ciberseguridad ofrecidos';

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `categoria`, `precio_base`, `duracion_estimada`, `requiere_auditoria`, `activo`, `Mas_informacion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'Implantación y Auditoría ISO 27001', 'Acompañamiento integral para el diseño SGSI, analisis de riesgos y preparación para la certificación oficial', 'Ciberseguridad', 14500.00, 6, 1, 1, 'Se cobra por hitos (30% inicio, 40% mitad y 30% fin)\r\nPagas por (Política de seguridad, análisis de riesgos, declaración de aplicabilidad, plan de tratamiento de riesgos e informe de auditoría interna) que te permitan certificarte.', NULL, '2026-01-02 21:53:10', NULL, '2026-01-04 14:35:52'),
(2, 'Adecuación al Esquema Nacional de Seguridad', 'Adaptación de sistemas para el cumplinento con el RD311/2022 para administraciones publicas y proveedores', 'Consultoría', 18000.00, 12, 1, 1, 'Pagas por cumplir la ley (Acta de categorización del sistema, declaración de aplicabilidad, politica de seguridad, informe de insuficiencia, plan de adecuación e informe de auditoría de conformidad)', NULL, '2026-01-02 21:55:32', NULL, '2026-01-04 14:35:05'),
(3, 'Monitorización y respuestas a incidentes', 'Vigilancia continua de activos digitales mediante SIEM y analistas de nivel 1 y 2 para detectar intrusiones en tiempo real', 'Ciberseguridad', 30000.00, 12, 0, 1, 'Pagas por tranquilidad y visibilidad mediante Acceso a Dashboard de seguridad en tiempo real, notificación de incidentes criticos, informe mensual ejecutivos de amenzasa bloqueadas y reunión trimestral de seguimiento de seguridad.', NULL, '2026-01-02 21:59:15', NULL, '2026-01-04 14:34:45'),
(4, 'Gestión de vulnerabilidades', 'Escaneo periodicos automatizados para detectar fallos de seguridad en servidores y aplicaciones web antes que los atacantes', 'Ciberseguridad', 5400.00, 12, 0, 1, 'Pagas por saber donde tienes las brechas de seguridad antes que los hacker mediante Informe tecnicos de vulnerabilidades, guía de remediación para el equipo de IT, resumen ejecutivo de riesgos tecnológicos y certificado de escaneo trimestral.', NULL, '2026-01-02 22:01:10', NULL, '2026-01-04 14:34:26'),
(5, 'Campaña de phishing simulado', 'Envio controlado de correos trampa a empleados para medir el nivel de riesgo humano y educar en la detención de fraudes ', 'Formación', 11400.00, 12, 0, 1, 'Pagas por medir y educar a tus empleados mediante informe de tasas de click y apertura de correos, listado de usuarios comprometidos, pildora formativa de refuerzo y diploma de participación en la campaña.', NULL, '2026-01-02 22:03:23', NULL, '2026-01-04 14:33:45'),
(6, 'Curso de concienciación general', 'Formación fundamental sobre higiene digital: contraseñas robustas, deteción de ingeniería social, protección del puesto de trabajo y cumplimiento básico de protección de datos', 'Formación', 36.00, 12, 0, 1, 'Pagas por el certificado nominal de superación, manual de buenas practicas de ciberhigiene, decálogo de cumplimiento RGPD para imprimir y checklist de puesto de trabajo seguro. ', NULL, '2026-01-02 22:06:44', NULL, '2026-01-04 14:46:11'),
(7, 'Ciberseguridad para diretivos', 'Seminiario ejecutivo sobre gestion de riesgos empresariales, impacto legal de las brechas de seguridad y toma de decisión ante crisis (Ransomware)', 'Ciberseguridad', 3600.00, 12, 0, 1, 'Pagas por un programa de acompañamiento anual que incluye un taller inicial de gestión de crisis y ransomware, 4 charlas trimestrales (Online 45 min.) sobre nuevas amenazas, canal de consulta prioritario para dudas del diretivo y cuadro de mando de riesgo para la dirección más una guía de bolsillo de respuestas a incidentes.', NULL, '2026-01-02 22:09:47', NULL, '2026-01-04 14:45:38'),
(8, 'Formación: Hacking Ético Básico', 'Curso introductorio sobre seguridad ofensiva y defensa, aprende técnicas de hacking ético y cómo protegerte de ellas.', 'Formación', 150.00, 10, 0, 1, 'Pagas por acceso al campus online con curso completo de Introducción al Phishing, certificado de superación, exámenes prácticos y materiales didácticos descargables.', NULL, '2026-01-09 10:00:00', NULL, NULL);

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

--
-- Volcado de datos para la tabla `solicitudes_presupuesto`
--

INSERT INTO `solicitudes_presupuesto` (`id`, `servicio_id`, `nombre_contacto`, `email_contacto`, `telefono_contacto`, `empresa`, `nif_cif`, `num_empleados`, `sector_actividad`, `descripcion_necesidad`, `alcance_solicitado`, `presupuesto_estimado`, `fecha_inicio_deseada`, `estado_solicitud`, `prioridad`, `fecha_solicitud`, `fecha_contacto`, `usuario_asignado_id`, `notas_comerciales`, `origen_solicitud`) VALUES
(1, NULL, 'Pedro Domingues', 'pedro@pedro.com', NULL, 'No especificada (Contacto Web)', NULL, NULL, NULL, 'pedro', NULL, NULL, NULL, 'Pendiente', 2, '2026-01-02 21:17:56', NULL, NULL, NULL, 'Web'),
(2, 2, 'prueba Gonzalez', 'prueba@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Pendiente', 1, '2026-01-08 12:28:25', NULL, NULL, NULL, 'Web'),
(3, 3, 'prueba Gonzalez', 'prueba@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Pendiente', 1, '2026-01-08 12:29:13', NULL, NULL, NULL, 'Web');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `auth_key` varchar(32) NOT NULL DEFAULT '',
  `email_recuperacion` varchar(255) DEFAULT NULL,
  `totp_secret` varchar(255) DEFAULT NULL,
  `totp_activo` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Usuarios del sistema con autenticación y control de roles';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `nombre`, `apellidos`, `empresa`, `telefono`, `direccion`, `fecha_registro`, `ultimo_acceso`, `intentos_acceso`, `bloqueado`, `fecha_bloqueo`, `motivo_bloqueo`, `activo`, `auth_key`, `email_recuperacion`, `totp_secret`, `totp_activo`) VALUES
(1, 'admin@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Pedro', 'Admin', NULL, NULL, NULL, '2025-12-26 10:41:09', NULL, 0, 0, NULL, NULL, 1, 'cIwcYPb9TnINim4_YhZ715O5PHhY7ei_', NULL, NULL, 0),
(2, 'auditor@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Estela', 'Auditora', 'Empresa Interna', NULL, NULL, '2025-12-26 11:09:25', NULL, 0, 0, NULL, NULL, 1, 'd605677f1938d8e599ad7659baaa6188', NULL, NULL, 0),
(4, 'consultor@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Jose', 'Consultor', 'Empresa Interna', NULL, NULL, '2025-12-26 11:09:25', NULL, 0, 0, NULL, NULL, 1, '624b20b9f12fe140cfebd39761912c1c', NULL, NULL, 0),
(6, 'analistasoc@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Iris', 'Analista SOC', 'SOC 24/7', NULL, NULL, '2025-12-26 11:09:25', NULL, 0, 0, NULL, NULL, 1, 'fe28b3a15afe5fb6331b67813af64af1', NULL, NULL, 0),
(7, 'prueba@cibersec.com', '$2y$13$HOPt.sSvwbu.fHNrGxaaM.jGvjNwCDe/q5eT/PVoSkXK.z4RLU.Z.', 'prueba', 'Gonzalez', 'Empresa Real', '567567567', 'Calle Falsa 123', '2025-12-26 12:20:39', NULL, 0, 0, NULL, NULL, 1, 'Lq5SZkO5XLxp4-UZauw4-K6gIKxdMIJB', 'pruebaRECU@cibersec.com', NULL, 0),
(8, 'prueba2@prueba.com', '$2y$13$2MGOHExL9CzAXY40LIuTaunTqjkF1Sk5pbuNjz6yMIFbwW4dEn8ii', 'prueba2', NULL, NULL, NULL, NULL, '2026-01-02 15:59:08', NULL, 0, 0, NULL, NULL, 1, 'sNnto1_RsnqvwuhSs8vmlfjtdfQPf9U4', NULL, NULL, 0),
(9, 'clienteadmin@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Laura', 'Admin Empresa', 'Acme Corp', NULL, NULL, '2026-01-07 20:00:00', NULL, 0, 0, NULL, NULL, 1, 'a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6', NULL, NULL, 0),
(10, 'manager@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Carlos', 'Manager', 'Empresa Interna', NULL, NULL, '2026-01-07 20:00:00', NULL, 0, 0, NULL, NULL, 1, 'p6o5n4m3l2k1j0i9h8g7f6e5d4c3b2a1', NULL, NULL, 0),
(11, 'comercial@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Ana', 'Comercial', 'Empresa Interna', NULL, NULL, '2026-01-07 20:00:00', NULL, 0, 0, NULL, NULL, 1, 'x9y8z7a6b5c4d3e2f1g0h9i8j7k6l5m4', NULL, NULL, 0);

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
  ADD KEY `idx_cursos_servicio` (`servicio_id`),
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
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `solicitudes_presupuesto`
--
ALTER TABLE `solicitudes_presupuesto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `fk_cursos_servicio` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
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
