-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-01-2026 a las 18:54:01
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
('cliente_user', '15', 1768163459),
('cliente_user', '16', 1768164183),
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
(3, 1, 3, 'Cómo protegerse', '<h3>Tips de Seguridad</h3><ol><li>Verifica siempre el remitente (@empresa.com no @gmail.com).</li><li>No hagas clic en enlaces sospechosos (\"Tu cuenta ha sido bloqueada\").</li><li>Activa el doble factor de autenticación (2FA).</li></ol><p>¡Estás listo para el examen!</p>', NULL, NULL, NULL, '2026-01-09 10:00:00', NULL, NULL);

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

--
-- Volcado de datos para la tabla `eventos_calendario`
--

INSERT INTO `eventos_calendario` (`id`, `proyecto_id`, `auditor_id`, `titulo`, `descripcion`, `fecha`, `hora_inicio`, `hora_fin`, `tipo_evento`, `ubicacion`, `estado_evento`, `recordatorio_enviado`, `notas`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(2, 2, 2, 'Auditoria de prueba', 'popop', '2026-01-03', '09:00:00', '11:00:00', 'Reunión Cliente', 'Sala', 'Programado', 1, 'holi', NULL, '2026-01-10 13:02:29', NULL, NULL);

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
  `visible_cliente` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Si el cliente puede ver esta incidencia: 0=No, 1=Sí',
  `origen` varchar(100) DEFAULT 'Manual'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Sistema de ticketing SOC para incidencias de seguridad';

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `cliente_id`, `analista_id`, `titulo`, `descripcion`, `severidad`, `estado_incidencia`, `categoria_incidencia`, `fecha_reporte`, `fecha_asignacion`, `fecha_primera_respuesta`, `fecha_resolucion`, `tiempo_resolucion`, `sla_cumplido`, `ip_origen`, `sistema_afectado`, `acciones_tomadas`, `notas_internas`, `visible_cliente`, `origen`) VALUES
(1, 9, 6, 'Correo sospechoso', 'Algo malo pasa', 'Media', 'Resuelto', 'Phising', '2026-01-08 12:01:07', '2026-01-10 00:00:00', NULL, NULL, NULL, NULL, '192.100.1.230', 'Servidor web principla', NULL, NULL, 1, 'Manual'),
(2, 9, NULL, 'Correo sospechoso mu malo', 'Movida tope chunga, tio', 'Alta', 'Abierto', 'Phising', '2026-01-10 12:38:21', NULL, NULL, NULL, NULL, NULL, '000.00.00.0', 'Servidor web principal ', NULL, NULL, 1, 'Manual'),
(3, 9, 6, 'Aviso de Seguridad: Vulnerabilidad en SRV-DB-01 (CVE-2024-2311)', 'Detectada vulnerabilidad crítica o importante en el activo SRV-DB-01.\n\nCVE: CVE-2024-2311\nRiesgo: Crítico\nEstado del Parche: Pendiente\n\nSe requiere su autorización para proceder con la ventana de mantenimiento de emergencia.', 'Crítica', 'Asignado', NULL, '2026-01-10 17:15:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Gestión de Vulnerabilidades'),
(4, 9, 6, 'Alerta de Seguridad: Escaneo de puertos detectado', 'Se ha detectado una actividad sospechosa en el sistema Gateway.\n\nDetalles:\nEscaneo rápido TCP desde IP interna desconocida\n\nFuente: IPS', 'Media', 'Asignado', NULL, '2026-01-10 17:15:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Monitorización SOC'),
(5, 9, 6, 'Incidencia Demo 6962953f6edcb', 'Prueba de dashboard', 'Baja', 'Resuelto', NULL, '2026-01-09 19:06:55', NULL, NULL, '2026-01-11 11:06:55', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Simulacion'),
(6, 7, NULL, 'Incidencia Demo 6962953f748fe', 'Prueba de dashboard', 'Baja', 'Resuelto', NULL, '2026-01-02 19:06:55', NULL, NULL, '2026-01-03 09:06:55', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Simulacion'),
(7, 7, NULL, 'Incidencia Demo 6962953f75384', 'Prueba de dashboard', 'Informativa', 'Resuelto', NULL, '2026-01-03 19:06:55', NULL, NULL, '2026-01-05 04:06:55', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Simulacion'),
(8, 7, NULL, 'Incidencia Demo 6962953f75f65', 'Prueba de dashboard', 'Informativa', 'Resuelto', NULL, '2026-01-02 19:06:55', NULL, NULL, '2026-01-04 19:06:55', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Simulacion'),
(9, 7, NULL, 'Incidencia Demo 6962953f9579d', 'Prueba de dashboard', 'Alta', 'Resuelto', NULL, '2026-01-04 19:06:55', NULL, NULL, '2026-01-06 03:06:55', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Simulacion'),
(10, 7, NULL, 'Incidencia Demo 6962953f96411', 'Prueba de dashboard', 'Media', 'Resuelto', NULL, '2026-01-06 19:06:55', NULL, NULL, '2026-01-08 13:06:55', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Simulacion'),
(11, 7, NULL, 'Incidencia Demo 6962953f96dc4', 'Prueba de dashboard', 'Informativa', 'Resuelto', NULL, '2026-01-05 19:06:55', NULL, NULL, '2026-01-07 04:06:55', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Simulacion'),
(12, 14, 6, 'Incidencia Demo 6962953f97dd3', 'Prueba de dashboard', 'Crítica', 'Resuelto', NULL, '2026-01-06 19:06:55', NULL, NULL, '2026-01-08 09:06:55', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Simulacion'),
(13, 7, NULL, 'Incidencia Demo 6962953f98d4d', 'Prueba de dashboard', 'Alta', 'Resuelto', NULL, '2026-01-09 19:06:55', NULL, NULL, '2026-01-11 12:06:55', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Simulacion'),
(14, 7, NULL, 'Incidencia Demo 6962953f9997a', 'Prueba de dashboard', 'Baja', 'Resuelto', NULL, '2026-01-04 19:06:55', NULL, NULL, '2026-01-05 13:06:55', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Simulacion'),
(15, 9, 1, 'Alerta de Seguridad: Cambio de privilegios sospechoso', 'Se ha detectado una actividad sospechosa en el sistema SRV-FILE-01.\n\nDetalles:\nEl usuario user_guest fue añadido al grupo Administradores\n\nFuente: Active Directory', 'Alta', 'Asignado', NULL, '2026-01-10 20:49:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Monitorización SOC'),
(16, 14, NULL, 'Correo sospechoso', 'n', 'Media', 'Abierto', 'm', '2026-01-11 17:44:25', NULL, NULL, NULL, NULL, NULL, '111.111.1.111', 'k', NULL, NULL, 1, 'Manual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_defender`
--

CREATE TABLE `logs_defender` (
  `id` int(11) NOT NULL,
  `evento` varchar(255) NOT NULL,
  `fuente` varchar(100) NOT NULL DEFAULT 'Microsoft Defender',
  `gravedad` enum('Crítica','Alta','Media','Baja','Informativa') NOT NULL DEFAULT 'Media',
  `fecha` datetime DEFAULT current_timestamp(),
  `cliente_afectado_id` int(11) DEFAULT NULL,
  `sistema` varchar(100) DEFAULT NULL,
  `estado` enum('Pendiente','Procesado','Ignorado') NOT NULL DEFAULT 'Pendiente',
  `detalles_tecnicos` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `logs_defender`
--

INSERT INTO `logs_defender` (`id`, `evento`, `fuente`, `gravedad`, `fecha`, `cliente_afectado_id`, `sistema`, `estado`, `detalles_tecnicos`) VALUES
(1, 'Intento de fuerza bruta RDP', 'Firewall Perimetral', 'Alta', '2026-01-09 20:51:47', 9, 'SRV-AD-01', 'Pendiente', 'Múltiples intentos fallidos desde IP 45.23.12.99'),
(2, 'Malware detectado: Trojan.Win32', 'Microsoft Defender', 'Crítica', '2026-01-09 23:51:47', 9, 'PC-RECEPCION', 'Pendiente', 'El antivirus bloqueó la ejecución de invoice.exe'),
(3, 'Escaneo de puertos detectado', 'IPS', 'Media', '2026-01-10 07:51:47', 9, 'Gateway', 'Procesado', 'Escaneo rápido TCP desde IP interna desconocida'),
(4, 'Cambio de privilegios sospechoso', 'Active Directory', 'Alta', '2026-01-10 05:51:47', 9, 'SRV-FILE-01', 'Procesado', 'El usuario user_guest fue añadido al grupo Administradores');

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
('m260108_105433_add_totp_secret_column_to_usuarios_table', 1767869720),
('m260110_154627_fix_create_logs_defender_table', 1768060019),
('m260110_161354_add_origen_column_to_incidencias_table', 1768061660),
('m260110_211500_add_verification_token_to_usuarios', 1768075910),
('m260110_214000_add_password_reset_token_to_usuarios', 1768077560);

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
(1, 1, '¿Cuál de los siguientes es un indicio claro de Phishing?', 'El correo viene de @mibanco.com.', 'El correo tiene faltas de ortografía y mete urgencia (\"¡Hazlo ya!\").', 'El correo incluye mi nombre completo.', 'b', NULL, '2026-01-09 10:00:00', NULL, NULL),
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

--
-- Volcado de datos para la tabla `progreso_usuario`
--

INSERT INTO `progreso_usuario` (`id`, `usuario_id`, `curso_id`, `diapositiva_actual`, `cuestionario_realizado`, `nota_obtenida`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(1, 9, 1, 3, 1, 10.00, '2026-01-11 15:41:34', '2026-01-11 15:54:02', 'Aprobado');

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

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `nombre`, `descripcion`, `cliente_id`, `servicio_id`, `consultor_id`, `auditor_id`, `fecha_inicio`, `fecha_fin_prevista`, `fecha_fin_real`, `estado`, `presupuesto`, `notas_internas`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(2, 'Proyecto de orientacion', 'hh', 9, 1, 4, 2, '0000-00-00', '0000-00-00', '0000-00-00', 'Planificación', 30.00, NULL, NULL, '2026-01-10 12:47:09', NULL, NULL),
(3, 'Implantación: Gestión de vulnerabilidades', 'Generado automáticamente desde solicitud #9\n\nSolicitud iniciada desde el catálogo de servicios', 9, 4, NULL, NULL, '2026-01-10', NULL, NULL, 'Planificación', NULL, NULL, 11, '2026-01-10 17:43:32', NULL, NULL),
(11, 'Proyecto Demo 1 - Campaña de phishing simulado', 'Generado automáticamente para testing', 7, 5, NULL, NULL, '2026-01-10', '2027-01-10', NULL, 'En curso', 12800.00, NULL, NULL, '2026-01-10 19:06:55', NULL, NULL),
(12, 'Proyecto Demo 2 - Monitorización y respuestas a incidentes', 'Generado automáticamente para testing', 7, 3, NULL, NULL, '2026-01-10', '2027-01-10', NULL, 'En curso', 11700.00, NULL, NULL, '2026-01-10 19:06:55', NULL, NULL),
(13, 'Proyecto Demo 3 - Adecuación al Esquema Nacional de Seguridad', 'Generado automáticamente para testing', 7, 2, NULL, NULL, '2026-01-10', '2027-01-10', NULL, 'En curso', 12100.00, NULL, NULL, '2026-01-10 19:06:55', NULL, NULL),
(14, 'Proyecto Demo 4 - Gestión de vulnerabilidades', 'Generado automáticamente para testing', 7, 4, NULL, NULL, '2026-01-10', '2027-01-10', NULL, 'En curso', 6300.00, NULL, NULL, '2026-01-10 19:06:55', NULL, NULL),
(15, 'Proyecto Demo 5 - Monitorización y respuestas a incidentes', 'Generado automáticamente para testing', 7, 3, NULL, NULL, '2026-01-10', '2027-01-10', NULL, 'En curso', 10800.00, NULL, NULL, '2026-01-10 19:06:55', NULL, NULL),
(18, 'Implantación: Adecuación al Esquema Nacional de Seguridad', 'Generado automáticamente desde solicitud #17\n\nSolicitud iniciada desde el catálogo de servicios', 9, 2, NULL, NULL, '2026-01-11', NULL, NULL, 'Planificación', NULL, NULL, 11, '2026-01-11 13:13:36', NULL, NULL),
(19, 'Implantación: Formación: Hacking Ético Básico', 'Proyecto generado tras pago con tarjeta exitoso.\nRef. Pago: TRX-1768133751', 9, 8, NULL, NULL, '2026-01-11', NULL, NULL, 'Planificación', NULL, NULL, NULL, '2026-01-11 13:15:51', NULL, NULL),
(20, 'Implantación: Ciberseguridad para diretivos', 'Proyecto generado tras pago con tarjeta exitoso.\nRef. Pago: TRX-1768134721', 9, 7, NULL, NULL, '2026-01-11', NULL, NULL, 'Planificación', NULL, NULL, NULL, '2026-01-11 13:32:01', NULL, NULL),
(21, 'Implantación: Curso de concienciación general', 'Generado automáticamente desde solicitud #20\n\nSolicitud iniciada desde el catálogo de servicios', 9, 6, NULL, NULL, '2026-01-11', NULL, NULL, 'Planificación', NULL, NULL, 11, '2026-01-11 13:41:24', NULL, NULL),
(26, 'Implantación: Adecuación al Esquema Nacional de Seguridad', 'Generado automáticamente desde solicitud #26\n\nSolicitud iniciada desde el catálogo de servicios', 14, 2, NULL, NULL, '2026-01-11', NULL, NULL, 'Planificación', NULL, NULL, 11, '2026-01-11 18:09:17', NULL, NULL);

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
(1, 'Implantación y Auditoría ISO 27001', 'Acompañamiento integral para el diseño SGSI, analisis de riesgos y preparación para la certificación oficial', 'Ciberseguridad', 14500.00, 6, 1, 1, 'Se cobra por hitos (30% inicio, 40% mitad y 30% fin)\r\nPagas por (Política de seguridad, análisis de riesgos, declaración de aplicabilidad, plan de tratamiento de riesgos e informe de auditoría interna) que te permitan certificarte.', NULL, '2026-01-02 21:53:10', NULL, '2026-01-11 11:33:44'),
(2, 'Adecuación al Esquema Nacional de Seguridad', 'Adaptación de sistemas para el cumplinento con el RD311/2022 para administraciones publicas y proveedores', 'Consultoría', 18000.00, 12, 1, 1, 'Pagas por cumplir la ley (Acta de categorización del sistema, declaración de aplicabilidad, politica de seguridad, informe de insuficiencia, plan de adecuación e informe de auditoría de conformidad)', NULL, '2026-01-02 21:55:32', NULL, '2026-01-04 14:35:05'),
(3, 'Monitorización y respuestas a incidentes', 'Vigilancia continua de activos digitales mediante SIEM y analistas de nivel 1 y 2 para detectar intrusiones en tiempo real', 'Ciberseguridad', 30000.00, 12, 0, 1, 'Pagas por tranquilidad y visibilidad mediante Acceso a Dashboard de seguridad en tiempo real, notificación de incidentes criticos, informe mensual ejecutivos de amenzasa bloqueadas y reunión trimestral de seguimiento de seguridad.', NULL, '2026-01-02 21:59:15', NULL, '2026-01-10 18:22:04'),
(4, 'Gestión de vulnerabilidades', 'Escaneo periodicos automatizados para detectar fallos de seguridad en servidores y aplicaciones web antes que los atacantes', 'Ciberseguridad', 5400.00, 12, 0, 1, 'Pagas por saber donde tienes las brechas de seguridad antes que los hacker mediante Informe tecnicos de vulnerabilidades, guía de remediación para el equipo de IT, resumen ejecutivo de riesgos tecnológicos y certificado de escaneo trimestral.', NULL, '2026-01-02 22:01:10', NULL, '2026-01-10 18:22:04'),
(5, 'Campaña de phishing simulado', 'Envio controlado de correos trampa a empleados para medir el nivel de riesgo humano y educar en la detención de fraudes ', 'Formación', 11400.00, 12, 0, 1, 'Pagas por medir y educar a tus empleados mediante informe de tasas de click y apertura de correos, listado de usuarios comprometidos, pildora formativa de refuerzo y diploma de participación en la campaña.', NULL, '2026-01-02 22:03:23', NULL, '2026-01-04 14:33:45'),
(6, 'Curso de concienciación general', 'Formación fundamental sobre higiene digital: contraseñas robustas, deteción de ingeniería social, protección del puesto de trabajo y cumplimiento básico de protección de datos', 'Formación', 36.00, 12, 0, 1, 'Pagas por el certificado nominal de superación, manual de buenas practicas de ciberhigiene, decálogo de cumplimiento RGPD para imprimir y checklist de puesto de trabajo seguro. ', NULL, '2026-01-02 22:06:44', NULL, '2026-01-04 14:46:11'),
(7, 'Ciberseguridad para diretivos', 'Seminiario ejecutivo sobre gestion de riesgos empresariales, impacto legal de las brechas de seguridad y toma de decisión ante crisis (Ransomware)', 'Ciberseguridad', 3600.00, 12, 0, 1, 'Pagas por un programa de acompañamiento anual que incluye un taller inicial de gestión de crisis y ransomware, 4 charlas trimestrales (Online 45 min.) sobre nuevas amenazas, canal de consulta prioritario para dudas del diretivo y cuadro de mando de riesgo para la dirección más una guía de bolsillo de respuestas a incidentes.', NULL, '2026-01-02 22:09:47', NULL, '2026-01-10 18:22:04'),
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
(3, 3, 'prueba Gonzalez', 'prueba@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Pendiente', 1, '2026-01-08 12:29:13', NULL, NULL, NULL, 'Web'),
(4, NULL, 'Pedrino Dom Pa', 'pedro@pedro.com', NULL, 'No especificada (Contacto Web)', NULL, NULL, NULL, 'Yo', NULL, NULL, NULL, 'Pendiente', 2, '2026-01-10 12:14:58', NULL, NULL, NULL, 'Web'),
(5, 5, 'Pepino', 'pepino@gmail.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Pendiente', 1, '2026-01-10 12:22:20', NULL, NULL, NULL, 'Web'),
(6, 8, 'Laura Admin Empresa', 'clienteadmin@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-10 12:39:49', NULL, NULL, NULL, 'Web'),
(7, 6, 'Laura Admin Empresa', 'clienteadmin@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-10 13:15:39', NULL, NULL, NULL, 'Web'),
(8, 4, 'prueba Gonzalez', 'prueba@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-10 13:36:46', NULL, NULL, NULL, 'Web'),
(9, 4, 'Laura Admin Empresa', 'clienteadmin@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-10 17:30:30', NULL, NULL, NULL, 'Web'),
(10, 3, 'prueba3', 'prueba3@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Rechazado', 1, '2026-01-10 18:08:41', NULL, NULL, NULL, 'Web'),
(11, 1, 'prueba3', 'prueba3@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Rechazado', 1, '2026-01-10 18:24:36', NULL, NULL, NULL, 'Web'),
(12, 3, 'prueba3', 'prueba3@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-10 18:47:00', NULL, NULL, NULL, 'Web'),
(13, 1, 'prueba3', 'prueba3@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-10 18:47:59', NULL, NULL, NULL, 'Web'),
(14, 2, 'prueba3', 'prueba3@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-10 18:49:06', NULL, NULL, NULL, 'Web'),
(15, 6, 'prueba3', 'prueba3@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-10 18:52:20', NULL, NULL, NULL, 'Web'),
(16, 7, 'prueba3', 'prueba3@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-10 20:01:35', NULL, NULL, NULL, 'Web'),
(17, 2, 'Laura Admin Empresa', 'clienteadmin@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-11 13:06:55', NULL, NULL, NULL, 'Web'),
(18, 8, 'Laura Admin Empresa', 'clienteadmin@cibersec.com', NULL, 'Acme Corp', NULL, NULL, NULL, 'Contratación Directa vía Tarjeta de Crédito', NULL, NULL, NULL, 'Contratado', 3, '2026-01-11 13:15:51', NULL, NULL, NULL, 'Web (Tarjeta)'),
(19, 7, 'Laura Admin Empresa', 'clienteadmin@cibersec.com', NULL, 'Acme Corp', NULL, NULL, NULL, 'Contratación Directa vía Tarjeta de Crédito', NULL, NULL, NULL, 'Contratado', 3, '2026-01-11 13:32:01', NULL, NULL, NULL, 'Web (Tarjeta)'),
(20, 6, 'Laura Admin Empresa', 'clienteadmin@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-11 13:32:45', NULL, NULL, NULL, 'Web'),
(21, 8, 'prueba3', 'prueba3@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-11 13:55:47', NULL, NULL, NULL, 'Web'),
(22, 2, 'prueba3 ', 'prueba3@cibersec.com', NULL, 'Particular', NULL, NULL, NULL, 'Contratación Directa vía Tarjeta de Crédito', NULL, NULL, NULL, 'Contratado', 3, '2026-01-11 14:05:28', NULL, NULL, NULL, 'Web (Tarjeta)'),
(23, 5, 'prueba3 ', 'prueba3@cibersec.com', NULL, 'Particular', NULL, NULL, NULL, 'Contratación Directa vía Tarjeta de Crédito', NULL, NULL, NULL, 'Contratado', 3, '2026-01-11 17:42:27', NULL, NULL, NULL, 'Web (Tarjeta)'),
(24, NULL, 'Kevin Lopez', 'kevin@cibersec.com', NULL, 'No especificada (Contacto Web)', NULL, NULL, NULL, 'Necesito consejos sobre mi equipo', NULL, NULL, NULL, 'Pendiente', 2, '2026-01-11 17:55:18', NULL, NULL, NULL, 'Web'),
(25, 1, 'prueba3 ', 'prueba3@cibersec.com', NULL, 'Particular', NULL, NULL, NULL, 'Contratación Directa vía Tarjeta de Crédito', NULL, NULL, NULL, 'Contratado', 3, '2026-01-11 18:07:02', NULL, NULL, NULL, 'Web (Tarjeta)'),
(26, 2, 'prueba3', 'prueba3@cibersec.com', NULL, 'Cliente Web', NULL, NULL, NULL, 'Solicitud iniciada desde el catálogo de servicios', NULL, NULL, NULL, 'Contratado', 1, '2026-01-11 18:07:31', NULL, NULL, NULL, 'Web'),
(27, 8, 'prueba3 ', 'prueba3@cibersec.com', NULL, 'Particular', NULL, NULL, NULL, 'Contratación Directa vía Tarjeta de Crédito', NULL, NULL, NULL, 'Contratado', 3, '2026-01-11 18:25:47', NULL, NULL, NULL, 'Web (Tarjeta)');

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
  `rol` enum('cliente_user','cliente_admin','consultor','auditor','analista_soc','admin','manager','comercial') NOT NULL DEFAULT 'cliente_user' COMMENT 'Rol del usuario en el sistema RBAC',
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
  `totp_activo` tinyint(1) DEFAULT 0,
  `verification_token` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Usuarios del sistema con autenticación y control de roles';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `nombre`, `apellidos`, `rol`, `empresa`, `telefono`, `direccion`, `fecha_registro`, `ultimo_acceso`, `intentos_acceso`, `bloqueado`, `fecha_bloqueo`, `motivo_bloqueo`, `activo`, `auth_key`, `email_recuperacion`, `totp_secret`, `totp_activo`, `verification_token`, `password_reset_token`) VALUES
(1, 'admin@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Pedro', 'Admin', 'admin', NULL, NULL, NULL, '2025-12-26 10:41:09', NULL, 0, 0, NULL, NULL, 1, 'cIwcYPb9TnINim4_YhZ715O5PHhY7ei_', NULL, NULL, 0, NULL, NULL),
(2, 'auditor@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Estela', 'Auditora', 'auditor', 'Empresa Interna', NULL, NULL, '2025-12-26 11:09:25', NULL, 0, 0, NULL, NULL, 1, 'd605677f1938d8e599ad7659baaa6188', NULL, NULL, 0, NULL, NULL),
(4, 'consultor@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Jose', 'Consultor', 'consultor', 'Empresa Interna', NULL, NULL, '2025-12-26 11:09:25', NULL, 0, 0, NULL, NULL, 1, '624b20b9f12fe140cfebd39761912c1c', NULL, NULL, 0, NULL, NULL),
(6, 'analistasoc@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Iris', 'Analista SOC', 'analista_soc', 'SOC 24/7', NULL, NULL, '2025-12-26 11:09:25', NULL, 0, 0, NULL, NULL, 1, 'fe28b3a15afe5fb6331b67813af64af1', NULL, NULL, 0, NULL, NULL),
(7, 'prueba@cibersec.com', '$2y$13$HOPt.sSvwbu.fHNrGxaaM.jGvjNwCDe/q5eT/PVoSkXK.z4RLU.Z.', 'prueba', 'Gonzalez', 'cliente_user', 'Empresa Real', '567567567', 'Calle Falsa 123', '2025-12-26 12:20:39', NULL, 0, 0, NULL, NULL, 1, 'Lq5SZkO5XLxp4-UZauw4-K6gIKxdMIJB', 'pruebaRECU@cibersec.com', NULL, 0, NULL, NULL),
(8, 'prueba2@cibersec.com', '$2y$13$YO.esNHzQbfFcJsKFBcUy.9c5FkTylZYBNInJ2hY4.5PQ5bJ8LONm', 'prueba2', NULL, 'cliente_user', NULL, NULL, NULL, '2026-01-02 15:59:08', NULL, 0, 0, NULL, NULL, 1, 't5UFXE0ex_149REvSt2QHebMB4uval3G', NULL, NULL, 0, 'LIxdIlwHdUChJ6UrxCqQQL15g4pwqStl_1768077256', NULL),
(9, 'clienteadmin@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Laura', 'Admin Empresa', 'cliente_admin', 'Acme Corp', NULL, NULL, '2026-01-07 20:00:00', NULL, 0, 0, NULL, NULL, 1, 'a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6', NULL, NULL, 0, NULL, NULL),
(10, 'manager@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Carlos', 'Manager', 'manager', 'Empresa Interna', NULL, NULL, '2026-01-07 20:00:00', NULL, 0, 0, NULL, NULL, 1, 'p6o5n4m3l2k1j0i9h8g7f6e5d4c3b2a1', NULL, NULL, 0, NULL, NULL),
(11, 'comercial@cibersec.com', '$2y$13$hrDlx4YWApIJhEuXURc.q.DLEUz4QEAor./AVVpv3klM54qD82Mg.', 'Ana', 'Comercial', 'comercial', 'Empresa Interna', NULL, NULL, '2026-01-07 20:00:00', NULL, 0, 0, NULL, NULL, 1, 'x9y8z7a6b5c4d3e2f1g0h9i8j7k6l5m4', NULL, NULL, 0, NULL, NULL),
(12, 'pepino@gmail.com', '$2y$13$PKzw7MVQDMeYw8MHkNDj.u.m6knGmduCgqt9a/P4Z2lKxi/yG80oW', 'Pepino', ' PEPE JOI', 'cliente_user', 'Empresa Juanito', '654654654', 'Calle Falsa 123', '2026-01-10 12:17:40', NULL, 0, 0, NULL, NULL, 1, 'CgpVP1FbYbrRPQ5YohlMAlLtsnXsOccj', 'pepinoRECU@gmail.com', NULL, 0, NULL, NULL),
(13, 'juan@cibersec.com', '$2y$13$xMvYBHOK6XoYQAC3hkLN3.RD2Vt9qkvxEQya1wCtsc8FcmpspUlsG', 'Juan Martinez', NULL, 'cliente_user', 'Acme Corp', NULL, NULL, '2026-01-10 17:46:59', NULL, 0, 0, NULL, NULL, 1, '7qUuPVKt8B5FRgrFi73guHxjCbpDqH2A', NULL, NULL, 0, NULL, NULL),
(14, 'prueba3@cibersec.com', '$2y$13$ivS4nRs4uWWC/fOES8umSOqcb.VypLgd1Kq/1MSV4jVTz8gKSUC/W', 'prueba3', 'Perez', 'cliente_admin', '', '', '', '2026-01-10 18:07:07', NULL, 0, 0, NULL, NULL, 1, '_LmE1F5wHFSIuJRe8yIW6Xdp3AlEZPAh', NULL, NULL, 0, NULL, NULL),
(15, 'pedro@cibersec.com', '$2y$13$AY9jfNmAiKsEiuNGC170TuY9X0Ue5Xl43/yas1TJBcK4gt5Uo0AZi', 'Pedro Domingues Parra', NULL, 'cliente_user', NULL, NULL, NULL, '2026-01-11 21:30:59', NULL, 0, 0, NULL, NULL, 1, 'grMTDwpHoH-8MKgSbOEETFKcBfAQleK4', NULL, NULL, 0, NULL, NULL),
(16, 'jaf@cibersec.com', '$2y$13$v3ZrXePu9CX8ADyRfJGGqO51aVscl1WjlSgSRDWt.KGSvzwcLBbHW', 'Juan Alvarez Frias', NULL, 'cliente_user', 'Empresa mureal', NULL, NULL, '2026-01-11 21:43:03', NULL, 0, 0, NULL, NULL, 1, 'XGgQwo_p0EX3_GMp_eAN5lJPQjfFduMF', NULL, NULL, 0, NULL, NULL);

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
-- Indices de la tabla `logs_defender`
--
ALTER TABLE `logs_defender`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-logs_defender-cliente_id` (`cliente_afectado_id`);

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
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `idx_rol` (`rol`) COMMENT 'Índice para búsquedas por rol';

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `diapositivas`
--
ALTER TABLE `diapositivas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `eventos_calendario`
--
ALTER TABLE `eventos_calendario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `logs_defender`
--
ALTER TABLE `logs_defender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `preguntas_cuestionario`
--
ALTER TABLE `preguntas_cuestionario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `progreso_usuario`
--
ALTER TABLE `progreso_usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `solicitudes_presupuesto`
--
ALTER TABLE `solicitudes_presupuesto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  ADD CONSTRAINT `fk_cursos_modificador` FOREIGN KEY (`modificado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cursos_servicio` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
--
-- Base de datos: `daw_tienda`
--
CREATE DATABASE IF NOT EXISTS `daw_tienda` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `daw_tienda`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `referencia` varchar(10) NOT NULL COMMENT 'Referencia unica del articulo, creada por el usuarioa su conveniencia',
  `texto` varchar(250) NOT NULL COMMENT 'Texto descriptivo del articulo',
  `precio` float NOT NULL COMMENT 'Precio del articulo con 2 decimales',
  `iva` float NOT NULL COMMENT 'Tipo de IVA del articulo en porcentaje',
  `notas` text DEFAULT NULL COMMENT 'Notas internas para el Articulo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`referencia`, `texto`, `precio`, `iva`, `notas`) VALUES
('ART000001', 'texto 000001', 11.31, 21, NULL),
('ART000002', 'texto 000002', 15.24, 10, NULL),
('ART000003', 'texto 000003', 23.88, 10, NULL),
('ART000004', 'texto 000004', 20.48, 10, NULL),
('ART000005', 'texto 000005', 50.05, 10, NULL),
('ART000006', 'texto 000006', 22.02, 10, NULL),
('ART000007', 'texto 000007', 95.06, 10, NULL),
('ART000008', 'texto 000008', 19.36, 10, NULL),
('ART000009', 'texto 000009', 111.33, 10, NULL),
('ART000010', 'texto 000010', 83, 10, NULL),
('ART000011', 'texto 000011', 140.91, 10, NULL),
('ART000012', 'texto 000012', 162.84, 10, NULL),
('ART000013', 'texto 000013', 131.95, 10, NULL),
('ART000014', 'texto 000014', 162.96, 10, NULL),
('ART000015', 'texto 000015', 36.45, 10, NULL),
('ART000016', 'texto 000016', 84.16, 10, NULL),
('ART000017', 'texto 000017', 20.74, 10, NULL),
('ART000018', 'texto 000018', 147.06, 10, NULL),
('ART000019', 'texto 000019', 250.42, 10, NULL),
('ART000020', 'texto 000020', 220.2, 10, NULL),
('ART000021', 'texto 000021', 245.28, 10, NULL),
('ART000022', 'texto 000022', 302.28, 10, NULL),
('ART000023', 'texto 000023', 100.05, 10, NULL),
('ART000024', 'texto 000024', 120, 10, NULL),
('ART000025', 'texto 000025', 244.5, 10, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `referencia` varchar(10) NOT NULL COMMENT 'Referencia unica del cliente, creada por el usuarioa su conveniencia',
  `idUser` int(12) DEFAULT NULL COMMENT 'Enlace a tabla usuarios',
  `cifnif` varchar(10) NOT NULL,
  `nombre` varchar(250) NOT NULL COMMENT 'Nombre del cliente o Nombre Comercial de la empresa',
  `apellidos` varchar(250) NOT NULL COMMENT 'Apellidos del cliente o Razón Social de la empresa',
  `domFiscal` varchar(250) NOT NULL COMMENT 'Domicilio Fiscal para Facturas',
  `domEnvio` varchar(250) DEFAULT NULL COMMENT 'Domicilio para los envíos de correo al cliente, si no se indica se usa el Fiscal',
  `notas` text DEFAULT NULL COMMENT 'Notas internas para el Cliente',
  `email` varchar(100) NOT NULL COMMENT 'Correo electronico del cliente y a la vez login de acceso al sistema',
  `password` varchar(32) NOT NULL COMMENT 'Clave de acceso al sistema con espacio para un md5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`referencia`, `idUser`, `cifnif`, `nombre`, `apellidos`, `domFiscal`, `domEnvio`, `notas`, `email`, `password`) VALUES
('ZA000001', 4, 'ID000001', 'nombre 000001', 'apellido 000001', 'domicilio fiscal 000001', NULL, NULL, 'cliente1@correo.es', 'cliente1'),
('ZA000002', 5, 'ID000002', 'nombre 000002', 'apellido 000002', 'domicilio fiscal 000002', NULL, NULL, 'cliente2@correo.es', 'cliente2'),
('ZA000003', 6, 'ID000003', 'nombre 000003', 'apellido 000003', 'domicilio fiscal 000003', NULL, NULL, 'cliente3@correo.es', 'cliente3'),
('ZA000004', 7, 'ID000004', 'nombre 000004', 'apellido 000004', 'domicilio fiscal 000004', NULL, NULL, 'cliente4@correo.es', 'cliente4'),
('ZA000005', 8, 'ID000005', 'nombre 000005', 'apellido 000005', 'domicilio fiscal 000005', NULL, NULL, 'cliente5@correo.es', 'cliente5'),
('ZA000006', 9, 'ID000006', 'nombre 000006', 'apellido 000006', 'domicilio fiscal 000006', NULL, NULL, 'cliente6@correo.es', 'cliente6'),
('ZA000007', 10, 'ID000007', 'nombre 000007', 'apellido 000007', 'domicilio fiscal 000007', NULL, NULL, 'cliente7@correo.es', 'cliente7'),
('ZA000008', 11, 'ID000008', 'nombre 000008', 'apellido 000008', 'domicilio fiscal 000008', NULL, NULL, 'cliente8@correo.es', 'cliente8'),
('ZA000009', 12, 'ID000009', 'nombre 000009', 'apellido 000009', 'domicilio fiscal 000009', NULL, NULL, 'cliente9@correo.es', 'cliente9'),
('ZA000010', 13, 'ID000010', 'nombre 000010', 'apellido 000010', 'domicilio fiscal 000010', NULL, NULL, 'cliente10@correo.es', 'cliente10'),
('ZA000011', 14, 'ID000011', 'nombre 000011', 'apellido 000011', 'domicilio fiscal 000011', NULL, NULL, 'cliente11@correo.es', 'cliente11'),
('ZA000012', 15, 'ID000012', 'nombre 000012', 'apellido 000012', 'domicilio fiscal 000012', NULL, NULL, 'cliente12@correo.es', 'cliente12'),
('ZA000013', 16, 'ID000013', 'nombre 000013', 'apellido 000013', 'domicilio fiscal 000013', NULL, NULL, 'cliente13@correo.es', 'cliente13'),
('ZA000014', 17, 'ID000014', 'nombre 000014', 'apellido 000014', 'domicilio fiscal 000014', NULL, NULL, 'cliente14@correo.es', 'cliente14'),
('ZA000015', 18, 'ID000015', 'nombre 000015', 'apellido 000015', 'domicilio fiscal 000015', NULL, NULL, 'cliente15@correo.es', 'cliente15'),
('ZA000016', 19, 'ID000016', 'nombre 000016', 'apellido 000016', 'domicilio fiscal 000016', NULL, NULL, 'cliente16@correo.es', 'cliente16'),
('ZA000017', 20, 'ID000017', 'nombre 000017', 'apellido 000017', 'domicilio fiscal 000017', NULL, NULL, 'cliente17@correo.es', 'cliente17'),
('ZA000018', 21, 'ID000018', 'nombre 000018', 'apellido 000018', 'domicilio fiscal 000018', NULL, NULL, 'cliente18@correo.es', 'cliente18'),
('ZA000019', 22, 'ID000019', 'nombre 000019', 'apellido 000019', 'domicilio fiscal 000019', NULL, NULL, 'cliente19@correo.es', 'cliente19'),
('ZA000020', 23, 'ID000020', 'nombre 000020', 'apellido 000020', 'domicilio fiscal 000020', NULL, NULL, 'cliente20@correo.es', 'cliente20'),
('ZA000021', 24, 'ID000021', 'nombre 000021', 'apellido 000021', 'domicilio fiscal 000021', NULL, NULL, 'cliente21@correo.es', 'cliente21'),
('ZA000022', 25, 'ID000022', 'nombre 000022', 'apellido 000022', 'domicilio fiscal 000022', NULL, NULL, 'cliente22@correo.es', 'cliente22'),
('ZA000023', 26, 'ID000023', 'nombre 000023', 'apellido 000023', 'domicilio fiscal 000023', NULL, NULL, 'cliente23@correo.es', 'cliente23'),
('ZA000024', 27, 'ID000024', 'nombre 000024', 'apellido 000024', 'domicilio fiscal 000024', NULL, NULL, 'cliente24@correo.es', 'cliente24'),
('ZA000025', 28, 'ID000025', 'nombre 000025', 'apellido 000025', 'domicilio fiscal 000025', NULL, NULL, 'cliente25@correo.es', 'cliente25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `idOferta` int(5) NOT NULL COMMENT 'Identificador de la linea de oferta.',
  `refArt` varchar(10) NOT NULL COMMENT 'Referencia al articulo relacionado.',
  `precio` float NOT NULL COMMENT 'Precio del articulo con 2 decimales',
  `activa` tinyint(1) NOT NULL COMMENT 'Si la oferta esta activa o no.',
  `notas` text DEFAULT NULL COMMENT 'Notas internas para la Oferta.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`idOferta`, `refArt`, `precio`, `activa`, `notas`) VALUES
(1, 'ART000001', 9.5, 1, 'Oferta1'),
(2, 'ART000002', 12.99, 1, 'Ofertas2'),
(3, 'ART000003', 19, 1, 'Oferta3'),
(4, 'ART000004', 15.5, 1, 'Oferta4'),
(5, 'ART000005', 40, 1, 'Rebajado por agotamiento de stock');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `serie` varchar(4) NOT NULL COMMENT 'Serie del Pedido como un texto o el año en curso',
  `numero` int(6) NOT NULL COMMENT 'Numero del pedido que debe ser unico dentro de la serie',
  `fecha` date NOT NULL COMMENT 'Fecha del pedido en formato sql "AAAA-MM-DD"',
  `refCli` varchar(10) NOT NULL COMMENT 'Cliente asociado al pedido',
  `domEnvio` varchar(250) NOT NULL COMMENT 'Domicilio de envio del pedido, se propone el que tiene el cliente pero se puede modificar',
  `estado` int(1) NOT NULL DEFAULT 0 COMMENT 'Estado del Pedido: 0=Abierto/Pendiente, 1=Bloqueado/Preparacion, 2=Bloqueado/Enviado, 3=Cerrado/Recibido, 4=Cerrado/Anulado',
  `notas` text DEFAULT NULL COMMENT 'Notas internas para el Pedido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`serie`, `numero`, `fecha`, `refCli`, `domEnvio`, `estado`, `notas`) VALUES
('2018', 1, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00001\".', 3, NULL),
('2018', 2, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00002\".', 4, NULL),
('2018', 3, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00003\".', 4, NULL),
('2018', 4, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00004\".', 5, NULL),
('2018', 5, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00005\".', 2, NULL),
('2018', 6, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00006\".', 2, NULL),
('2018', 7, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00007\".', 5, NULL),
('2018', 8, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00008\".', 5, NULL),
('2018', 9, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00009\".', 0, NULL),
('2018', 10, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00010\".', 0, NULL),
('2018', 11, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00011\".', 4, NULL),
('2018', 12, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00012\".', 5, NULL),
('2018', 13, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00013\".', 1, NULL),
('2018', 14, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00014\".', 3, NULL),
('2018', 15, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00015\".', 1, NULL),
('2018', 16, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00016\".', 4, NULL),
('2018', 17, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00017\".', 1, NULL),
('2018', 18, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00018\".', 5, NULL),
('2018', 19, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00019\".', 2, NULL),
('2018', 20, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00020\".', 1, NULL),
('2018', 21, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00021\".', 3, NULL),
('2018', 22, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00022\".', 2, NULL),
('2018', 23, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00023\".', 0, NULL),
('2018', 24, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00024\".', 6, NULL),
('2018', 25, '2018-10-02', 'ZA000002', 'domicilio de envio del pedido \"2018/00025\".', 0, NULL),
('2025', 1, '2025-11-23', 'ZA000001', 'domicilio fiscal 000001', 6, ' [PAGO TPV: ERROR]'),
('2025', 2, '2025-11-23', 'ZA000001', 'domicilio fiscal 000001', 1, ' [PAGO TPV: OK 23/11 18:52]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoslin`
--

CREATE TABLE `pedidoslin` (
  `idLinea` int(5) NOT NULL COMMENT 'Identificador de la linea del pedido para facilitar los accesos',
  `serie` varchar(4) NOT NULL COMMENT 'Serie del pedido al que pertenece la linea',
  `numero` int(6) NOT NULL COMMENT 'Numero del pedido al que pertenece la linea',
  `orden` int(5) NOT NULL COMMENT 'Orden de la linea dentro del pedido, se deberia poder cambiar una linea de posicion en el orden',
  `refArt` varchar(10) DEFAULT NULL COMMENT 'Articulo asociado a la linea o "NULO" si es linea de texto libre',
  `texto` text NOT NULL COMMENT 'Texto copiado del articulo o el texto libre que se haya introducido',
  `cantidad` int(5) NOT NULL COMMENT 'Cantidad de unidades, puede ser negativo para devoluciones',
  `precio` float NOT NULL COMMENT 'Precio del articulo con 2 decimales, copiado inicialmente del articulo pero modificable, no deberia ser negativo',
  `iva` float NOT NULL COMMENT 'Tipo de IVA del articulo en porcentaje, copiado inicialmente del articulo',
  `importeBase` float NOT NULL COMMENT 'Importe precalculado de la Cantidad * Precio, para facilitar su tratamiento',
  `cuotaIva` float NOT NULL COMMENT 'Importe precalculado del importeBase * iva / 100, para facilitar su tratamiento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pedidoslin`
--

INSERT INTO `pedidoslin` (`idLinea`, `serie`, `numero`, `orden`, `refArt`, `texto`, `cantidad`, `precio`, `iva`, `importeBase`, `cuotaIva`) VALUES
(1, '2018', 1, 1, 'ART000011', 'texto 000011', 35, 140.91, 10, 4931.85, 493.185),
(2, '2018', 1, 2, 'ART000011', 'texto 000011', 82, 140.91, 10, 11554.6, 1155.46),
(3, '2018', 1, 3, NULL, 'Linea libre para el articulo \"ART000029\"', 11, 67.42, 21, 741.62, 155.74),
(4, '2018', 1, 4, 'ART000019', 'texto 000019', 76, 250.42, 10, 19031.9, 1903.19),
(5, '2018', 1, 5, NULL, 'Linea libre para el articulo \"ART000035\"', 77, 9.11, 21, 701.47, 147.309),
(6, '2018', 1, 6, 'ART000009', 'texto 000009', 86, 111.33, 10, 9574.38, 957.438),
(7, '2018', 1, 7, 'ART000024', 'texto 000024', 83, 120, 10, 9960, 996),
(8, '2018', 1, 8, 'ART000006', 'texto 000006', 10, 22.02, 10, 220.2, 22.02),
(9, '2018', 1, 9, NULL, 'Linea libre para el articulo \"ART000027\"', 60, 24.46, 21, 1467.6, 308.196),
(10, '2018', 1, 10, 'ART000002', 'texto 000002', 32, 15.24, 10, 487.68, 48.768),
(11, '2018', 1, 11, 'ART000009', 'texto 000009', 48, 111.33, 10, 5343.84, 534.384),
(12, '2018', 1, 12, NULL, 'Linea libre para el articulo \"ART000028\"', 84, 82.7, 21, 6946.8, 1458.83),
(13, '2018', 1, 13, 'ART000011', 'texto 000011', 53, 140.91, 10, 7468.23, 746.823),
(14, '2018', 1, 14, NULL, 'Linea libre para el articulo \"ART000037\"', 26, 11.86, 21, 308.36, 64.7556),
(15, '2018', 1, 15, 'ART000011', 'texto 000011', 26, 140.91, 10, 3663.66, 366.366),
(16, '2018', 1, 16, 'ART000006', 'texto 000006', 49, 22.02, 10, 1078.98, 107.898),
(17, '2018', 1, 17, 'ART000010', 'texto 000010', 50, 83, 10, 4150, 415),
(18, '2018', 1, 18, 'ART000012', 'texto 000012', 28, 162.84, 10, 4559.52, 455.952),
(19, '2018', 1, 19, NULL, 'Linea libre para el articulo \"ART000034\"', 95, 47.79, 21, 4540.05, 953.411),
(20, '2018', 1, 20, 'ART000018', 'texto 000018', 33, 147.06, 10, 4852.98, 485.298),
(21, '2018', 1, 21, NULL, 'Linea libre para el articulo \"ART000037\"', 27, 60.94, 21, 1645.38, 345.53),
(22, '2018', 2, 1, NULL, 'Linea libre para el articulo \"ART000033\"', 89, 26.37, 21, 2346.93, 492.855),
(23, '2018', 2, 2, NULL, 'Linea libre para el articulo \"ART000030\"', 18, 22.8, 21, 410.4, 86.184),
(24, '2018', 2, 3, 'ART000019', 'texto 000019', 43, 250.42, 10, 10768.1, 1076.81),
(25, '2018', 2, 4, 'ART000009', 'texto 000009', 62, 111.33, 10, 6902.46, 690.246),
(26, '2018', 2, 5, NULL, 'Linea libre para el articulo \"ART000040\"', 22, 79.4, 21, 1746.8, 366.828),
(27, '2018', 2, 6, 'ART000022', 'texto 000022', 89, 302.28, 10, 26902.9, 2690.29),
(28, '2018', 2, 7, NULL, 'Linea libre para el articulo \"ART000026\"', 61, 88.97, 21, 5427.17, 1139.71),
(29, '2018', 2, 8, NULL, 'Linea libre para el articulo \"ART000033\"', 3, 73.13, 21, 219.39, 46.0719),
(30, '2018', 2, 9, NULL, 'Linea libre para el articulo \"ART000039\"', 6, 63.26, 21, 379.56, 79.7076),
(31, '2018', 2, 10, 'ART000004', 'texto 000004', 24, 20.48, 10, 491.52, 49.152),
(32, '2018', 2, 11, NULL, 'Linea libre para el articulo \"ART000034\"', 5, 97.74, 21, 488.7, 102.627),
(33, '2018', 2, 12, NULL, 'Linea libre para el articulo \"ART000036\"', 28, 65.11, 21, 1823.08, 382.847),
(34, '2018', 2, 13, NULL, 'Linea libre para el articulo \"ART000039\"', 56, 16.22, 21, 908.32, 190.747),
(35, '2018', 2, 14, NULL, 'Linea libre para el articulo \"ART000040\"', 98, 77.59, 21, 7603.82, 1596.8),
(36, '2018', 2, 15, NULL, 'Linea libre para el articulo \"ART000040\"', 91, 93.57, 21, 8514.87, 1788.12),
(37, '2018', 2, 16, 'ART000025', 'texto 000025', 3, 244.5, 10, 733.5, 73.35),
(38, '2018', 3, 1, 'ART000014', 'texto 000014', 40, 162.96, 10, 6518.4, 651.84),
(39, '2018', 3, 2, NULL, 'Linea libre para el articulo \"ART000032\"', 97, 85.59, 21, 8302.23, 1743.47),
(40, '2018', 3, 3, 'ART000011', 'texto 000011', 98, 140.91, 10, 13809.2, 1380.92),
(41, '2018', 3, 4, NULL, 'Linea libre para el articulo \"ART000026\"', 95, 25.91, 21, 2461.45, 516.904),
(42, '2018', 3, 5, NULL, 'Linea libre para el articulo \"ART000037\"', 94, 26.57, 21, 2497.58, 524.492),
(43, '2018', 3, 6, 'ART000014', 'texto 000014', 35, 162.96, 10, 5703.6, 570.36),
(44, '2018', 3, 7, 'ART000015', 'texto 000015', 19, 36.45, 10, 692.55, 69.255),
(45, '2018', 3, 8, 'ART000001', 'texto 000001', 94, 11.31, 21, 1063.14, 223.259),
(46, '2018', 3, 9, 'ART000025', 'texto 000025', 47, 244.5, 10, 11491.5, 1149.15),
(47, '2018', 3, 10, 'ART000003', 'texto 000003', 33, 23.88, 10, 788.04, 78.804),
(48, '2018', 3, 11, NULL, 'Linea libre para el articulo \"ART000028\"', 63, 90.46, 21, 5698.98, 1196.79),
(49, '2018', 3, 12, 'ART000003', 'texto 000003', 25, 23.88, 10, 597, 59.7),
(50, '2018', 3, 13, NULL, 'Linea libre para el articulo \"ART000037\"', 50, 86.79, 21, 4339.5, 911.295),
(51, '2018', 3, 14, 'ART000004', 'texto 000004', 16, 20.48, 10, 327.68, 32.768),
(52, '2018', 3, 15, 'ART000011', 'texto 000011', 27, 140.91, 10, 3804.57, 380.457),
(53, '2018', 3, 16, NULL, 'Linea libre para el articulo \"ART000040\"', 1, 27.75, 21, 27.75, 5.8275),
(54, '2018', 3, 17, NULL, 'Linea libre para el articulo \"ART000040\"', 18, 23, 21, 414, 86.94),
(55, '2018', 3, 18, 'ART000024', 'texto 000024', 1, 120, 10, 120, 12),
(56, '2018', 3, 19, 'ART000016', 'texto 000016', 97, 84.16, 10, 8163.52, 816.352),
(57, '2018', 3, 20, NULL, 'Linea libre para el articulo \"ART000035\"', 71, 92.01, 21, 6532.71, 1371.87),
(58, '2018', 3, 21, 'ART000023', 'texto 000023', 40, 100.05, 10, 4002, 400.2),
(59, '2018', 3, 22, 'ART000005', 'texto 000005', 47, 50.05, 10, 2352.35, 235.235),
(60, '2018', 4, 1, NULL, 'Linea libre para el articulo \"ART000032\"', 38, 66.96, 21, 2544.48, 534.341),
(61, '2018', 4, 2, 'ART000003', 'texto 000003', 23, 23.88, 10, 549.24, 54.924),
(62, '2018', 4, 3, 'ART000003', 'texto 000003', 4, 23.88, 10, 95.52, 9.552),
(63, '2018', 4, 4, 'ART000001', 'texto 000001', 98, 11.31, 21, 1108.38, 232.76),
(64, '2018', 4, 5, 'ART000008', 'texto 000008', 30, 19.36, 10, 580.8, 58.08),
(65, '2018', 4, 6, NULL, 'Linea libre para el articulo \"ART000026\"', 81, 43.34, 21, 3510.54, 737.213),
(66, '2018', 4, 7, NULL, 'Linea libre para el articulo \"ART000036\"', 15, 38.11, 21, 571.65, 120.047),
(67, '2018', 4, 8, 'ART000008', 'texto 000008', 65, 19.36, 10, 1258.4, 125.84),
(68, '2018', 4, 9, 'ART000002', 'texto 000002', 71, 15.24, 10, 1082.04, 108.204),
(69, '2018', 4, 10, NULL, 'Linea libre para el articulo \"ART000029\"', 79, 44.85, 21, 3543.15, 744.062),
(70, '2018', 4, 11, 'ART000019', 'texto 000019', 85, 250.42, 10, 21285.7, 2128.57),
(71, '2018', 4, 12, 'ART000005', 'texto 000005', 39, 50.05, 10, 1951.95, 195.195),
(72, '2018', 4, 13, 'ART000022', 'texto 000022', 67, 302.28, 10, 20252.8, 2025.28),
(73, '2018', 4, 14, 'ART000023', 'texto 000023', 8, 100.05, 10, 800.4, 80.04),
(74, '2018', 4, 15, NULL, 'Linea libre para el articulo \"ART000026\"', 80, 84.92, 21, 6793.6, 1426.66),
(75, '2018', 4, 16, 'ART000023', 'texto 000023', 88, 100.05, 10, 8804.4, 880.44),
(76, '2018', 4, 17, 'ART000018', 'texto 000018', 68, 147.06, 10, 10000.1, 1000.01),
(77, '2018', 4, 18, 'ART000005', 'texto 000005', 97, 50.05, 10, 4854.85, 485.485),
(78, '2018', 4, 19, NULL, 'Linea libre para el articulo \"ART000033\"', 79, 85.42, 21, 6748.18, 1417.12),
(79, '2018', 4, 20, NULL, 'Linea libre para el articulo \"ART000038\"', 90, 64.04, 21, 5763.6, 1210.36),
(80, '2018', 4, 21, 'ART000011', 'texto 000011', 71, 140.91, 10, 10004.6, 1000.46),
(81, '2018', 5, 1, 'ART000011', 'texto 000011', 28, 140.91, 10, 3945.48, 394.548),
(82, '2018', 5, 2, 'ART000011', 'texto 000011', 87, 140.91, 10, 12259.2, 1225.92),
(83, '2018', 5, 3, NULL, 'Linea libre para el articulo \"ART000037\"', 61, 48.8, 21, 2976.8, 625.128),
(84, '2018', 5, 4, NULL, 'Linea libre para el articulo \"ART000033\"', 22, 11.85, 21, 260.7, 54.747),
(85, '2018', 5, 5, 'ART000018', 'texto 000018', 40, 147.06, 10, 5882.4, 588.24),
(86, '2018', 5, 6, NULL, 'Linea libre para el articulo \"ART000027\"', 84, 14.87, 21, 1249.08, 262.307),
(87, '2018', 5, 7, NULL, 'Linea libre para el articulo \"ART000030\"', 82, 88.88, 21, 7288.16, 1530.51),
(88, '2018', 5, 8, NULL, 'Linea libre para el articulo \"ART000028\"', 5, 2.97, 21, 14.85, 3.1185),
(89, '2018', 5, 9, 'ART000007', 'texto 000007', 30, 95.06, 10, 2851.8, 285.18),
(90, '2018', 5, 10, NULL, 'Linea libre para el articulo \"ART000034\"', 15, 28.5, 21, 427.5, 89.775),
(91, '2018', 5, 11, NULL, 'Linea libre para el articulo \"ART000040\"', 19, 69.89, 21, 1327.91, 278.861),
(92, '2018', 5, 12, 'ART000014', 'texto 000014', 28, 162.96, 10, 4562.88, 456.288),
(93, '2018', 5, 13, 'ART000002', 'texto 000002', 90, 15.24, 10, 1371.6, 137.16),
(94, '2018', 5, 14, NULL, 'Linea libre para el articulo \"ART000028\"', 4, 23.66, 21, 94.64, 19.8744),
(95, '2018', 6, 1, 'ART000022', 'texto 000022', 6, 302.28, 10, 1813.68, 181.368),
(96, '2018', 6, 2, 'ART000017', 'texto 000017', 23, 20.74, 10, 477.02, 47.702),
(97, '2018', 6, 3, 'ART000022', 'texto 000022', 6, 302.28, 10, 1813.68, 181.368),
(98, '2018', 6, 4, 'ART000021', 'texto 000021', 89, 245.28, 10, 21829.9, 2182.99),
(99, '2018', 6, 5, NULL, 'Linea libre para el articulo \"ART000029\"', 4, 31.71, 21, 126.84, 26.6364),
(100, '2018', 6, 6, 'ART000007', 'texto 000007', 54, 95.06, 10, 5133.24, 513.324),
(101, '2018', 7, 1, NULL, 'Linea libre para el articulo \"ART000039\"', 25, 69.55, 21, 1738.75, 365.138),
(102, '2018', 7, 2, 'ART000018', 'texto 000018', 73, 147.06, 10, 10735.4, 1073.54),
(103, '2018', 7, 3, 'ART000009', 'texto 000009', 52, 111.33, 10, 5789.16, 578.916),
(104, '2018', 7, 4, NULL, 'Linea libre para el articulo \"ART000030\"', 20, 93.75, 21, 1875, 393.75),
(105, '2018', 7, 5, NULL, 'Linea libre para el articulo \"ART000040\"', 9, 90.01, 21, 810.09, 170.119),
(106, '2018', 7, 6, 'ART000003', 'texto 000003', 69, 23.88, 10, 1647.72, 164.772),
(107, '2018', 8, 1, 'ART000010', 'texto 000010', 95, 83, 10, 7885, 788.5),
(108, '2018', 8, 2, NULL, 'Linea libre para el articulo \"ART000039\"', 20, 15.33, 21, 306.6, 64.386),
(109, '2018', 8, 3, 'ART000022', 'texto 000022', 54, 302.28, 10, 16323.1, 1632.31),
(110, '2018', 8, 4, 'ART000015', 'texto 000015', 96, 36.45, 10, 3499.2, 349.92),
(111, '2018', 8, 5, 'ART000008', 'texto 000008', 35, 19.36, 10, 677.6, 67.76),
(112, '2018', 8, 6, NULL, 'Linea libre para el articulo \"ART000038\"', 11, 9.4, 21, 103.4, 21.714),
(113, '2018', 8, 7, 'ART000004', 'texto 000004', 47, 20.48, 10, 962.56, 96.256),
(114, '2018', 8, 8, 'ART000004', 'texto 000004', 40, 20.48, 10, 819.2, 81.92),
(115, '2018', 8, 9, 'ART000021', 'texto 000021', 37, 245.28, 10, 9075.36, 907.536),
(116, '2018', 8, 10, NULL, 'Linea libre para el articulo \"ART000032\"', 77, 3.66, 21, 281.82, 59.1822),
(117, '2018', 8, 11, 'ART000015', 'texto 000015', 54, 36.45, 10, 1968.3, 196.83),
(118, '2018', 8, 12, 'ART000022', 'texto 000022', 69, 302.28, 10, 20857.3, 2085.73),
(119, '2018', 8, 13, 'ART000019', 'texto 000019', 47, 250.42, 10, 11769.7, 1176.97),
(120, '2018', 8, 14, 'ART000021', 'texto 000021', 99, 245.28, 10, 24282.7, 2428.27),
(121, '2018', 8, 15, NULL, 'Linea libre para el articulo \"ART000033\"', 38, 83.12, 21, 3158.56, 663.298),
(122, '2018', 8, 16, 'ART000018', 'texto 000018', 85, 147.06, 10, 12500.1, 1250.01),
(123, '2018', 8, 17, 'ART000009', 'texto 000009', 99, 111.33, 10, 11021.7, 1102.17),
(124, '2018', 8, 18, NULL, 'Linea libre para el articulo \"ART000028\"', 89, 77.73, 21, 6917.97, 1452.77),
(125, '2018', 8, 19, 'ART000011', 'texto 000011', 98, 140.91, 10, 13809.2, 1380.92),
(126, '2018', 8, 20, NULL, 'Linea libre para el articulo \"ART000026\"', 8, 45.52, 21, 364.16, 76.4736),
(127, '2018', 8, 21, NULL, 'Linea libre para el articulo \"ART000040\"', 100, 86.35, 21, 8635, 1813.35),
(128, '2018', 8, 22, 'ART000017', 'texto 000017', 17, 20.74, 10, 352.58, 35.258),
(129, '2018', 8, 23, 'ART000004', 'texto 000004', 34, 20.48, 10, 696.32, 69.632),
(130, '2018', 9, 1, 'ART000015', 'texto 000015', 1, 36.45, 10, 36.45, 3.645),
(131, '2018', 9, 2, 'ART000014', 'texto 000014', 66, 162.96, 10, 10755.4, 1075.54),
(132, '2018', 9, 3, 'ART000013', 'texto 000013', 87, 131.95, 10, 11479.7, 1147.96),
(133, '2018', 9, 4, 'ART000020', 'texto 000020', 89, 220.2, 10, 19597.8, 1959.78),
(134, '2018', 9, 5, NULL, 'Linea libre para el articulo \"ART000035\"', 12, 69.01, 21, 828.12, 173.905),
(135, '2018', 9, 6, NULL, 'Linea libre para el articulo \"ART000037\"', 30, 1.67, 21, 50.1, 10.521),
(136, '2018', 9, 7, NULL, 'Linea libre para el articulo \"ART000033\"', 57, 80.18, 21, 4570.26, 959.755),
(137, '2018', 9, 8, NULL, 'Linea libre para el articulo \"ART000037\"', 11, 16.55, 21, 182.05, 38.2305),
(138, '2018', 9, 9, 'ART000019', 'texto 000019', 41, 250.42, 10, 10267.2, 1026.72),
(139, '2018', 9, 10, 'ART000001', 'texto 000001', 1, 11.31, 21, 11.31, 2.3751),
(140, '2018', 9, 11, NULL, 'Linea libre para el articulo \"ART000032\"', 77, 91.33, 21, 7032.41, 1476.81),
(141, '2018', 9, 12, 'ART000019', 'texto 000019', 52, 250.42, 10, 13021.8, 1302.18),
(142, '2018', 9, 13, 'ART000023', 'texto 000023', 73, 100.05, 10, 7303.65, 730.365),
(143, '2018', 9, 14, 'ART000007', 'texto 000007', 17, 95.06, 10, 1616.02, 161.602),
(144, '2018', 9, 15, NULL, 'Linea libre para el articulo \"ART000034\"', 8, 93.12, 21, 744.96, 156.442),
(145, '2018', 9, 16, NULL, 'Linea libre para el articulo \"ART000027\"', 30, 21.02, 21, 630.6, 132.426),
(146, '2018', 9, 17, NULL, 'Linea libre para el articulo \"ART000030\"', 80, 64.71, 21, 5176.8, 1087.13),
(147, '2018', 9, 18, 'ART000006', 'texto 000006', 36, 22.02, 10, 792.72, 79.272),
(148, '2018', 10, 1, 'ART000008', 'texto 000008', 36, 19.36, 10, 696.96, 69.696),
(149, '2018', 10, 2, 'ART000004', 'texto 000004', 82, 20.48, 10, 1679.36, 167.936),
(150, '2018', 10, 3, NULL, 'Linea libre para el articulo \"ART000035\"', 81, 87.81, 21, 7112.61, 1493.65),
(151, '2018', 10, 4, 'ART000001', 'texto 000001', 60, 11.31, 21, 678.6, 142.506),
(152, '2018', 10, 5, NULL, 'Linea libre para el articulo \"ART000036\"', 16, 3.78, 21, 60.48, 12.7008),
(153, '2018', 10, 6, 'ART000020', 'texto 000020', 55, 220.2, 10, 12111, 1211.1),
(154, '2018', 10, 7, 'ART000004', 'texto 000004', 78, 20.48, 10, 1597.44, 159.744),
(155, '2018', 10, 8, 'ART000012', 'texto 000012', 94, 162.84, 10, 15307, 1530.7),
(156, '2018', 11, 1, 'ART000013', 'texto 000013', 80, 131.95, 10, 10556, 1055.6),
(157, '2018', 11, 2, NULL, 'Linea libre para el articulo \"ART000028\"', 28, 43.34, 21, 1213.52, 254.839),
(158, '2018', 11, 3, 'ART000008', 'texto 000008', 73, 19.36, 10, 1413.28, 141.328),
(159, '2018', 11, 4, 'ART000008', 'texto 000008', 9, 19.36, 10, 174.24, 17.424),
(160, '2018', 11, 5, 'ART000006', 'texto 000006', 64, 22.02, 10, 1409.28, 140.928),
(161, '2018', 11, 6, 'ART000021', 'texto 000021', 79, 245.28, 10, 19377.1, 1937.71),
(162, '2018', 11, 7, 'ART000019', 'texto 000019', 39, 250.42, 10, 9766.38, 976.638),
(163, '2018', 11, 8, 'ART000011', 'texto 000011', 56, 140.91, 10, 7890.96, 789.096),
(164, '2018', 11, 9, 'ART000025', 'texto 000025', 100, 244.5, 10, 24450, 2445),
(165, '2018', 11, 10, NULL, 'Linea libre para el articulo \"ART000037\"', 49, 30.54, 21, 1496.46, 314.257),
(166, '2018', 11, 11, 'ART000012', 'texto 000012', 88, 162.84, 10, 14329.9, 1432.99),
(167, '2018', 11, 12, NULL, 'Linea libre para el articulo \"ART000038\"', 6, 91.25, 21, 547.5, 114.975),
(168, '2018', 11, 13, 'ART000019', 'texto 000019', 24, 250.42, 10, 6010.08, 601.008),
(169, '2018', 11, 14, 'ART000017', 'texto 000017', 50, 20.74, 10, 1037, 103.7),
(170, '2018', 11, 15, NULL, 'Linea libre para el articulo \"ART000039\"', 72, 3.62, 21, 260.64, 54.7344),
(171, '2018', 11, 16, 'ART000008', 'texto 000008', 91, 19.36, 10, 1761.76, 176.176),
(172, '2018', 11, 17, NULL, 'Linea libre para el articulo \"ART000030\"', 94, 38.45, 21, 3614.3, 759.003),
(173, '2018', 11, 18, 'ART000001', 'texto 000001', 83, 11.31, 21, 938.73, 197.133),
(174, '2018', 11, 19, NULL, 'Linea libre para el articulo \"ART000038\"', 3, 6.23, 21, 18.69, 3.9249),
(175, '2018', 11, 20, NULL, 'Linea libre para el articulo \"ART000033\"', 98, 88.42, 21, 8665.16, 1819.68),
(176, '2018', 12, 1, 'ART000003', 'texto 000003', 58, 23.88, 10, 1385.04, 138.504),
(177, '2018', 12, 2, NULL, 'Linea libre para el articulo \"ART000039\"', 59, 24.04, 21, 1418.36, 297.856),
(178, '2018', 12, 3, 'ART000018', 'texto 000018', 100, 147.06, 10, 14706, 1470.6),
(179, '2018', 12, 4, NULL, 'Linea libre para el articulo \"ART000027\"', 11, 45.69, 21, 502.59, 105.544),
(180, '2018', 12, 5, 'ART000011', 'texto 000011', 38, 140.91, 10, 5354.58, 535.458),
(181, '2018', 12, 6, NULL, 'Linea libre para el articulo \"ART000027\"', 49, 70.42, 21, 3450.58, 724.622),
(182, '2018', 12, 7, NULL, 'Linea libre para el articulo \"ART000040\"', 74, 82.99, 21, 6141.26, 1289.66),
(183, '2018', 12, 8, 'ART000011', 'texto 000011', 89, 140.91, 10, 12541, 1254.1),
(184, '2018', 12, 9, 'ART000009', 'texto 000009', 34, 111.33, 10, 3785.22, 378.522),
(185, '2018', 12, 10, 'ART000019', 'texto 000019', 18, 250.42, 10, 4507.56, 450.756),
(186, '2018', 12, 11, 'ART000005', 'texto 000005', 49, 50.05, 10, 2452.45, 245.245),
(187, '2018', 12, 12, 'ART000011', 'texto 000011', 56, 140.91, 10, 7890.96, 789.096),
(188, '2018', 12, 13, NULL, 'Linea libre para el articulo \"ART000030\"', 21, 33.59, 21, 705.39, 148.132),
(189, '2018', 12, 14, 'ART000021', 'texto 000021', 48, 245.28, 10, 11773.4, 1177.34),
(190, '2018', 12, 15, 'ART000008', 'texto 000008', 33, 19.36, 10, 638.88, 63.888),
(191, '2018', 12, 16, 'ART000012', 'texto 000012', 83, 162.84, 10, 13515.7, 1351.57),
(192, '2018', 12, 17, 'ART000023', 'texto 000023', 35, 100.05, 10, 3501.75, 350.175),
(193, '2018', 12, 18, 'ART000017', 'texto 000017', 77, 20.74, 10, 1596.98, 159.698),
(194, '2018', 12, 19, 'ART000016', 'texto 000016', 94, 84.16, 10, 7911.04, 791.104),
(195, '2018', 12, 20, NULL, 'Linea libre para el articulo \"ART000037\"', 100, 0.23, 21, 23, 4.83),
(196, '2018', 12, 21, NULL, 'Linea libre para el articulo \"ART000026\"', 29, 14.27, 21, 413.83, 86.9043),
(197, '2018', 12, 22, NULL, 'Linea libre para el articulo \"ART000039\"', 92, 29.45, 21, 2709.4, 568.974),
(198, '2018', 12, 23, 'ART000006', 'texto 000006', 24, 22.02, 10, 528.48, 52.848),
(199, '2018', 12, 24, NULL, 'Linea libre para el articulo \"ART000038\"', 17, 0.42, 21, 7.14, 1.4994),
(200, '2018', 13, 1, 'ART000025', 'texto 000025', 80, 244.5, 10, 19560, 1956),
(201, '2018', 13, 2, NULL, 'Linea libre para el articulo \"ART000039\"', 64, 59.9, 21, 3833.6, 805.056),
(202, '2018', 13, 3, NULL, 'Linea libre para el articulo \"ART000033\"', 17, 13.75, 21, 233.75, 49.0875),
(203, '2018', 13, 4, NULL, 'Linea libre para el articulo \"ART000026\"', 11, 19.22, 21, 211.42, 44.3982),
(204, '2018', 13, 5, 'ART000017', 'texto 000017', 51, 20.74, 10, 1057.74, 105.774),
(205, '2018', 13, 6, 'ART000021', 'texto 000021', 81, 245.28, 10, 19867.7, 1986.77),
(206, '2018', 13, 7, NULL, 'Linea libre para el articulo \"ART000039\"', 32, 17.27, 21, 552.64, 116.054),
(207, '2018', 13, 8, 'ART000016', 'texto 000016', 23, 84.16, 10, 1935.68, 193.568),
(208, '2018', 13, 9, 'ART000013', 'texto 000013', 64, 131.95, 10, 8444.8, 844.48),
(209, '2018', 13, 10, 'ART000020', 'texto 000020', 30, 220.2, 10, 6606, 660.6),
(210, '2018', 13, 11, NULL, 'Linea libre para el articulo \"ART000035\"', 52, 87.75, 21, 4563, 958.23),
(211, '2018', 13, 12, 'ART000019', 'texto 000019', 99, 250.42, 10, 24791.6, 2479.16),
(212, '2018', 13, 13, 'ART000004', 'texto 000004', 66, 20.48, 10, 1351.68, 135.168),
(213, '2018', 13, 14, 'ART000007', 'texto 000007', 75, 95.06, 10, 7129.5, 712.95),
(214, '2018', 13, 15, 'ART000001', 'texto 000001', 95, 11.31, 21, 1074.45, 225.635),
(215, '2018', 13, 16, 'ART000008', 'texto 000008', 68, 19.36, 10, 1316.48, 131.648),
(216, '2018', 14, 1, 'ART000011', 'texto 000011', 97, 140.91, 10, 13668.3, 1366.83),
(217, '2018', 14, 2, NULL, 'Linea libre para el articulo \"ART000036\"', 4, 87.78, 21, 351.12, 73.7352),
(218, '2018', 14, 3, NULL, 'Linea libre para el articulo \"ART000035\"', 20, 35.29, 21, 705.8, 148.218),
(219, '2018', 14, 4, 'ART000022', 'texto 000022', 15, 302.28, 10, 4534.2, 453.42),
(220, '2018', 14, 5, NULL, 'Linea libre para el articulo \"ART000033\"', 22, 42.89, 21, 943.58, 198.152),
(221, '2018', 14, 6, 'ART000003', 'texto 000003', 48, 23.88, 10, 1146.24, 114.624),
(222, '2018', 14, 7, NULL, 'Linea libre para el articulo \"ART000037\"', 10, 48.2, 21, 482, 101.22),
(223, '2018', 15, 1, 'ART000007', 'texto 000007', 46, 95.06, 10, 4372.76, 437.276),
(224, '2018', 15, 2, 'ART000008', 'texto 000008', 11, 19.36, 10, 212.96, 21.296),
(225, '2018', 15, 3, 'ART000023', 'texto 000023', 16, 100.05, 10, 1600.8, 160.08),
(226, '2018', 15, 4, NULL, 'Linea libre para el articulo \"ART000026\"', 36, 97.62, 21, 3514.32, 738.007),
(227, '2018', 15, 5, 'ART000001', 'texto 000001', 80, 11.31, 21, 904.8, 190.008),
(228, '2018', 15, 6, NULL, 'Linea libre para el articulo \"ART000028\"', 53, 38.39, 21, 2034.67, 427.281),
(229, '2018', 15, 7, NULL, 'Linea libre para el articulo \"ART000028\"', 51, 4.87, 21, 248.37, 52.1577),
(230, '2018', 15, 8, NULL, 'Linea libre para el articulo \"ART000032\"', 93, 95.44, 21, 8875.92, 1863.94),
(231, '2018', 15, 9, 'ART000007', 'texto 000007', 11, 95.06, 10, 1045.66, 104.566),
(232, '2018', 15, 10, 'ART000003', 'texto 000003', 52, 23.88, 10, 1241.76, 124.176),
(233, '2018', 15, 11, NULL, 'Linea libre para el articulo \"ART000030\"', 8, 73.6, 21, 588.8, 123.648),
(234, '2018', 15, 12, 'ART000003', 'texto 000003', 3, 23.88, 10, 71.64, 7.164),
(235, '2018', 15, 13, 'ART000005', 'texto 000005', 96, 50.05, 10, 4804.8, 480.48),
(236, '2018', 15, 14, NULL, 'Linea libre para el articulo \"ART000028\"', 35, 45.16, 21, 1580.6, 331.926),
(237, '2018', 15, 15, 'ART000020', 'texto 000020', 70, 220.2, 10, 15414, 1541.4),
(238, '2018', 15, 16, 'ART000016', 'texto 000016', 30, 84.16, 10, 2524.8, 252.48),
(239, '2018', 15, 17, 'ART000019', 'texto 000019', 90, 250.42, 10, 22537.8, 2253.78),
(240, '2018', 15, 18, 'ART000005', 'texto 000005', 94, 50.05, 10, 4704.7, 470.47),
(241, '2018', 15, 19, 'ART000019', 'texto 000019', 54, 250.42, 10, 13522.7, 1352.27),
(242, '2018', 16, 1, 'ART000002', 'texto 000002', 38, 15.24, 10, 579.12, 57.912),
(243, '2018', 16, 2, NULL, 'Linea libre para el articulo \"ART000030\"', 84, 38.47, 21, 3231.48, 678.611),
(244, '2018', 16, 3, 'ART000022', 'texto 000022', 44, 302.28, 10, 13300.3, 1330.03),
(245, '2018', 16, 4, NULL, 'Linea libre para el articulo \"ART000031\"', 67, 24.52, 21, 1642.84, 344.996),
(246, '2018', 16, 5, 'ART000017', 'texto 000017', 94, 20.74, 10, 1949.56, 194.956),
(247, '2018', 16, 6, 'ART000025', 'texto 000025', 17, 244.5, 10, 4156.5, 415.65),
(248, '2018', 16, 7, NULL, 'Linea libre para el articulo \"ART000031\"', 74, 63.55, 21, 4702.7, 987.567),
(249, '2018', 16, 8, 'ART000023', 'texto 000023', 27, 100.05, 10, 2701.35, 270.135),
(250, '2018', 17, 1, NULL, 'Linea libre para el articulo \"ART000036\"', 30, 55.48, 21, 1664.4, 349.524),
(251, '2018', 17, 2, NULL, 'Linea libre para el articulo \"ART000040\"', 79, 56.11, 21, 4432.69, 930.865),
(252, '2018', 17, 3, 'ART000024', 'texto 000024', 71, 120, 10, 8520, 852),
(253, '2018', 17, 4, 'ART000004', 'texto 000004', 26, 20.48, 10, 532.48, 53.248),
(254, '2018', 17, 5, 'ART000004', 'texto 000004', 78, 20.48, 10, 1597.44, 159.744),
(255, '2018', 17, 6, NULL, 'Linea libre para el articulo \"ART000031\"', 22, 83.31, 21, 1832.82, 384.892),
(256, '2018', 17, 7, NULL, 'Linea libre para el articulo \"ART000029\"', 49, 67.31, 21, 3298.19, 692.62),
(257, '2018', 17, 8, 'ART000001', 'texto 000001', 13, 11.31, 21, 147.03, 30.8763),
(258, '2018', 17, 9, NULL, 'Linea libre para el articulo \"ART000027\"', 52, 10.77, 21, 560.04, 117.608),
(259, '2018', 17, 10, 'ART000006', 'texto 000006', 82, 22.02, 10, 1805.64, 180.564),
(260, '2018', 17, 11, 'ART000012', 'texto 000012', 74, 162.84, 10, 12050.2, 1205.02),
(261, '2018', 17, 12, 'ART000013', 'texto 000013', 58, 131.95, 10, 7653.1, 765.31),
(262, '2018', 17, 13, 'ART000024', 'texto 000024', 5, 120, 10, 600, 60),
(263, '2018', 17, 14, NULL, 'Linea libre para el articulo \"ART000034\"', 87, 74.56, 21, 6486.72, 1362.21),
(264, '2018', 18, 1, 'ART000007', 'texto 000007', 17, 95.06, 10, 1616.02, 161.602),
(265, '2018', 18, 2, 'ART000012', 'texto 000012', 14, 162.84, 10, 2279.76, 227.976),
(266, '2018', 18, 3, 'ART000014', 'texto 000014', 78, 162.96, 10, 12710.9, 1271.09),
(267, '2018', 18, 4, 'ART000018', 'texto 000018', 33, 147.06, 10, 4852.98, 485.298),
(268, '2018', 18, 5, NULL, 'Linea libre para el articulo \"ART000039\"', 87, 28.01, 21, 2436.87, 511.743),
(269, '2018', 18, 6, 'ART000001', 'texto 000001', 75, 11.31, 21, 848.25, 178.133),
(270, '2018', 18, 7, NULL, 'Linea libre para el articulo \"ART000026\"', 25, 34.99, 21, 874.75, 183.697),
(271, '2018', 18, 8, NULL, 'Linea libre para el articulo \"ART000036\"', 37, 42.56, 21, 1574.72, 330.691),
(272, '2018', 18, 9, 'ART000008', 'texto 000008', 18, 19.36, 10, 348.48, 34.848),
(273, '2018', 18, 10, 'ART000006', 'texto 000006', 24, 22.02, 10, 528.48, 52.848),
(274, '2018', 18, 11, 'ART000017', 'texto 000017', 50, 20.74, 10, 1037, 103.7),
(275, '2018', 18, 12, 'ART000013', 'texto 000013', 27, 131.95, 10, 3562.65, 356.265),
(276, '2018', 18, 13, 'ART000014', 'texto 000014', 89, 162.96, 10, 14503.4, 1450.34),
(277, '2018', 18, 14, 'ART000021', 'texto 000021', 3, 245.28, 10, 735.84, 73.584),
(278, '2018', 18, 15, 'ART000014', 'texto 000014', 39, 162.96, 10, 6355.44, 635.544),
(279, '2018', 18, 16, NULL, 'Linea libre para el articulo \"ART000035\"', 70, 99.84, 21, 6988.8, 1467.65),
(280, '2018', 18, 17, NULL, 'Linea libre para el articulo \"ART000035\"', 24, 40.13, 21, 963.12, 202.255),
(281, '2018', 18, 18, NULL, 'Linea libre para el articulo \"ART000034\"', 39, 75.69, 21, 2951.91, 619.901),
(282, '2018', 19, 1, 'ART000016', 'texto 000016', 91, 84.16, 10, 7658.56, 765.856),
(283, '2018', 19, 2, NULL, 'Linea libre para el articulo \"ART000032\"', 86, 32.96, 21, 2834.56, 595.258),
(284, '2018', 19, 3, 'ART000009', 'texto 000009', 23, 111.33, 10, 2560.59, 256.059),
(285, '2018', 19, 4, 'ART000004', 'texto 000004', 6, 20.48, 10, 122.88, 12.288),
(286, '2018', 19, 5, NULL, 'Linea libre para el articulo \"ART000027\"', 19, 34.9, 21, 663.1, 139.251),
(287, '2018', 19, 6, 'ART000013', 'texto 000013', 3, 131.95, 10, 395.85, 39.585),
(288, '2018', 19, 7, 'ART000001', 'texto 000001', 32, 11.31, 21, 361.92, 76.0032),
(289, '2018', 19, 8, NULL, 'Linea libre para el articulo \"ART000031\"', 80, 64.3, 21, 5144, 1080.24),
(290, '2018', 19, 9, 'ART000009', 'texto 000009', 80, 111.33, 10, 8906.4, 890.64),
(291, '2018', 19, 10, 'ART000001', 'texto 000001', 90, 11.31, 21, 1017.9, 213.759),
(292, '2018', 19, 11, 'ART000019', 'texto 000019', 57, 250.42, 10, 14273.9, 1427.39),
(293, '2018', 19, 12, 'ART000012', 'texto 000012', 21, 162.84, 10, 3419.64, 341.964),
(294, '2018', 19, 13, 'ART000003', 'texto 000003', 21, 23.88, 10, 501.48, 50.148),
(295, '2018', 19, 14, NULL, 'Linea libre para el articulo \"ART000038\"', 42, 55.89, 21, 2347.38, 492.95),
(296, '2018', 19, 15, 'ART000004', 'texto 000004', 47, 20.48, 10, 962.56, 96.256),
(297, '2018', 19, 16, NULL, 'Linea libre para el articulo \"ART000035\"', 31, 89.69, 21, 2780.39, 583.882),
(298, '2018', 19, 17, NULL, 'Linea libre para el articulo \"ART000035\"', 85, 0.93, 21, 79.05, 16.6005),
(299, '2018', 20, 1, 'ART000014', 'texto 000014', 58, 162.96, 10, 9451.68, 945.168),
(300, '2018', 20, 2, 'ART000016', 'texto 000016', 33, 84.16, 10, 2777.28, 277.728),
(301, '2018', 20, 3, 'ART000003', 'texto 000003', 89, 23.88, 10, 2125.32, 212.532),
(302, '2018', 20, 4, NULL, 'Linea libre para el articulo \"ART000027\"', 2, 89.89, 21, 179.78, 37.7538),
(303, '2018', 20, 5, 'ART000022', 'texto 000022', 42, 302.28, 10, 12695.8, 1269.58),
(304, '2018', 20, 6, 'ART000022', 'texto 000022', 38, 302.28, 10, 11486.6, 1148.66),
(305, '2018', 20, 7, 'ART000020', 'texto 000020', 29, 220.2, 10, 6385.8, 638.58),
(306, '2018', 20, 8, 'ART000004', 'texto 000004', 93, 20.48, 10, 1904.64, 190.464),
(307, '2018', 20, 9, 'ART000019', 'texto 000019', 85, 250.42, 10, 21285.7, 2128.57),
(308, '2018', 20, 10, 'ART000022', 'texto 000022', 18, 302.28, 10, 5441.04, 544.104),
(309, '2018', 20, 11, NULL, 'Linea libre para el articulo \"ART000030\"', 15, 41.75, 21, 626.25, 131.512),
(310, '2018', 20, 12, NULL, 'Linea libre para el articulo \"ART000036\"', 15, 97.78, 21, 1466.7, 308.007),
(311, '2018', 20, 13, 'ART000014', 'texto 000014', 67, 162.96, 10, 10918.3, 1091.83),
(312, '2018', 20, 14, NULL, 'Linea libre para el articulo \"ART000040\"', 3, 65.05, 21, 195.15, 40.9815),
(313, '2018', 20, 15, 'ART000011', 'texto 000011', 48, 140.91, 10, 6763.68, 676.368),
(314, '2018', 20, 16, NULL, 'Linea libre para el articulo \"ART000034\"', 32, 87.93, 21, 2813.76, 590.89),
(315, '2018', 20, 17, 'ART000022', 'texto 000022', 38, 302.28, 10, 11486.6, 1148.66),
(316, '2018', 20, 18, NULL, 'Linea libre para el articulo \"ART000036\"', 91, 42.43, 21, 3861.13, 810.837),
(317, '2018', 20, 19, NULL, 'Linea libre para el articulo \"ART000037\"', 40, 31.38, 21, 1255.2, 263.592),
(318, '2018', 20, 20, 'ART000025', 'texto 000025', 5, 244.5, 10, 1222.5, 122.25),
(319, '2018', 20, 21, 'ART000014', 'texto 000014', 9, 162.96, 10, 1466.64, 146.664),
(320, '2018', 20, 22, 'ART000003', 'texto 000003', 22, 23.88, 10, 525.36, 52.536),
(321, '2018', 20, 23, 'ART000008', 'texto 000008', 60, 19.36, 10, 1161.6, 116.16),
(322, '2018', 20, 24, 'ART000009', 'texto 000009', 96, 111.33, 10, 10687.7, 1068.77),
(323, '2018', 21, 1, NULL, 'Linea libre para el articulo \"ART000028\"', 23, 83.43, 21, 1918.89, 402.967),
(324, '2018', 21, 2, 'ART000018', 'texto 000018', 67, 147.06, 10, 9853.02, 985.302),
(325, '2018', 21, 3, 'ART000001', 'texto 000001', 26, 11.31, 21, 294.06, 61.7526),
(326, '2018', 21, 4, 'ART000006', 'texto 000006', 34, 22.02, 10, 748.68, 74.868),
(327, '2018', 22, 1, NULL, 'Linea libre para el articulo \"ART000028\"', 16, 85.31, 21, 1364.96, 286.642),
(328, '2018', 22, 2, NULL, 'Linea libre para el articulo \"ART000033\"', 10, 18.49, 21, 184.9, 38.829),
(329, '2018', 22, 3, 'ART000009', 'texto 000009', 42, 111.33, 10, 4675.86, 467.586),
(330, '2018', 22, 4, 'ART000011', 'texto 000011', 94, 140.91, 10, 13245.5, 1324.55),
(331, '2018', 22, 5, NULL, 'Linea libre para el articulo \"ART000030\"', 63, 31.76, 21, 2000.88, 420.185),
(332, '2018', 22, 6, 'ART000022', 'texto 000022', 25, 302.28, 10, 7557, 755.7),
(333, '2018', 22, 7, 'ART000008', 'texto 000008', 89, 19.36, 10, 1723.04, 172.304),
(334, '2018', 23, 1, 'ART000016', 'texto 000016', 88, 84.16, 10, 7406.08, 740.608),
(335, '2018', 23, 2, 'ART000025', 'texto 000025', 78, 244.5, 10, 19071, 1907.1),
(336, '2018', 23, 3, 'ART000006', 'texto 000006', 89, 22.02, 10, 1959.78, 195.978),
(337, '2018', 23, 4, NULL, 'Linea libre para el articulo \"ART000026\"', 9, 97.77, 21, 879.93, 184.785),
(338, '2018', 23, 5, NULL, 'Linea libre para el articulo \"ART000032\"', 29, 63.66, 21, 1846.14, 387.689),
(339, '2018', 23, 6, 'ART000021', 'texto 000021', 9, 245.28, 10, 2207.52, 220.752),
(340, '2018', 23, 7, 'ART000009', 'texto 000009', 36, 111.33, 10, 4007.88, 400.788),
(341, '2018', 23, 8, NULL, 'Linea libre para el articulo \"ART000031\"', 15, 65.26, 21, 978.9, 205.569),
(342, '2018', 23, 9, 'ART000014', 'texto 000014', 24, 162.96, 10, 3911.04, 391.104),
(343, '2018', 23, 10, 'ART000008', 'texto 000008', 45, 19.36, 10, 871.2, 87.12),
(344, '2018', 23, 11, 'ART000021', 'texto 000021', 35, 245.28, 10, 8584.8, 858.48),
(345, '2018', 23, 12, 'ART000018', 'texto 000018', 50, 147.06, 10, 7353, 735.3),
(346, '2018', 24, 1, 'ART000011', 'texto 000011', 94, 140.91, 10, 13245.5, 1324.55),
(347, '2018', 24, 2, 'ART000012', 'texto 000012', 25, 162.84, 10, 4071, 407.1),
(348, '2018', 25, 1, NULL, 'Linea libre para el articulo \"ART000026\"', 4, 89.66, 21, 358.64, 75.3144),
(349, '2018', 25, 2, NULL, 'Linea libre para el articulo \"ART000032\"', 81, 34.36, 21, 2783.16, 584.464),
(350, '2025', 1, 1, 'ART000001', 'texto 000001', 1, 9.5, 21, 9.5, 1.995),
(351, '2025', 2, 1, 'ART000001', 'texto 000001', 1, 9.5, 21, 9.5, 1.995);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(12) NOT NULL COMMENT 'Clave primaria',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre para mostrar',
  `login` varchar(32) NOT NULL COMMENT 'Login de acceso',
  `password` varchar(32) NOT NULL COMMENT 'Clave de acceso',
  `perfil` varchar(32) NOT NULL COMMENT 'Rol: Administrador, Gerente, Empleado...',
  `ultima_fecha` datetime DEFAULT NULL COMMENT 'Ultimo acceso correcto',
  `activo` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Activo, 0=Inactivo',
  `notas` text DEFAULT NULL COMMENT 'Notas internas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `login`, `password`, `perfil`, `ultima_fecha`, `activo`, `notas`) VALUES
(1, 'Admin', 'admin', 'admin', 'Administrador', NULL, 1, NULL),
(2, 'Gerente', 'gerente', 'gerente', 'Gerente', NULL, 1, NULL),
(3, 'Empleado', 'empleado', 'empleado', 'Empleado', NULL, 1, NULL),
(4, 'nombre 000001', 'cliente1@correo.es', 'cliente1', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(5, 'nombre 000002', 'cliente2@correo.es', 'cliente2', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(6, 'nombre 000003', 'cliente3@correo.es', 'cliente3', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(7, 'nombre 000004', 'cliente4@correo.es', 'cliente4', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(8, 'nombre 000005', 'cliente5@correo.es', 'cliente5', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(9, 'nombre 000006', 'cliente6@correo.es', 'cliente6', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(10, 'nombre 000007', 'cliente7@correo.es', 'cliente7', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(11, 'nombre 000008', 'cliente8@correo.es', 'cliente8', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(12, 'nombre 000009', 'cliente9@correo.es', 'cliente9', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(13, 'nombre 000010', 'cliente10@correo.es', 'cliente10', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(14, 'nombre 000011', 'cliente11@correo.es', 'cliente11', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(15, 'nombre 000012', 'cliente12@correo.es', 'cliente12', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(16, 'nombre 000013', 'cliente13@correo.es', 'cliente13', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(17, 'nombre 000014', 'cliente14@correo.es', 'cliente14', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(18, 'nombre 000015', 'cliente15@correo.es', 'cliente15', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(19, 'nombre 000016', 'cliente16@correo.es', 'cliente16', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(20, 'nombre 000017', 'cliente17@correo.es', 'cliente17', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(21, 'nombre 000018', 'cliente18@correo.es', 'cliente18', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(22, 'nombre 000019', 'cliente19@correo.es', 'cliente19', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(23, 'nombre 000020', 'cliente20@correo.es', 'cliente20', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(24, 'nombre 000021', 'cliente21@correo.es', 'cliente21', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(25, 'nombre 000022', 'cliente22@correo.es', 'cliente22', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(26, 'nombre 000023', 'cliente23@correo.es', 'cliente23', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(27, 'nombre 000024', 'cliente24@correo.es', 'cliente24', 'Cliente', '2025-11-23 16:57:56', 1, NULL),
(28, 'nombre 000025', 'cliente25@correo.es', 'cliente25', 'Cliente', '2025-11-23 16:57:56', 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`referencia`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`referencia`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`idOferta`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`serie`,`numero`),
  ADD KEY `refCli` (`refCli`);

--
-- Indices de la tabla `pedidoslin`
--
ALTER TABLE `pedidoslin`
  ADD PRIMARY KEY (`idLinea`),
  ADD KEY `refArt` (`refArt`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `idOferta` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la linea de oferta.', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedidoslin`
--
ALTER TABLE `pedidoslin`
  MODIFY `idLinea` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la linea del pedido para facilitar los accesos', AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria', AUTO_INCREMENT=29;
--
-- Base de datos: `materialesg04`
--
CREATE DATABASE IF NOT EXISTS `materialesg04` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `materialesg04`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bricolaje`
--

CREATE TABLE `bricolaje` (
  `ID_PROD` int(11) NOT NULL,
  `EMAIL_DUENO` char(50) NOT NULL,
  `TITULO` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bricolaje`
--

INSERT INTO `bricolaje` (`ID_PROD`, `EMAIL_DUENO`, `TITULO`) VALUES
(3, 'marcos@usal.es', 'cortacesped'),
(5, 'alvaro@usal.es', 'talador neumático');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `ID_PROD_CARRITO` int(11) NOT NULL,
  `TITULO_PROD` char(50) NOT NULL,
  `PRECIO` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_user`
--

CREATE TABLE `catalogo_user` (
  `ID_PROD` int(11) NOT NULL,
  `EMAIL_DUENO` char(50) NOT NULL,
  `TITULO` char(50) NOT NULL,
  `PRECIO` float NOT NULL,
  `DESCRIPCION` char(250) NOT NULL,
  `ESTADO` char(50) NOT NULL,
  `COLOR` char(50) DEFAULT NULL,
  `FECHA_ANUNCIO` date NOT NULL,
  `CATEGORIA` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `catalogo_user`
--

INSERT INTO `catalogo_user` (`ID_PROD`, `EMAIL_DUENO`, `TITULO`, `PRECIO`, `DESCRIPCION`, `ESTADO`, `COLOR`, `FECHA_ANUNCIO`, `CATEGORIA`) VALUES
(1, 'marcos@usal.es', 'camiseta', 10, 'camiseta roja de la marca deportiva Nike', 'usado', 'rojo', '2023-12-16', 'ropa'),
(2, 'marcos@usal.es', 'videoconsola PS4', 100, 'videoconsola Sony PS4 con mando, 500GB almacenamiento', 'seminuevo', 'negro', '2022-12-16', 'tecnologia'),
(3, 'marcos@usal.es', 'cortacesped', 150, 'cortacesped a gasolina 10HP', 'nuevo', 'verde', '2023-05-16', 'bricolaje'),
(4, 'alvaro@usal.es', 'iphone 7', 200, 'telefono inteligente Iphone 7 de la marca Apple', 'seminuevo', 'blanco', '2023-10-12', 'tecnologia'),
(5, 'alvaro@usal.es', 'talador neumático', 60, 'taladro neumático con set de brocas para obras en casa', 'usado', 'azul', '2023-12-01', 'bricolaje'),
(6, 'alvaro@usal.es', 'cojines seda', 20, 'juego de 3 cojines de seda para decoracion del hogar', 'nuevo', 'amarillo', '2023-07-28', 'decoracion'),
(7, 'pedro@usal.es', 'pantalones levis 501', 15, 'antiguos pantalones Levi´s modelo 501', 'deteriorado', 'azul', '2023-05-14', 'ropa'),
(8, 'pedro@usal.es', 'zapatillas deportivas', 25, 'zapatillas deportivas marca Adidas', 'seminuevo', 'negro', '2023-08-10', 'ropa'),
(9, 'pedro@usal.es', 'alfombra', 15, 'alfombra con motivos geometricos para decoracion de salones y salas de estar', 'nuevo', 'morado', '2023-11-20', 'decoracion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `decoracion`
--

CREATE TABLE `decoracion` (
  `ID_PROD` int(11) NOT NULL,
  `EMAIL_DUENO` char(50) NOT NULL,
  `TITULO` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `decoracion`
--

INSERT INTO `decoracion` (`ID_PROD`, `EMAIL_DUENO`, `TITULO`) VALUES
(6, 'alvaro@usal.es', 'cojines seda'),
(9, 'pedro@usal.es', 'alfombra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_compras`
--

CREATE TABLE `historial_compras` (
  `ID_PEDIDO` int(11) NOT NULL,
  `ID_PROD_COMPRADO` int(11) NOT NULL,
  `TITULO_PROD` char(50) NOT NULL,
  `PRECIO` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `EMAIL` char(20) NOT NULL,
  `CONTRASEÑA` char(50) NOT NULL,
  `NOMBRE_USER` char(50) NOT NULL,
  `NOMBRE` char(50) NOT NULL,
  `APELLIDOS` char(50) NOT NULL,
  `TELEFONO` bigint(20) DEFAULT NULL,
  `COD_ADMIN` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`EMAIL`, `CONTRASEÑA`, `NOMBRE_USER`, `NOMBRE`, `APELLIDOS`, `TELEFONO`, `COD_ADMIN`) VALUES
('alvaro@usal.es', 'alvaro.arango', 'contrasena_user1', 'alvaro', 'arango ortiz', NULL, NULL),
('marcos@usal.es', 'marcos.cabrero', 'contrasena_admin', 'marcos', 'cabrero delgado', NULL, '123456'),
('pedro@usal.es', 'pedro.martines', 'contrasena_user2', 'pedro', 'martines parra', 98745622, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ropa`
--

CREATE TABLE `ropa` (
  `ID_PROD` int(11) NOT NULL,
  `EMAIL_DUENO` char(50) NOT NULL,
  `TITULO` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ropa`
--

INSERT INTO `ropa` (`ID_PROD`, `EMAIL_DUENO`, `TITULO`) VALUES
(1, 'marcos@usal.es', 'camiseta'),
(7, 'pedro@usal.es', 'pantalones levis 501'),
(8, 'pedro@usal.es', 'zapatillas deportivas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnologia`
--

CREATE TABLE `tecnologia` (
  `ID_PROD` int(11) NOT NULL,
  `EMAIL_DUENO` char(50) NOT NULL,
  `TITULO` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tecnologia`
--

INSERT INTO `tecnologia` (`ID_PROD`, `EMAIL_DUENO`, `TITULO`) VALUES
(2, 'marcos@usal.es', 'videoconsola PS4'),
(4, 'alvaro@usal.es', 'iphone 7');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bricolaje`
--
ALTER TABLE `bricolaje`
  ADD KEY `ID_PROD` (`ID_PROD`),
  ADD KEY `EMAIL_DUENO` (`EMAIL_DUENO`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD KEY `ID_PROD_CARRITO` (`ID_PROD_CARRITO`);

--
-- Indices de la tabla `catalogo_user`
--
ALTER TABLE `catalogo_user`
  ADD PRIMARY KEY (`ID_PROD`),
  ADD KEY `EMAIL_DUENO` (`EMAIL_DUENO`);

--
-- Indices de la tabla `decoracion`
--
ALTER TABLE `decoracion`
  ADD KEY `ID_PROD` (`ID_PROD`),
  ADD KEY `EMAIL_DUENO` (`EMAIL_DUENO`);

--
-- Indices de la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  ADD PRIMARY KEY (`ID_PEDIDO`),
  ADD KEY `ID_PROD_COMPRADO` (`ID_PROD_COMPRADO`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`EMAIL`,`NOMBRE_USER`);

--
-- Indices de la tabla `ropa`
--
ALTER TABLE `ropa`
  ADD KEY `ID_PROD` (`ID_PROD`),
  ADD KEY `EMAIL_DUENO` (`EMAIL_DUENO`);

--
-- Indices de la tabla `tecnologia`
--
ALTER TABLE `tecnologia`
  ADD KEY `ID_PROD` (`ID_PROD`),
  ADD KEY `EMAIL_DUENO` (`EMAIL_DUENO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bricolaje`
--
ALTER TABLE `bricolaje`
  MODIFY `ID_PROD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `catalogo_user`
--
ALTER TABLE `catalogo_user`
  MODIFY `ID_PROD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `decoracion`
--
ALTER TABLE `decoracion`
  MODIFY `ID_PROD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  MODIFY `ID_PEDIDO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ropa`
--
ALTER TABLE `ropa`
  MODIFY `ID_PROD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tecnologia`
--
ALTER TABLE `tecnologia`
  MODIFY `ID_PROD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bricolaje`
--
ALTER TABLE `bricolaje`
  ADD CONSTRAINT `bricolaje_ibfk_1` FOREIGN KEY (`ID_PROD`) REFERENCES `catalogo_user` (`ID_PROD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bricolaje_ibfk_2` FOREIGN KEY (`EMAIL_DUENO`) REFERENCES `perfiles` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`ID_PROD_CARRITO`) REFERENCES `catalogo_user` (`ID_PROD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `catalogo_user`
--
ALTER TABLE `catalogo_user`
  ADD CONSTRAINT `catalogo_user_ibfk_1` FOREIGN KEY (`EMAIL_DUENO`) REFERENCES `perfiles` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `decoracion`
--
ALTER TABLE `decoracion`
  ADD CONSTRAINT `decoracion_ibfk_1` FOREIGN KEY (`ID_PROD`) REFERENCES `catalogo_user` (`ID_PROD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `decoracion_ibfk_2` FOREIGN KEY (`EMAIL_DUENO`) REFERENCES `perfiles` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  ADD CONSTRAINT `historial_compras_ibfk_1` FOREIGN KEY (`ID_PROD_COMPRADO`) REFERENCES `carrito` (`ID_PROD_CARRITO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ropa`
--
ALTER TABLE `ropa`
  ADD CONSTRAINT `ropa_ibfk_1` FOREIGN KEY (`ID_PROD`) REFERENCES `catalogo_user` (`ID_PROD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ropa_ibfk_2` FOREIGN KEY (`EMAIL_DUENO`) REFERENCES `perfiles` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tecnologia`
--
ALTER TABLE `tecnologia`
  ADD CONSTRAINT `tecnologia_ibfk_1` FOREIGN KEY (`ID_PROD`) REFERENCES `catalogo_user` (`ID_PROD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tecnologia_ibfk_2` FOREIGN KEY (`EMAIL_DUENO`) REFERENCES `perfiles` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Base de datos: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bricolaje`
--

CREATE TABLE `bricolaje` (
  `ID_PROD` int(11) NOT NULL,
  `EMAIL_DUENO` char(50) NOT NULL,
  `TITULO` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bricolaje`
--

INSERT INTO `bricolaje` (`ID_PROD`, `EMAIL_DUENO`, `TITULO`) VALUES
(3, 'marcos@usal.es', 'cortacesped'),
(5, 'alvaro@usal.es', 'talador neumático');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `ID_PROD_CARRITO` int(11) NOT NULL,
  `TITULO_PROD` char(50) NOT NULL,
  `PRECIO` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_user`
--

CREATE TABLE `catalogo_user` (
  `ID_PROD` int(11) NOT NULL,
  `EMAIL_DUENO` char(50) NOT NULL,
  `TITULO` char(50) NOT NULL,
  `PRECIO` float NOT NULL,
  `DESCRIPCION` char(250) NOT NULL,
  `ESTADO` char(50) NOT NULL,
  `COLOR` char(50) DEFAULT NULL,
  `FECHA_ANUNCIO` date NOT NULL,
  `CATEGORIA` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `catalogo_user`
--

INSERT INTO `catalogo_user` (`ID_PROD`, `EMAIL_DUENO`, `TITULO`, `PRECIO`, `DESCRIPCION`, `ESTADO`, `COLOR`, `FECHA_ANUNCIO`, `CATEGORIA`) VALUES
(1, 'marcos@usal.es', 'camiseta', 10, 'camiseta roja de la marca deportiva Nike', 'usado', 'rojo', '2023-12-16', 'ropa'),
(2, 'marcos@usal.es', 'videoconsola PS4', 100, 'videoconsola Sony PS4 con mando, 500GB almacenamiento', 'seminuevo', 'negro', '2022-12-16', 'tecnologia'),
(3, 'marcos@usal.es', 'cortacesped', 150, 'cortacesped a gasolina 10HP', 'nuevo', 'verde', '2023-05-16', 'bricolaje'),
(4, 'alvaro@usal.es', 'iphone 7', 200, 'telefono inteligente Iphone 7 de la marca Apple', 'seminuevo', 'blanco', '2023-10-12', 'tecnologia'),
(5, 'alvaro@usal.es', 'talador neumático', 60, 'taladro neumático con set de brocas para obras en casa', 'usado', 'azul', '2023-12-01', 'bricolaje'),
(6, 'alvaro@usal.es', 'cojines seda', 20, 'juego de 3 cojines de seda para decoracion del hogar', 'nuevo', 'amarillo', '2023-07-28', 'decoracion'),
(7, 'pedro@usal.es', 'pantalones levis 501', 15, 'antiguos pantalones Levi´s modelo 501', 'deteriorado', 'azul', '2023-05-14', 'ropa'),
(8, 'pedro@usal.es', 'zapatillas deportivas', 25, 'zapatillas deportivas marca Adidas', 'seminuevo', 'negro', '2023-08-10', 'ropa'),
(9, 'pedro@usal.es', 'alfombra', 15, 'alfombra con motivos geometricos para decoracion de salones y salas de estar', 'nuevo', 'morado', '2023-11-20', 'decoracion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `decoracion`
--

CREATE TABLE `decoracion` (
  `ID_PROD` int(11) NOT NULL,
  `EMAIL_DUENO` char(50) NOT NULL,
  `TITULO` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `decoracion`
--

INSERT INTO `decoracion` (`ID_PROD`, `EMAIL_DUENO`, `TITULO`) VALUES
(6, 'alvaro@usal.es', 'cojines seda'),
(9, 'pedro@usal.es', 'alfombra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_compras`
--

CREATE TABLE `historial_compras` (
  `ID_PEDIDO` int(11) NOT NULL,
  `ID_PROD_COMPRADO` int(11) NOT NULL,
  `TITULO_PROD` char(50) NOT NULL,
  `PRECIO` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `EMAIL` char(20) NOT NULL,
  `CONTRASEÑA` char(50) NOT NULL,
  `NOMBRE_USER` char(50) NOT NULL,
  `NOMBRE` char(50) NOT NULL,
  `APELLIDOS` char(50) NOT NULL,
  `TELEFONO` bigint(20) DEFAULT NULL,
  `COD_ADMIN` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`EMAIL`, `CONTRASEÑA`, `NOMBRE_USER`, `NOMBRE`, `APELLIDOS`, `TELEFONO`, `COD_ADMIN`) VALUES
('alvaro@usal.es', 'alvaro.arango', 'contrasena_user1', 'alvaro', 'arango ortiz', NULL, NULL),
('marcos@usal.es', 'marcos.cabrero', 'contrasena_admin', 'marcos', 'cabrero delgado', NULL, '123456'),
('pedro@usal.es', 'pedro.martines', 'contrasena_user2', 'pedro', 'martines parra', 98745622, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2023-10-10 15:03:26', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"es\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ropa`
--

CREATE TABLE `ropa` (
  `ID_PROD` int(11) NOT NULL,
  `EMAIL_DUENO` char(50) NOT NULL,
  `TITULO` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ropa`
--

INSERT INTO `ropa` (`ID_PROD`, `EMAIL_DUENO`, `TITULO`) VALUES
(1, 'marcos@usal.es', 'camiseta'),
(7, 'pedro@usal.es', 'pantalones levis 501'),
(8, 'pedro@usal.es', 'zapatillas deportivas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnologia`
--

CREATE TABLE `tecnologia` (
  `ID_PROD` int(11) NOT NULL,
  `EMAIL_DUENO` char(50) NOT NULL,
  `TITULO` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tecnologia`
--

INSERT INTO `tecnologia` (`ID_PROD`, `EMAIL_DUENO`, `TITULO`) VALUES
(2, 'marcos@usal.es', 'videoconsola PS4'),
(4, 'alvaro@usal.es', 'iphone 7');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bricolaje`
--
ALTER TABLE `bricolaje`
  ADD KEY `ID_PROD` (`ID_PROD`),
  ADD KEY `EMAIL_DUENO` (`EMAIL_DUENO`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD KEY `ID_PROD_CARRITO` (`ID_PROD_CARRITO`);

--
-- Indices de la tabla `catalogo_user`
--
ALTER TABLE `catalogo_user`
  ADD PRIMARY KEY (`ID_PROD`),
  ADD KEY `EMAIL_DUENO` (`EMAIL_DUENO`);

--
-- Indices de la tabla `decoracion`
--
ALTER TABLE `decoracion`
  ADD KEY `ID_PROD` (`ID_PROD`),
  ADD KEY `EMAIL_DUENO` (`EMAIL_DUENO`);

--
-- Indices de la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  ADD PRIMARY KEY (`ID_PEDIDO`),
  ADD KEY `ID_PROD_COMPRADO` (`ID_PROD_COMPRADO`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`EMAIL`,`NOMBRE_USER`);

--
-- Indices de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indices de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indices de la tabla `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indices de la tabla `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indices de la tabla `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indices de la tabla `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indices de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indices de la tabla `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indices de la tabla `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indices de la tabla `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indices de la tabla `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indices de la tabla `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- Indices de la tabla `ropa`
--
ALTER TABLE `ropa`
  ADD KEY `ID_PROD` (`ID_PROD`),
  ADD KEY `EMAIL_DUENO` (`EMAIL_DUENO`);

--
-- Indices de la tabla `tecnologia`
--
ALTER TABLE `tecnologia`
  ADD KEY `ID_PROD` (`ID_PROD`),
  ADD KEY `EMAIL_DUENO` (`EMAIL_DUENO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bricolaje`
--
ALTER TABLE `bricolaje`
  MODIFY `ID_PROD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `catalogo_user`
--
ALTER TABLE `catalogo_user`
  MODIFY `ID_PROD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `decoracion`
--
ALTER TABLE `decoracion`
  MODIFY `ID_PROD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  MODIFY `ID_PEDIDO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ropa`
--
ALTER TABLE `ropa`
  MODIFY `ID_PROD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tecnologia`
--
ALTER TABLE `tecnologia`
  MODIFY `ID_PROD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bricolaje`
--
ALTER TABLE `bricolaje`
  ADD CONSTRAINT `bricolaje_ibfk_1` FOREIGN KEY (`ID_PROD`) REFERENCES `catalogo_user` (`ID_PROD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bricolaje_ibfk_2` FOREIGN KEY (`EMAIL_DUENO`) REFERENCES `perfiles` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`ID_PROD_CARRITO`) REFERENCES `catalogo_user` (`ID_PROD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `catalogo_user`
--
ALTER TABLE `catalogo_user`
  ADD CONSTRAINT `catalogo_user_ibfk_1` FOREIGN KEY (`EMAIL_DUENO`) REFERENCES `perfiles` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `decoracion`
--
ALTER TABLE `decoracion`
  ADD CONSTRAINT `decoracion_ibfk_1` FOREIGN KEY (`ID_PROD`) REFERENCES `catalogo_user` (`ID_PROD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `decoracion_ibfk_2` FOREIGN KEY (`EMAIL_DUENO`) REFERENCES `perfiles` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  ADD CONSTRAINT `historial_compras_ibfk_1` FOREIGN KEY (`ID_PROD_COMPRADO`) REFERENCES `carrito` (`ID_PROD_CARRITO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ropa`
--
ALTER TABLE `ropa`
  ADD CONSTRAINT `ropa_ibfk_1` FOREIGN KEY (`ID_PROD`) REFERENCES `catalogo_user` (`ID_PROD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ropa_ibfk_2` FOREIGN KEY (`EMAIL_DUENO`) REFERENCES `perfiles` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tecnologia`
--
ALTER TABLE `tecnologia`
  ADD CONSTRAINT `tecnologia_ibfk_1` FOREIGN KEY (`ID_PROD`) REFERENCES `catalogo_user` (`ID_PROD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tecnologia_ibfk_2` FOREIGN KEY (`EMAIL_DUENO`) REFERENCES `perfiles` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Base de datos: `rest_api`
--
CREATE DATABASE IF NOT EXISTS `rest_api` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rest_api`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(64) DEFAULT NULL,
  `token_expira` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `dni`, `usuario`, `password`, `token`, `token_expira`) VALUES
(1, 'Federico', 'Pérez', '12345678A', 'fede', '$2y$10$a.ALlQ2elNDlTjI/W8fEg.6ByDQDQwFOdO3dKBjhkhYKhFyJ.u.TK', 'f697824092fcb78f7e82ae25e207d89f', '2025-10-31 11:07:59'),
(2, 'Ana', 'López', '98765432B', 'ana', '$2y$10$nc9RG6Pp0QaBxb6Cj2rNs.SMU3U6Hz.fY5h4wTZGDZiggneNnHXgq', 'bc252587b0fd0290a64727c913b8b6d3', '2025-10-31 11:07:59'),
(3, 'Juan', 'García', '55555555C', 'juan', '$2y$10$MtdUKjFOcsRrdpAu1OK7Q.IUvTFRJr7zNzcIzZB2TFeN5bG.yuR5W', '512b7910b9e9ceb5f4e731602776d6a6', '2025-10-31 11:08:00'),
(13, 'Lucia', 'Rodriguez', '44332211D', 'lucia', '$2y$10$LoLluoe0/5i/sh01Mu/psO50oF0uToAkKONlyYGXheiFHJMZTAAR.', 'd22d29f8f42f18c2b65735687a4afcee', '2025-10-31 11:10:26'),
(14, 'Carlos', 'Hernandez', '55667788E', 'carlos', '$2y$10$yZprMIeA1OW6e.J1HkbLvu1MpOSbdgodh6Ru8pj2WLyZdUF74qNEq', '09ed3599228a82ca4a47b8df2a03b160', '2025-10-31 11:10:26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Base de datos: `soa_p6`
--
CREATE DATABASE IF NOT EXISTS `soa_p6` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `soa_p6`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `dni`, `usuario`, `contrasena`) VALUES
(1, 'Juan', 'Pérez', '12345678A', 'juanp', '1234'),
(2, 'María', 'Gómez', '87654321B', 'mariag', 'abcd'),
(3, 'Luis', 'López', '11223344C', 'luisl', 'pass123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Base de datos: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Base de datos: `trabajofinalbbdd`
--
CREATE DATABASE IF NOT EXISTS `trabajofinalbbdd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trabajofinalbbdd`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `DNI` varchar(9) NOT NULL,
  `Nombre_c` varchar(100) DEFAULT NULL,
  `Telefono` int(9) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Método_Pago` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`DNI`, `Nombre_c`, `Telefono`, `Direccion`, `Método_Pago`) VALUES
('03618831B', 'Kevin', 222222222, 'Paseo Aitana, 86, 6º C', 'Efectivo'),
('05288225L', 'David', 98765432, 'Camiño Gaona, 2, 5º E', 'Tarjeta'),
('28586731P', 'Pedro', 624353621, 'Camiño Mateo, 27, 22º F', 'Tarjeta'),
('73902750R', 'Victor', 123456789, 'Carrer Guillem, 4, 3º E', 'Tarjeta'),
('76918636N', 'Juan', 874630827, 'Calle Alba, 2, 8º C', 'Efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cli_cor`
--

CREATE TABLE `cli_cor` (
  `Nombre_c` varchar(100) NOT NULL,
  `Correo_electronico` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cli_cor`
--

INSERT INTO `cli_cor` (`Nombre_c`, `Correo_electronico`) VALUES
('David', 'falso3@gmail.com'),
('Juan', 'falso1@gmail.com'),
('Kevin', 'falso5@gmail.com'),
('Pedro', 'falso2@gmail.com'),
('Victor', 'falso4@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cosechadora1`
--

CREATE TABLE `cosechadora1` (
  `Numero_bastidor` int(11) NOT NULL,
  `DNI` varchar(9) DEFAULT NULL,
  `CIF` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cosechadora1`
--

INSERT INTO `cosechadora1` (`Numero_bastidor`, `DNI`, `CIF`) VALUES
(101, '28586731P', 'N2275205I'),
(102, '76918636N', 'F16131849'),
(103, '05288225L', 'N1975872A'),
(104, '03618831B', 'G21003272'),
(105, '73902750R', 'G29158557');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cosechadora2`
--

CREATE TABLE `cosechadora2` (
  `Numero_bastidor` int(11) NOT NULL,
  `Modelo` varchar(100) DEFAULT NULL,
  `Potencia` varchar(100) DEFAULT NULL,
  `Kg` int(9) DEFAULT NULL,
  `Color` varchar(100) DEFAULT NULL,
  `Año_fabricación` year(4) DEFAULT NULL,
  `Fecha_compra` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cosechadora2`
--

INSERT INTO `cosechadora2` (`Numero_bastidor`, `Modelo`, `Potencia`, `Kg`, `Color`, `Año_fabricación`, `Fecha_compra`) VALUES
(101, 'Lexion', '500CV', 2000, 'Amarillo', '2004', '2005-02-02'),
(102, 'Trion', '500CV', 2000, 'Rojo', '2020', '2021-09-23'),
(103, 'Kubota', '500CV', 4000, 'Verde', '2011', '2012-01-01'),
(104, 'Lexion', '500CV', 3000, 'Azul', '1999', '2000-02-20'),
(105, 'Trion', '500CV', 2000, 'Gris', '2000', '2001-09-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `Codigo_empleado` int(11) NOT NULL,
  `Nombre_e` varchar(100) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Telefono` int(9) DEFAULT NULL,
  `Antigüedad` varchar(100) DEFAULT NULL,
  `Sueldo` float DEFAULT NULL,
  `Rango` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`Codigo_empleado`, `Nombre_e`, `Direccion`, `Telefono`, `Antigüedad`, `Sueldo`, `Rango`) VALUES
(1, 'Vanesa', 'Carrer Lidia, 34, 6º B', 132435467, '1 año', 12000, 'Director'),
(2, 'Daniel', 'Avenida Guillermo, 44, 05º D', 89746531, '2 años', 5000, 'Gerente'),
(4, 'Sara', 'Travesía Enrique, 922, Ático 5º', 987987987, '4 años', 1000, 'Operario'),
(5, 'Nico', 'Travesía Portillo, 860, Bajos', 666767676, '5 años', 1000, 'Operario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_limpieza_empleado`
--

CREATE TABLE `empresa_limpieza_empleado` (
  `DNI` varchar(9) NOT NULL,
  `Nacionalidad` varchar(100) DEFAULT NULL,
  `Fecha_Nac` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa_limpieza_empleado`
--

INSERT INTO `empresa_limpieza_empleado` (`DNI`, `Nacionalidad`, `Fecha_Nac`) VALUES
('25907780M', 'Portuguesa', '2002-02-02'),
('57474805J', 'Alemana', '2003-03-03'),
('80701226E', 'Francesa', '2004-04-04'),
('83107815Y', 'Bulgara', '2015-05-05'),
('84270990W', 'Española', '2001-01-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_cor`
--

CREATE TABLE `emp_cor` (
  `Nombre_e` varchar(100) NOT NULL,
  `Correo_electronico` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `emp_cor`
--

INSERT INTO `emp_cor` (`Nombre_e`, `Correo_electronico`) VALUES
('Carlos', 'verdadero5@gmail.com'),
('Daniel', 'verdadero4@gmail.com'),
('Nico', 'verdadero3@gmail.com'),
('Sara', 'verdadero1@gmail.com'),
('Vanesa', 'verdadero2@gmail.com');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `lascosechadoras`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `lascosechadoras` (
`Numero_bastidor` int(11)
,`Modelo` varchar(100)
,`Color` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `limpia`
--

CREATE TABLE `limpia` (
  `Numero_bastidor` int(11) DEFAULT NULL,
  `DNI` varchar(9) DEFAULT NULL,
  `Fecha_limpiar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `limpia`
--

INSERT INTO `limpia` (`Numero_bastidor`, `DNI`, `Fecha_limpiar`) VALUES
(101, '80701226E', '2024-01-01'),
(102, '57474805J', '2024-02-02'),
(103, '57474805J', '2024-03-03'),
(104, '84270990W', '2024-04-04'),
(105, '25907780M', '2024-05-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mecánico`
--

CREATE TABLE `mecánico` (
  `Codigo_empleado` int(11) NOT NULL,
  `Tiempo_medio` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mecánico`
--

INSERT INTO `mecánico` (`Codigo_empleado`, `Tiempo_medio`) VALUES
(1, '1 hora'),
(2, '6 horas'),
(4, '4 horas'),
(5, '7 horas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficinista`
--

CREATE TABLE `oficinista` (
  `Codigo_empleado` int(11) NOT NULL,
  `Resultado_trimestre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oficinista`
--

INSERT INTO `oficinista` (`Codigo_empleado`, `Resultado_trimestre`) VALUES
(1, 'Negativo'),
(2, 'Negativo'),
(4, 'Positivo'),
(5, 'Positivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `CIF` varchar(9) NOT NULL,
  `Nombre_p` varchar(100) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`CIF`, `Nombre_p`, `Direccion`) VALUES
('F16131849', 'WIDO RECAMBIOS', 'Plaza Sofía, 45, 3º 0º'),
('G21003272', 'ENRIQUE SEGURA', 'Avinguda Marcos, 8, Entre suelo 5º'),
('G29158557', 'MAQUINARIA ZOCAPI', 'Ruela Luján, 6, 66º 9º'),
('N1975872A', 'INDUSAGRI', 'Calle Carbonell, 4, 0º F'),
('N2275205I', 'DESGUACES CASQUERO', 'Praza Aleix, 18, 2º A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `Numero_bastidor` int(11) DEFAULT NULL,
  `Nombre_terreno` varchar(100) DEFAULT NULL,
  `Fecha_prueba` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prueba`
--

INSERT INTO `prueba` (`Numero_bastidor`, `Nombre_terreno`, `Fecha_prueba`) VALUES
(101, 'Bosque encantado', '2020-09-09'),
(102, 'Costa Azul', '2020-07-07'),
(103, 'Valle Esmeralda', '2020-06-06'),
(104, 'Llanura Plateada', '2020-10-10'),
(105, 'Montaña Dorada', '2020-04-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terreno`
--

CREATE TABLE `terreno` (
  `Nombre_terreno` varchar(100) NOT NULL,
  `Aperos` varchar(100) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `terreno`
--

INSERT INTO `terreno` (`Nombre_terreno`, `Aperos`, `Direccion`) VALUES
('Bosque encantado', 'Guadaña', 'Paseo Santiago, 3, Entre suelo 1º'),
('Costa Azul', 'Arador', 'Calle Saúl, 289, 4º F'),
('Llanura Plateada', 'Horquilla', 'Travesía Maya, 11, 1º F'),
('Montaña Dorada', 'Rastrillo', 'Plaza Cabán, 9, 91º D'),
('Valle Esmeralda', 'Azada', 'Avinguda Miguel Ángel, 644, Bajo 4º');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabaja`
--

CREATE TABLE `trabaja` (
  `Numero_bastidor` int(11) DEFAULT NULL,
  `Codigo_empleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trabaja`
--

INSERT INTO `trabaja` (`Numero_bastidor`, `Codigo_empleado`) VALUES
(105, 1),
(102, 4),
(101, 2),
(103, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `Codigo_empleado` int(11) NOT NULL,
  `Valoración` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`Codigo_empleado`, `Valoración`) VALUES
(1, 'Me gusta'),
(2, 'Me gusta'),
(4, 'No me gusta'),
(5, 'Me gusta');

-- --------------------------------------------------------

--
-- Estructura para la vista `lascosechadoras`
--
DROP TABLE IF EXISTS `lascosechadoras`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lascosechadoras`  AS SELECT `cosechadora2`.`Numero_bastidor` AS `Numero_bastidor`, `cosechadora2`.`Modelo` AS `Modelo`, `cosechadora2`.`Color` AS `Color` FROM ((`cosechadora2` join `cosechadora1` on(`cosechadora2`.`Numero_bastidor` = `cosechadora1`.`Numero_bastidor`)) join `cliente` on(`cosechadora1`.`DNI` = `cliente`.`DNI`)) WHERE `cliente`.`Método_Pago` = 'Efectivo' ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`DNI`),
  ADD KEY `Nombre_c` (`Nombre_c`);

--
-- Indices de la tabla `cli_cor`
--
ALTER TABLE `cli_cor`
  ADD PRIMARY KEY (`Nombre_c`);

--
-- Indices de la tabla `cosechadora1`
--
ALTER TABLE `cosechadora1`
  ADD PRIMARY KEY (`Numero_bastidor`),
  ADD KEY `DNI` (`DNI`),
  ADD KEY `CIF` (`CIF`);

--
-- Indices de la tabla `cosechadora2`
--
ALTER TABLE `cosechadora2`
  ADD PRIMARY KEY (`Numero_bastidor`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`Codigo_empleado`),
  ADD KEY `Nombre_e` (`Nombre_e`);

--
-- Indices de la tabla `empresa_limpieza_empleado`
--
ALTER TABLE `empresa_limpieza_empleado`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `emp_cor`
--
ALTER TABLE `emp_cor`
  ADD PRIMARY KEY (`Nombre_e`);

--
-- Indices de la tabla `limpia`
--
ALTER TABLE `limpia`
  ADD KEY `Numero_bastidor` (`Numero_bastidor`),
  ADD KEY `DNI` (`DNI`);

--
-- Indices de la tabla `mecánico`
--
ALTER TABLE `mecánico`
  ADD PRIMARY KEY (`Codigo_empleado`);

--
-- Indices de la tabla `oficinista`
--
ALTER TABLE `oficinista`
  ADD PRIMARY KEY (`Codigo_empleado`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`CIF`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD KEY `Numero_bastidor` (`Numero_bastidor`),
  ADD KEY `Nombre_terreno` (`Nombre_terreno`);

--
-- Indices de la tabla `terreno`
--
ALTER TABLE `terreno`
  ADD PRIMARY KEY (`Nombre_terreno`);

--
-- Indices de la tabla `trabaja`
--
ALTER TABLE `trabaja`
  ADD KEY `Numero_bastidor` (`Numero_bastidor`),
  ADD KEY `Codigo_empleado` (`Codigo_empleado`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`Codigo_empleado`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`Nombre_c`) REFERENCES `cli_cor` (`Nombre_c`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cosechadora1`
--
ALTER TABLE `cosechadora1`
  ADD CONSTRAINT `cosechadora1_ibfk_1` FOREIGN KEY (`Numero_bastidor`) REFERENCES `cosechadora2` (`Numero_bastidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cosechadora1_ibfk_2` FOREIGN KEY (`DNI`) REFERENCES `cliente` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cosechadora1_ibfk_3` FOREIGN KEY (`CIF`) REFERENCES `proveedor` (`CIF`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`Nombre_e`) REFERENCES `emp_cor` (`Nombre_e`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `limpia`
--
ALTER TABLE `limpia`
  ADD CONSTRAINT `limpia_ibfk_1` FOREIGN KEY (`Numero_bastidor`) REFERENCES `cosechadora2` (`Numero_bastidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `limpia_ibfk_2` FOREIGN KEY (`DNI`) REFERENCES `empresa_limpieza_empleado` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mecánico`
--
ALTER TABLE `mecánico`
  ADD CONSTRAINT `mecánico_ibfk_1` FOREIGN KEY (`Codigo_empleado`) REFERENCES `empleado` (`Codigo_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `oficinista`
--
ALTER TABLE `oficinista`
  ADD CONSTRAINT `oficinista_ibfk_1` FOREIGN KEY (`Codigo_empleado`) REFERENCES `empleado` (`Codigo_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD CONSTRAINT `prueba_ibfk_1` FOREIGN KEY (`Numero_bastidor`) REFERENCES `cosechadora2` (`Numero_bastidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prueba_ibfk_2` FOREIGN KEY (`Nombre_terreno`) REFERENCES `terreno` (`Nombre_terreno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `trabaja`
--
ALTER TABLE `trabaja`
  ADD CONSTRAINT `trabaja_ibfk_1` FOREIGN KEY (`Numero_bastidor`) REFERENCES `cosechadora2` (`Numero_bastidor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trabaja_ibfk_2` FOREIGN KEY (`Codigo_empleado`) REFERENCES `empleado` (`Codigo_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD CONSTRAINT `vendedor_ibfk_1` FOREIGN KEY (`Codigo_empleado`) REFERENCES `empleado` (`Codigo_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Base de datos: `trabajo_final_bbdd`
--
CREATE DATABASE IF NOT EXISTS `trabajo_final_bbdd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trabajo_final_bbdd`;
--
-- Base de datos: `wordpress2023`
--
CREATE DATABASE IF NOT EXISTS `wordpress2023` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `wordpress2023`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_commentmeta`
--

CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_comments`
--

CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT 'comment',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Un comentarista de WordPress', 'wapuu@wordpress.example', 'https://es.wordpress.org/', '', '2023-10-10 17:14:16', '2023-10-10 15:14:16', 'Hola, esto es un comentario.\nPara empezar a moderar, editar y borrar comentarios, por favor, visita en el escritorio la pantalla de comentarios.\nLos avatares de los comentaristas provienen de <a href=\"https://es.gravatar.com/\">Gravatar</a>.', 0, '1', '', 'comment', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_links`
--

CREATE TABLE `wp_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_options`
--

CREATE TABLE `wp_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://localhost/wordpress', 'yes'),
(2, 'home', 'http://localhost/wordpress', 'yes'),
(3, 'blogname', 'Mi página web', 'yes'),
(4, 'blogdescription', '', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'id00801115@usal.es', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'j \\d\\e F \\d\\e Y', 'yes'),
(24, 'time_format', 'H:i', 'yes'),
(25, 'links_updated_date_format', 'j \\d\\e F \\d\\e Y H:i', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:79:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:17:\"^wp-sitemap\\.xml$\";s:23:\"index.php?sitemap=index\";s:17:\"^wp-sitemap\\.xsl$\";s:36:\"index.php?sitemap-stylesheet=sitemap\";s:23:\"^wp-sitemap-index\\.xsl$\";s:34:\"index.php?sitemap-stylesheet=index\";s:48:\"^wp-sitemap-([a-z]+?)-([a-z\\d_-]+?)-(\\d+?)\\.xml$\";s:75:\"index.php?sitemap=$matches[1]&sitemap-subtype=$matches[2]&paged=$matches[3]\";s:34:\"^wp-sitemap-([a-z]+?)-(\\d+?)\\.xml$\";s:47:\"index.php?sitemap=$matches[1]&paged=$matches[2]\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:32:\"feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:27:\"(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:8:\"embed/?$\";s:21:\"index.php?&embed=true\";s:20:\"page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:41:\"comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:36:\"comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:17:\"comments/embed/?$\";s:21:\"index.php?&embed=true\";s:44:\"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:39:\"search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:20:\"search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:32:\"search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:14:\"search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:47:\"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:42:\"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:23:\"author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:35:\"author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:17:\"author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:69:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:45:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:39:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:56:\"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:51:\"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:32:\"([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:44:\"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:26:\"([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:43:\"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:38:\"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:19:\"([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:31:\"([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:13:\"([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:58:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:68:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:88:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:83:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:83:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:64:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:53:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/embed/?$\";s:91:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&embed=true\";s:57:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$\";s:85:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1\";s:77:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]\";s:72:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]\";s:65:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$\";s:98:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]\";s:72:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$\";s:98:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]\";s:61:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(?:/([0-9]+))?/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]\";s:47:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:57:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:77:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:72:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:72:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:53:\"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:64:\"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]\";s:51:\"([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]\";s:38:\"([0-9]{4})/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&cpage=$matches[2]\";s:27:\".?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:37:\".?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:57:\".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:52:\".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:33:\".?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:16:\"(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:20:\"(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:40:\"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:35:\"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:28:\"(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:35:\"(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:24:\"(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:0:{}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'twentytwentythree', 'yes'),
(41, 'stylesheet', 'twentytwentythree', 'yes'),
(42, 'comment_registration', '0', 'yes'),
(43, 'html_type', 'text/html', 'yes'),
(44, 'use_trackback', '0', 'yes'),
(45, 'default_role', 'subscriber', 'yes'),
(46, 'db_version', '55853', 'yes'),
(47, 'uploads_use_yearmonth_folders', '1', 'yes'),
(48, 'upload_path', '', 'yes'),
(49, 'blog_public', '1', 'yes'),
(50, 'default_link_category', '2', 'yes'),
(51, 'show_on_front', 'posts', 'yes'),
(52, 'tag_base', '', 'yes'),
(53, 'show_avatars', '1', 'yes'),
(54, 'avatar_rating', 'G', 'yes'),
(55, 'upload_url_path', '', 'yes'),
(56, 'thumbnail_size_w', '150', 'yes'),
(57, 'thumbnail_size_h', '150', 'yes'),
(58, 'thumbnail_crop', '1', 'yes'),
(59, 'medium_size_w', '300', 'yes'),
(60, 'medium_size_h', '300', 'yes'),
(61, 'avatar_default', 'mystery', 'yes'),
(62, 'large_size_w', '1024', 'yes'),
(63, 'large_size_h', '1024', 'yes'),
(64, 'image_default_link_type', 'none', 'yes'),
(65, 'image_default_size', '', 'yes'),
(66, 'image_default_align', '', 'yes'),
(67, 'close_comments_for_old_posts', '0', 'yes'),
(68, 'close_comments_days_old', '14', 'yes'),
(69, 'thread_comments', '1', 'yes'),
(70, 'thread_comments_depth', '5', 'yes'),
(71, 'page_comments', '0', 'yes'),
(72, 'comments_per_page', '50', 'yes'),
(73, 'default_comments_page', 'newest', 'yes'),
(74, 'comment_order', 'asc', 'yes'),
(75, 'sticky_posts', 'a:0:{}', 'yes'),
(76, 'widget_categories', 'a:0:{}', 'yes'),
(77, 'widget_text', 'a:0:{}', 'yes'),
(78, 'widget_rss', 'a:0:{}', 'yes'),
(79, 'uninstall_plugins', 'a:0:{}', 'no'),
(80, 'timezone_string', 'Europe/Madrid', 'yes'),
(81, 'page_for_posts', '0', 'yes'),
(82, 'page_on_front', '0', 'yes'),
(83, 'default_post_format', '0', 'yes'),
(84, 'link_manager_enabled', '0', 'yes'),
(85, 'finished_splitting_shared_terms', '1', 'yes'),
(86, 'site_icon', '0', 'yes'),
(87, 'medium_large_size_w', '768', 'yes'),
(88, 'medium_large_size_h', '0', 'yes'),
(89, 'wp_page_for_privacy_policy', '3', 'yes'),
(90, 'show_comments_cookies_opt_in', '1', 'yes'),
(91, 'admin_email_lifespan', '1712502855', 'yes'),
(92, 'disallowed_keys', '', 'no'),
(93, 'comment_previously_approved', '1', 'yes'),
(94, 'auto_plugin_theme_update_emails', 'a:0:{}', 'no'),
(95, 'auto_update_core_dev', 'enabled', 'yes'),
(96, 'auto_update_core_minor', 'enabled', 'yes'),
(97, 'auto_update_core_major', 'enabled', 'yes'),
(98, 'wp_force_deactivated_plugins', 'a:0:{}', 'yes'),
(99, 'initial_db_version', '55853', 'yes'),
(100, 'wp_user_roles', 'a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:61:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}', 'yes'),
(101, 'fresh_site', '1', 'yes'),
(102, 'WPLANG', 'es_ES', 'yes'),
(103, 'user_count', '1', 'no'),
(104, 'widget_block', 'a:6:{i:2;a:1:{s:7:\"content\";s:19:\"<!-- wp:search /-->\";}i:3;a:1:{s:7:\"content\";s:160:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Entradas recientes</h2><!-- /wp:heading --><!-- wp:latest-posts /--></div><!-- /wp:group -->\";}i:4;a:1:{s:7:\"content\";s:233:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Comentarios recientes</h2><!-- /wp:heading --><!-- wp:latest-comments {\"displayAvatar\":false,\"displayDate\":false,\"displayExcerpt\":false} /--></div><!-- /wp:group -->\";}i:5;a:1:{s:7:\"content\";s:146:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Archivos</h2><!-- /wp:heading --><!-- wp:archives /--></div><!-- /wp:group -->\";}i:6;a:1:{s:7:\"content\";s:151:\"<!-- wp:group --><div class=\"wp-block-group\"><!-- wp:heading --><h2>Categorías</h2><!-- /wp:heading --><!-- wp:categories /--></div><!-- /wp:group -->\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(105, 'sidebars_widgets', 'a:4:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:3:{i:0;s:7:\"block-2\";i:1;s:7:\"block-3\";i:2;s:7:\"block-4\";}s:9:\"sidebar-2\";a:2:{i:0;s:7:\"block-5\";i:1;s:7:\"block-6\";}s:13:\"array_version\";i:3;}', 'yes'),
(106, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_archives', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(110, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(111, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(112, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(113, 'widget_meta', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(114, 'widget_search', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(115, 'widget_recent-posts', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(116, 'widget_recent-comments', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(117, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(118, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(119, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(120, 'cron', 'a:9:{i:1697217257;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1697253257;a:4:{s:18:\"wp_https_detection\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1697253281;a:1:{s:21:\"wp_update_user_counts\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1697296457;a:1:{s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1697296481;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1697296483;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1697555665;a:1:{s:30:\"wp_delete_temp_updater_backups\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}i:1697642057;a:1:{s:30:\"wp_site_health_scheduled_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}s:7:\"version\";i:2;}', 'yes'),
(121, '_transient_wp_core_block_css_files', 'a:2:{s:7:\"version\";s:5:\"6.3.2\";s:5:\"files\";a:496:{i:0;s:23:\"archives/editor-rtl.css\";i:1;s:27:\"archives/editor-rtl.min.css\";i:2;s:19:\"archives/editor.css\";i:3;s:23:\"archives/editor.min.css\";i:4;s:22:\"archives/style-rtl.css\";i:5;s:26:\"archives/style-rtl.min.css\";i:6;s:18:\"archives/style.css\";i:7;s:22:\"archives/style.min.css\";i:8;s:20:\"audio/editor-rtl.css\";i:9;s:24:\"audio/editor-rtl.min.css\";i:10;s:16:\"audio/editor.css\";i:11;s:20:\"audio/editor.min.css\";i:12;s:19:\"audio/style-rtl.css\";i:13;s:23:\"audio/style-rtl.min.css\";i:14;s:15:\"audio/style.css\";i:15;s:19:\"audio/style.min.css\";i:16;s:19:\"audio/theme-rtl.css\";i:17;s:23:\"audio/theme-rtl.min.css\";i:18;s:15:\"audio/theme.css\";i:19;s:19:\"audio/theme.min.css\";i:20;s:21:\"avatar/editor-rtl.css\";i:21;s:25:\"avatar/editor-rtl.min.css\";i:22;s:17:\"avatar/editor.css\";i:23;s:21:\"avatar/editor.min.css\";i:24;s:20:\"avatar/style-rtl.css\";i:25;s:24:\"avatar/style-rtl.min.css\";i:26;s:16:\"avatar/style.css\";i:27;s:20:\"avatar/style.min.css\";i:28;s:20:\"block/editor-rtl.css\";i:29;s:24:\"block/editor-rtl.min.css\";i:30;s:16:\"block/editor.css\";i:31;s:20:\"block/editor.min.css\";i:32;s:21:\"button/editor-rtl.css\";i:33;s:25:\"button/editor-rtl.min.css\";i:34;s:17:\"button/editor.css\";i:35;s:21:\"button/editor.min.css\";i:36;s:20:\"button/style-rtl.css\";i:37;s:24:\"button/style-rtl.min.css\";i:38;s:16:\"button/style.css\";i:39;s:20:\"button/style.min.css\";i:40;s:22:\"buttons/editor-rtl.css\";i:41;s:26:\"buttons/editor-rtl.min.css\";i:42;s:18:\"buttons/editor.css\";i:43;s:22:\"buttons/editor.min.css\";i:44;s:21:\"buttons/style-rtl.css\";i:45;s:25:\"buttons/style-rtl.min.css\";i:46;s:17:\"buttons/style.css\";i:47;s:21:\"buttons/style.min.css\";i:48;s:22:\"calendar/style-rtl.css\";i:49;s:26:\"calendar/style-rtl.min.css\";i:50;s:18:\"calendar/style.css\";i:51;s:22:\"calendar/style.min.css\";i:52;s:25:\"categories/editor-rtl.css\";i:53;s:29:\"categories/editor-rtl.min.css\";i:54;s:21:\"categories/editor.css\";i:55;s:25:\"categories/editor.min.css\";i:56;s:24:\"categories/style-rtl.css\";i:57;s:28:\"categories/style-rtl.min.css\";i:58;s:20:\"categories/style.css\";i:59;s:24:\"categories/style.min.css\";i:60;s:19:\"code/editor-rtl.css\";i:61;s:23:\"code/editor-rtl.min.css\";i:62;s:15:\"code/editor.css\";i:63;s:19:\"code/editor.min.css\";i:64;s:18:\"code/style-rtl.css\";i:65;s:22:\"code/style-rtl.min.css\";i:66;s:14:\"code/style.css\";i:67;s:18:\"code/style.min.css\";i:68;s:18:\"code/theme-rtl.css\";i:69;s:22:\"code/theme-rtl.min.css\";i:70;s:14:\"code/theme.css\";i:71;s:18:\"code/theme.min.css\";i:72;s:22:\"columns/editor-rtl.css\";i:73;s:26:\"columns/editor-rtl.min.css\";i:74;s:18:\"columns/editor.css\";i:75;s:22:\"columns/editor.min.css\";i:76;s:21:\"columns/style-rtl.css\";i:77;s:25:\"columns/style-rtl.min.css\";i:78;s:17:\"columns/style.css\";i:79;s:21:\"columns/style.min.css\";i:80;s:29:\"comment-content/style-rtl.css\";i:81;s:33:\"comment-content/style-rtl.min.css\";i:82;s:25:\"comment-content/style.css\";i:83;s:29:\"comment-content/style.min.css\";i:84;s:30:\"comment-template/style-rtl.css\";i:85;s:34:\"comment-template/style-rtl.min.css\";i:86;s:26:\"comment-template/style.css\";i:87;s:30:\"comment-template/style.min.css\";i:88;s:42:\"comments-pagination-numbers/editor-rtl.css\";i:89;s:46:\"comments-pagination-numbers/editor-rtl.min.css\";i:90;s:38:\"comments-pagination-numbers/editor.css\";i:91;s:42:\"comments-pagination-numbers/editor.min.css\";i:92;s:34:\"comments-pagination/editor-rtl.css\";i:93;s:38:\"comments-pagination/editor-rtl.min.css\";i:94;s:30:\"comments-pagination/editor.css\";i:95;s:34:\"comments-pagination/editor.min.css\";i:96;s:33:\"comments-pagination/style-rtl.css\";i:97;s:37:\"comments-pagination/style-rtl.min.css\";i:98;s:29:\"comments-pagination/style.css\";i:99;s:33:\"comments-pagination/style.min.css\";i:100;s:29:\"comments-title/editor-rtl.css\";i:101;s:33:\"comments-title/editor-rtl.min.css\";i:102;s:25:\"comments-title/editor.css\";i:103;s:29:\"comments-title/editor.min.css\";i:104;s:23:\"comments/editor-rtl.css\";i:105;s:27:\"comments/editor-rtl.min.css\";i:106;s:19:\"comments/editor.css\";i:107;s:23:\"comments/editor.min.css\";i:108;s:22:\"comments/style-rtl.css\";i:109;s:26:\"comments/style-rtl.min.css\";i:110;s:18:\"comments/style.css\";i:111;s:22:\"comments/style.min.css\";i:112;s:20:\"cover/editor-rtl.css\";i:113;s:24:\"cover/editor-rtl.min.css\";i:114;s:16:\"cover/editor.css\";i:115;s:20:\"cover/editor.min.css\";i:116;s:19:\"cover/style-rtl.css\";i:117;s:23:\"cover/style-rtl.min.css\";i:118;s:15:\"cover/style.css\";i:119;s:19:\"cover/style.min.css\";i:120;s:22:\"details/editor-rtl.css\";i:121;s:26:\"details/editor-rtl.min.css\";i:122;s:18:\"details/editor.css\";i:123;s:22:\"details/editor.min.css\";i:124;s:21:\"details/style-rtl.css\";i:125;s:25:\"details/style-rtl.min.css\";i:126;s:17:\"details/style.css\";i:127;s:21:\"details/style.min.css\";i:128;s:20:\"embed/editor-rtl.css\";i:129;s:24:\"embed/editor-rtl.min.css\";i:130;s:16:\"embed/editor.css\";i:131;s:20:\"embed/editor.min.css\";i:132;s:19:\"embed/style-rtl.css\";i:133;s:23:\"embed/style-rtl.min.css\";i:134;s:15:\"embed/style.css\";i:135;s:19:\"embed/style.min.css\";i:136;s:19:\"embed/theme-rtl.css\";i:137;s:23:\"embed/theme-rtl.min.css\";i:138;s:15:\"embed/theme.css\";i:139;s:19:\"embed/theme.min.css\";i:140;s:19:\"file/editor-rtl.css\";i:141;s:23:\"file/editor-rtl.min.css\";i:142;s:15:\"file/editor.css\";i:143;s:19:\"file/editor.min.css\";i:144;s:18:\"file/style-rtl.css\";i:145;s:22:\"file/style-rtl.min.css\";i:146;s:14:\"file/style.css\";i:147;s:18:\"file/style.min.css\";i:148;s:23:\"footnotes/style-rtl.css\";i:149;s:27:\"footnotes/style-rtl.min.css\";i:150;s:19:\"footnotes/style.css\";i:151;s:23:\"footnotes/style.min.css\";i:152;s:23:\"freeform/editor-rtl.css\";i:153;s:27:\"freeform/editor-rtl.min.css\";i:154;s:19:\"freeform/editor.css\";i:155;s:23:\"freeform/editor.min.css\";i:156;s:22:\"gallery/editor-rtl.css\";i:157;s:26:\"gallery/editor-rtl.min.css\";i:158;s:18:\"gallery/editor.css\";i:159;s:22:\"gallery/editor.min.css\";i:160;s:21:\"gallery/style-rtl.css\";i:161;s:25:\"gallery/style-rtl.min.css\";i:162;s:17:\"gallery/style.css\";i:163;s:21:\"gallery/style.min.css\";i:164;s:21:\"gallery/theme-rtl.css\";i:165;s:25:\"gallery/theme-rtl.min.css\";i:166;s:17:\"gallery/theme.css\";i:167;s:21:\"gallery/theme.min.css\";i:168;s:20:\"group/editor-rtl.css\";i:169;s:24:\"group/editor-rtl.min.css\";i:170;s:16:\"group/editor.css\";i:171;s:20:\"group/editor.min.css\";i:172;s:19:\"group/style-rtl.css\";i:173;s:23:\"group/style-rtl.min.css\";i:174;s:15:\"group/style.css\";i:175;s:19:\"group/style.min.css\";i:176;s:19:\"group/theme-rtl.css\";i:177;s:23:\"group/theme-rtl.min.css\";i:178;s:15:\"group/theme.css\";i:179;s:19:\"group/theme.min.css\";i:180;s:21:\"heading/style-rtl.css\";i:181;s:25:\"heading/style-rtl.min.css\";i:182;s:17:\"heading/style.css\";i:183;s:21:\"heading/style.min.css\";i:184;s:19:\"html/editor-rtl.css\";i:185;s:23:\"html/editor-rtl.min.css\";i:186;s:15:\"html/editor.css\";i:187;s:19:\"html/editor.min.css\";i:188;s:20:\"image/editor-rtl.css\";i:189;s:24:\"image/editor-rtl.min.css\";i:190;s:16:\"image/editor.css\";i:191;s:20:\"image/editor.min.css\";i:192;s:19:\"image/style-rtl.css\";i:193;s:23:\"image/style-rtl.min.css\";i:194;s:15:\"image/style.css\";i:195;s:19:\"image/style.min.css\";i:196;s:19:\"image/theme-rtl.css\";i:197;s:23:\"image/theme-rtl.min.css\";i:198;s:15:\"image/theme.css\";i:199;s:19:\"image/theme.min.css\";i:200;s:29:\"latest-comments/style-rtl.css\";i:201;s:33:\"latest-comments/style-rtl.min.css\";i:202;s:25:\"latest-comments/style.css\";i:203;s:29:\"latest-comments/style.min.css\";i:204;s:27:\"latest-posts/editor-rtl.css\";i:205;s:31:\"latest-posts/editor-rtl.min.css\";i:206;s:23:\"latest-posts/editor.css\";i:207;s:27:\"latest-posts/editor.min.css\";i:208;s:26:\"latest-posts/style-rtl.css\";i:209;s:30:\"latest-posts/style-rtl.min.css\";i:210;s:22:\"latest-posts/style.css\";i:211;s:26:\"latest-posts/style.min.css\";i:212;s:18:\"list/style-rtl.css\";i:213;s:22:\"list/style-rtl.min.css\";i:214;s:14:\"list/style.css\";i:215;s:18:\"list/style.min.css\";i:216;s:25:\"media-text/editor-rtl.css\";i:217;s:29:\"media-text/editor-rtl.min.css\";i:218;s:21:\"media-text/editor.css\";i:219;s:25:\"media-text/editor.min.css\";i:220;s:24:\"media-text/style-rtl.css\";i:221;s:28:\"media-text/style-rtl.min.css\";i:222;s:20:\"media-text/style.css\";i:223;s:24:\"media-text/style.min.css\";i:224;s:19:\"more/editor-rtl.css\";i:225;s:23:\"more/editor-rtl.min.css\";i:226;s:15:\"more/editor.css\";i:227;s:19:\"more/editor.min.css\";i:228;s:30:\"navigation-link/editor-rtl.css\";i:229;s:34:\"navigation-link/editor-rtl.min.css\";i:230;s:26:\"navigation-link/editor.css\";i:231;s:30:\"navigation-link/editor.min.css\";i:232;s:29:\"navigation-link/style-rtl.css\";i:233;s:33:\"navigation-link/style-rtl.min.css\";i:234;s:25:\"navigation-link/style.css\";i:235;s:29:\"navigation-link/style.min.css\";i:236;s:33:\"navigation-submenu/editor-rtl.css\";i:237;s:37:\"navigation-submenu/editor-rtl.min.css\";i:238;s:29:\"navigation-submenu/editor.css\";i:239;s:33:\"navigation-submenu/editor.min.css\";i:240;s:25:\"navigation/editor-rtl.css\";i:241;s:29:\"navigation/editor-rtl.min.css\";i:242;s:21:\"navigation/editor.css\";i:243;s:25:\"navigation/editor.min.css\";i:244;s:24:\"navigation/style-rtl.css\";i:245;s:28:\"navigation/style-rtl.min.css\";i:246;s:20:\"navigation/style.css\";i:247;s:24:\"navigation/style.min.css\";i:248;s:23:\"nextpage/editor-rtl.css\";i:249;s:27:\"nextpage/editor-rtl.min.css\";i:250;s:19:\"nextpage/editor.css\";i:251;s:23:\"nextpage/editor.min.css\";i:252;s:24:\"page-list/editor-rtl.css\";i:253;s:28:\"page-list/editor-rtl.min.css\";i:254;s:20:\"page-list/editor.css\";i:255;s:24:\"page-list/editor.min.css\";i:256;s:23:\"page-list/style-rtl.css\";i:257;s:27:\"page-list/style-rtl.min.css\";i:258;s:19:\"page-list/style.css\";i:259;s:23:\"page-list/style.min.css\";i:260;s:24:\"paragraph/editor-rtl.css\";i:261;s:28:\"paragraph/editor-rtl.min.css\";i:262;s:20:\"paragraph/editor.css\";i:263;s:24:\"paragraph/editor.min.css\";i:264;s:23:\"paragraph/style-rtl.css\";i:265;s:27:\"paragraph/style-rtl.min.css\";i:266;s:19:\"paragraph/style.css\";i:267;s:23:\"paragraph/style.min.css\";i:268;s:25:\"post-author/style-rtl.css\";i:269;s:29:\"post-author/style-rtl.min.css\";i:270;s:21:\"post-author/style.css\";i:271;s:25:\"post-author/style.min.css\";i:272;s:33:\"post-comments-form/editor-rtl.css\";i:273;s:37:\"post-comments-form/editor-rtl.min.css\";i:274;s:29:\"post-comments-form/editor.css\";i:275;s:33:\"post-comments-form/editor.min.css\";i:276;s:32:\"post-comments-form/style-rtl.css\";i:277;s:36:\"post-comments-form/style-rtl.min.css\";i:278;s:28:\"post-comments-form/style.css\";i:279;s:32:\"post-comments-form/style.min.css\";i:280;s:23:\"post-date/style-rtl.css\";i:281;s:27:\"post-date/style-rtl.min.css\";i:282;s:19:\"post-date/style.css\";i:283;s:23:\"post-date/style.min.css\";i:284;s:27:\"post-excerpt/editor-rtl.css\";i:285;s:31:\"post-excerpt/editor-rtl.min.css\";i:286;s:23:\"post-excerpt/editor.css\";i:287;s:27:\"post-excerpt/editor.min.css\";i:288;s:26:\"post-excerpt/style-rtl.css\";i:289;s:30:\"post-excerpt/style-rtl.min.css\";i:290;s:22:\"post-excerpt/style.css\";i:291;s:26:\"post-excerpt/style.min.css\";i:292;s:34:\"post-featured-image/editor-rtl.css\";i:293;s:38:\"post-featured-image/editor-rtl.min.css\";i:294;s:30:\"post-featured-image/editor.css\";i:295;s:34:\"post-featured-image/editor.min.css\";i:296;s:33:\"post-featured-image/style-rtl.css\";i:297;s:37:\"post-featured-image/style-rtl.min.css\";i:298;s:29:\"post-featured-image/style.css\";i:299;s:33:\"post-featured-image/style.min.css\";i:300;s:34:\"post-navigation-link/style-rtl.css\";i:301;s:38:\"post-navigation-link/style-rtl.min.css\";i:302;s:30:\"post-navigation-link/style.css\";i:303;s:34:\"post-navigation-link/style.min.css\";i:304;s:28:\"post-template/editor-rtl.css\";i:305;s:32:\"post-template/editor-rtl.min.css\";i:306;s:24:\"post-template/editor.css\";i:307;s:28:\"post-template/editor.min.css\";i:308;s:27:\"post-template/style-rtl.css\";i:309;s:31:\"post-template/style-rtl.min.css\";i:310;s:23:\"post-template/style.css\";i:311;s:27:\"post-template/style.min.css\";i:312;s:24:\"post-terms/style-rtl.css\";i:313;s:28:\"post-terms/style-rtl.min.css\";i:314;s:20:\"post-terms/style.css\";i:315;s:24:\"post-terms/style.min.css\";i:316;s:24:\"post-title/style-rtl.css\";i:317;s:28:\"post-title/style-rtl.min.css\";i:318;s:20:\"post-title/style.css\";i:319;s:24:\"post-title/style.min.css\";i:320;s:26:\"preformatted/style-rtl.css\";i:321;s:30:\"preformatted/style-rtl.min.css\";i:322;s:22:\"preformatted/style.css\";i:323;s:26:\"preformatted/style.min.css\";i:324;s:24:\"pullquote/editor-rtl.css\";i:325;s:28:\"pullquote/editor-rtl.min.css\";i:326;s:20:\"pullquote/editor.css\";i:327;s:24:\"pullquote/editor.min.css\";i:328;s:23:\"pullquote/style-rtl.css\";i:329;s:27:\"pullquote/style-rtl.min.css\";i:330;s:19:\"pullquote/style.css\";i:331;s:23:\"pullquote/style.min.css\";i:332;s:23:\"pullquote/theme-rtl.css\";i:333;s:27:\"pullquote/theme-rtl.min.css\";i:334;s:19:\"pullquote/theme.css\";i:335;s:23:\"pullquote/theme.min.css\";i:336;s:39:\"query-pagination-numbers/editor-rtl.css\";i:337;s:43:\"query-pagination-numbers/editor-rtl.min.css\";i:338;s:35:\"query-pagination-numbers/editor.css\";i:339;s:39:\"query-pagination-numbers/editor.min.css\";i:340;s:31:\"query-pagination/editor-rtl.css\";i:341;s:35:\"query-pagination/editor-rtl.min.css\";i:342;s:27:\"query-pagination/editor.css\";i:343;s:31:\"query-pagination/editor.min.css\";i:344;s:30:\"query-pagination/style-rtl.css\";i:345;s:34:\"query-pagination/style-rtl.min.css\";i:346;s:26:\"query-pagination/style.css\";i:347;s:30:\"query-pagination/style.min.css\";i:348;s:25:\"query-title/style-rtl.css\";i:349;s:29:\"query-title/style-rtl.min.css\";i:350;s:21:\"query-title/style.css\";i:351;s:25:\"query-title/style.min.css\";i:352;s:20:\"query/editor-rtl.css\";i:353;s:24:\"query/editor-rtl.min.css\";i:354;s:16:\"query/editor.css\";i:355;s:20:\"query/editor.min.css\";i:356;s:19:\"quote/style-rtl.css\";i:357;s:23:\"quote/style-rtl.min.css\";i:358;s:15:\"quote/style.css\";i:359;s:19:\"quote/style.min.css\";i:360;s:19:\"quote/theme-rtl.css\";i:361;s:23:\"quote/theme-rtl.min.css\";i:362;s:15:\"quote/theme.css\";i:363;s:19:\"quote/theme.min.css\";i:364;s:23:\"read-more/style-rtl.css\";i:365;s:27:\"read-more/style-rtl.min.css\";i:366;s:19:\"read-more/style.css\";i:367;s:23:\"read-more/style.min.css\";i:368;s:18:\"rss/editor-rtl.css\";i:369;s:22:\"rss/editor-rtl.min.css\";i:370;s:14:\"rss/editor.css\";i:371;s:18:\"rss/editor.min.css\";i:372;s:17:\"rss/style-rtl.css\";i:373;s:21:\"rss/style-rtl.min.css\";i:374;s:13:\"rss/style.css\";i:375;s:17:\"rss/style.min.css\";i:376;s:21:\"search/editor-rtl.css\";i:377;s:25:\"search/editor-rtl.min.css\";i:378;s:17:\"search/editor.css\";i:379;s:21:\"search/editor.min.css\";i:380;s:20:\"search/style-rtl.css\";i:381;s:24:\"search/style-rtl.min.css\";i:382;s:16:\"search/style.css\";i:383;s:20:\"search/style.min.css\";i:384;s:20:\"search/theme-rtl.css\";i:385;s:24:\"search/theme-rtl.min.css\";i:386;s:16:\"search/theme.css\";i:387;s:20:\"search/theme.min.css\";i:388;s:24:\"separator/editor-rtl.css\";i:389;s:28:\"separator/editor-rtl.min.css\";i:390;s:20:\"separator/editor.css\";i:391;s:24:\"separator/editor.min.css\";i:392;s:23:\"separator/style-rtl.css\";i:393;s:27:\"separator/style-rtl.min.css\";i:394;s:19:\"separator/style.css\";i:395;s:23:\"separator/style.min.css\";i:396;s:23:\"separator/theme-rtl.css\";i:397;s:27:\"separator/theme-rtl.min.css\";i:398;s:19:\"separator/theme.css\";i:399;s:23:\"separator/theme.min.css\";i:400;s:24:\"shortcode/editor-rtl.css\";i:401;s:28:\"shortcode/editor-rtl.min.css\";i:402;s:20:\"shortcode/editor.css\";i:403;s:24:\"shortcode/editor.min.css\";i:404;s:24:\"site-logo/editor-rtl.css\";i:405;s:28:\"site-logo/editor-rtl.min.css\";i:406;s:20:\"site-logo/editor.css\";i:407;s:24:\"site-logo/editor.min.css\";i:408;s:23:\"site-logo/style-rtl.css\";i:409;s:27:\"site-logo/style-rtl.min.css\";i:410;s:19:\"site-logo/style.css\";i:411;s:23:\"site-logo/style.min.css\";i:412;s:27:\"site-tagline/editor-rtl.css\";i:413;s:31:\"site-tagline/editor-rtl.min.css\";i:414;s:23:\"site-tagline/editor.css\";i:415;s:27:\"site-tagline/editor.min.css\";i:416;s:25:\"site-title/editor-rtl.css\";i:417;s:29:\"site-title/editor-rtl.min.css\";i:418;s:21:\"site-title/editor.css\";i:419;s:25:\"site-title/editor.min.css\";i:420;s:24:\"site-title/style-rtl.css\";i:421;s:28:\"site-title/style-rtl.min.css\";i:422;s:20:\"site-title/style.css\";i:423;s:24:\"site-title/style.min.css\";i:424;s:26:\"social-link/editor-rtl.css\";i:425;s:30:\"social-link/editor-rtl.min.css\";i:426;s:22:\"social-link/editor.css\";i:427;s:26:\"social-link/editor.min.css\";i:428;s:27:\"social-links/editor-rtl.css\";i:429;s:31:\"social-links/editor-rtl.min.css\";i:430;s:23:\"social-links/editor.css\";i:431;s:27:\"social-links/editor.min.css\";i:432;s:26:\"social-links/style-rtl.css\";i:433;s:30:\"social-links/style-rtl.min.css\";i:434;s:22:\"social-links/style.css\";i:435;s:26:\"social-links/style.min.css\";i:436;s:21:\"spacer/editor-rtl.css\";i:437;s:25:\"spacer/editor-rtl.min.css\";i:438;s:17:\"spacer/editor.css\";i:439;s:21:\"spacer/editor.min.css\";i:440;s:20:\"spacer/style-rtl.css\";i:441;s:24:\"spacer/style-rtl.min.css\";i:442;s:16:\"spacer/style.css\";i:443;s:20:\"spacer/style.min.css\";i:444;s:20:\"table/editor-rtl.css\";i:445;s:24:\"table/editor-rtl.min.css\";i:446;s:16:\"table/editor.css\";i:447;s:20:\"table/editor.min.css\";i:448;s:19:\"table/style-rtl.css\";i:449;s:23:\"table/style-rtl.min.css\";i:450;s:15:\"table/style.css\";i:451;s:19:\"table/style.min.css\";i:452;s:19:\"table/theme-rtl.css\";i:453;s:23:\"table/theme-rtl.min.css\";i:454;s:15:\"table/theme.css\";i:455;s:19:\"table/theme.min.css\";i:456;s:23:\"tag-cloud/style-rtl.css\";i:457;s:27:\"tag-cloud/style-rtl.min.css\";i:458;s:19:\"tag-cloud/style.css\";i:459;s:23:\"tag-cloud/style.min.css\";i:460;s:28:\"template-part/editor-rtl.css\";i:461;s:32:\"template-part/editor-rtl.min.css\";i:462;s:24:\"template-part/editor.css\";i:463;s:28:\"template-part/editor.min.css\";i:464;s:27:\"template-part/theme-rtl.css\";i:465;s:31:\"template-part/theme-rtl.min.css\";i:466;s:23:\"template-part/theme.css\";i:467;s:27:\"template-part/theme.min.css\";i:468;s:30:\"term-description/style-rtl.css\";i:469;s:34:\"term-description/style-rtl.min.css\";i:470;s:26:\"term-description/style.css\";i:471;s:30:\"term-description/style.min.css\";i:472;s:27:\"text-columns/editor-rtl.css\";i:473;s:31:\"text-columns/editor-rtl.min.css\";i:474;s:23:\"text-columns/editor.css\";i:475;s:27:\"text-columns/editor.min.css\";i:476;s:26:\"text-columns/style-rtl.css\";i:477;s:30:\"text-columns/style-rtl.min.css\";i:478;s:22:\"text-columns/style.css\";i:479;s:26:\"text-columns/style.min.css\";i:480;s:19:\"verse/style-rtl.css\";i:481;s:23:\"verse/style-rtl.min.css\";i:482;s:15:\"verse/style.css\";i:483;s:19:\"verse/style.min.css\";i:484;s:20:\"video/editor-rtl.css\";i:485;s:24:\"video/editor-rtl.min.css\";i:486;s:16:\"video/editor.css\";i:487;s:20:\"video/editor.min.css\";i:488;s:19:\"video/style-rtl.css\";i:489;s:23:\"video/style-rtl.min.css\";i:490;s:15:\"video/style.css\";i:491;s:19:\"video/style.min.css\";i:492;s:19:\"video/theme-rtl.css\";i:493;s:23:\"video/theme-rtl.min.css\";i:494;s:15:\"video/theme.css\";i:495;s:19:\"video/theme.min.css\";}}', 'yes'),
(123, 'theme_mods_twentytwentythree', 'a:1:{s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(124, 'recovery_keys', 'a:0:{}', 'yes'),
(125, 'https_detection_errors', 'a:1:{s:23:\"ssl_verification_failed\";a:1:{i:0;s:26:\"Verificación SSL fallida.\";}}', 'yes'),
(134, '_site_transient_update_themes', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1697214331;s:7:\"checked\";a:3:{s:15:\"twentytwentyone\";s:3:\"1.9\";s:17:\"twentytwentythree\";s:3:\"1.2\";s:15:\"twentytwentytwo\";s:3:\"1.5\";}s:8:\"response\";a:0:{}s:9:\"no_update\";a:3:{s:15:\"twentytwentyone\";a:6:{s:5:\"theme\";s:15:\"twentytwentyone\";s:11:\"new_version\";s:3:\"1.8\";s:3:\"url\";s:45:\"https://wordpress.org/themes/twentytwentyone/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/theme/twentytwentyone.1.8.zip\";s:8:\"requires\";s:3:\"5.3\";s:12:\"requires_php\";s:3:\"5.6\";}s:17:\"twentytwentythree\";a:6:{s:5:\"theme\";s:17:\"twentytwentythree\";s:11:\"new_version\";s:3:\"1.2\";s:3:\"url\";s:47:\"https://wordpress.org/themes/twentytwentythree/\";s:7:\"package\";s:63:\"https://downloads.wordpress.org/theme/twentytwentythree.1.2.zip\";s:8:\"requires\";s:3:\"6.1\";s:12:\"requires_php\";s:3:\"5.6\";}s:15:\"twentytwentytwo\";a:6:{s:5:\"theme\";s:15:\"twentytwentytwo\";s:11:\"new_version\";s:3:\"1.4\";s:3:\"url\";s:45:\"https://wordpress.org/themes/twentytwentytwo/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/theme/twentytwentytwo.1.4.zip\";s:8:\"requires\";s:3:\"5.9\";s:12:\"requires_php\";s:3:\"5.6\";}}s:12:\"translations\";a:0:{}}', 'no'),
(139, '_site_transient_timeout_browser_22210ca73bf1af2ec2eace74a96ee356', '1697555682', 'no'),
(140, '_site_transient_browser_22210ca73bf1af2ec2eace74a96ee356', 'a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:9:\"117.0.0.0\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}', 'no'),
(141, '_site_transient_timeout_php_check_f9b25a35946393ab2b3328e72e3e778a', '1697555683', 'no'),
(142, '_site_transient_php_check_f9b25a35946393ab2b3328e72e3e778a', 'a:5:{s:19:\"recommended_version\";s:3:\"7.4\";s:15:\"minimum_version\";s:3:\"7.0\";s:12:\"is_supported\";b:1;s:9:\"is_secure\";b:1;s:13:\"is_acceptable\";b:1;}', 'no'),
(150, 'can_compress_scripts', '1', 'yes'),
(159, 'finished_updating_comment_type', '1', 'yes'),
(160, 'recently_activated', 'a:0:{}', 'yes'),
(163, '_site_transient_timeout_theme_roots', '1697216130', 'no'),
(164, '_site_transient_theme_roots', 'a:3:{s:15:\"twentytwentyone\";s:7:\"/themes\";s:17:\"twentytwentythree\";s:7:\"/themes\";s:15:\"twentytwentytwo\";s:7:\"/themes\";}', 'no'),
(166, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:65:\"https://downloads.wordpress.org/release/es_ES/wordpress-6.3.2.zip\";s:6:\"locale\";s:5:\"es_ES\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:65:\"https://downloads.wordpress.org/release/es_ES/wordpress-6.3.2.zip\";s:10:\"no_content\";s:0:\"\";s:11:\"new_bundled\";s:0:\"\";s:7:\"partial\";s:0:\"\";s:8:\"rollback\";s:0:\"\";}s:7:\"current\";s:5:\"6.3.2\";s:7:\"version\";s:5:\"6.3.2\";s:11:\"php_version\";s:5:\"7.0.0\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"6.1\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1697214352;s:15:\"version_checked\";s:5:\"6.3.2\";s:12:\"translations\";a:0:{}}', 'no'),
(167, '_site_transient_update_plugins', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1697214353;s:8:\"response\";a:1:{s:19:\"akismet/akismet.php\";O:8:\"stdClass\":12:{s:2:\"id\";s:21:\"w.org/plugins/akismet\";s:4:\"slug\";s:7:\"akismet\";s:6:\"plugin\";s:19:\"akismet/akismet.php\";s:11:\"new_version\";s:3:\"5.3\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/akismet/\";s:7:\"package\";s:54:\"https://downloads.wordpress.org/plugin/akismet.5.3.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:60:\"https://ps.w.org/akismet/assets/icon-256x256.png?rev=2818463\";s:2:\"1x\";s:60:\"https://ps.w.org/akismet/assets/icon-128x128.png?rev=2818463\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:63:\"https://ps.w.org/akismet/assets/banner-1544x500.png?rev=2900731\";s:2:\"1x\";s:62:\"https://ps.w.org/akismet/assets/banner-772x250.png?rev=2900731\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"5.8\";s:6:\"tested\";s:5:\"6.3.2\";s:12:\"requires_php\";s:6:\"5.6.20\";}}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:1:{s:9:\"hello.php\";O:8:\"stdClass\":10:{s:2:\"id\";s:25:\"w.org/plugins/hello-dolly\";s:4:\"slug\";s:11:\"hello-dolly\";s:6:\"plugin\";s:9:\"hello.php\";s:11:\"new_version\";s:5:\"1.7.2\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/hello-dolly/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/plugin/hello-dolly.1.7.2.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=2052855\";s:2:\"1x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=2052855\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:67:\"https://ps.w.org/hello-dolly/assets/banner-1544x500.jpg?rev=2645582\";s:2:\"1x\";s:66:\"https://ps.w.org/hello-dolly/assets/banner-772x250.jpg?rev=2052855\";}s:11:\"banners_rtl\";a:0:{}s:8:\"requires\";s:3:\"4.6\";}}s:7:\"checked\";a:2:{s:19:\"akismet/akismet.php\";s:3:\"5.2\";s:9:\"hello.php\";s:5:\"1.7.2\";}}', 'no'),
(168, 'auto_core_update_notified', 'a:4:{s:4:\"type\";s:7:\"success\";s:5:\"email\";s:18:\"id00801115@usal.es\";s:7:\"version\";s:5:\"6.3.2\";s:9:\"timestamp\";i:1697214353;}', 'no'),
(169, '_transient_health-check-site-status-result', '{\"good\":17,\"recommended\":5,\"critical\":1}', 'yes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_postmeta`
--

CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 3, '_wp_page_template', 'default');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_posts`
--

CREATE TABLE `wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(255) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2023-10-10 17:14:16', '2023-10-10 15:14:16', '<!-- wp:paragraph -->\n<p>Te damos la bienvenida a WordPress. Esta es tu primera entrada. Edítala o bórrala, ¡luego empieza a escribir!</p>\n<!-- /wp:paragraph -->', '¡Hola, mundo!', '', 'publish', 'open', 'open', '', 'hola-mundo', '', '', '2023-10-10 17:14:16', '2023-10-10 15:14:16', '', 0, 'http://localhost/wordpress/?p=1', 0, 'post', '', 1),
(2, 1, '2023-10-10 17:14:16', '2023-10-10 15:14:16', '<!-- wp:paragraph -->\n<p>Esta es una página de ejemplo. Es diferente a una entrada del blog porque permanecerá en un solo lugar y aparecerá en la navegación de tu sitio (en la mayoría de los temas). La mayoría de las personas comienzan con una página «Acerca de» que les presenta a los visitantes potenciales del sitio. Podrías decir algo así:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>¡Hola! Soy camarero de día, aspirante a actor de noche y esta es mi web. Vivo en Mairena del Alcor, tengo un perro que se llama Firulais y me gusta el rebujito. (Y las tardes largas con café).</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>…o algo así:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>La empresa «Mariscos Recio» fue fundada por Antonio Recio Mata. Empezó siendo una pequeña empresa que suministraba marisco a hoteles y restaurantes, pero poco a poco se ha ido transformando en un gran imperio. Mariscos Recio, el mar al mejor precio.</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>Como nuevo usuario de WordPress, deberías ir a <a href=\"http://localhost/wordpress/wp-admin/\">tu escritorio</a> para borrar esta página y crear nuevas páginas para tu contenido. ¡Pásalo bien!</p>\n<!-- /wp:paragraph -->', 'Página de ejemplo', '', 'publish', 'closed', 'open', '', 'pagina-ejemplo', '', '', '2023-10-10 17:14:16', '2023-10-10 15:14:16', '', 0, 'http://localhost/wordpress/?page_id=2', 0, 'page', '', 0),
(3, 1, '2023-10-10 17:14:16', '2023-10-10 15:14:16', '<!-- wp:heading --><h2>Quiénes somos</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Texto sugerido: </strong>La dirección de nuestra web es: http://localhost/wordpress.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Comentarios</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Texto sugerido: </strong>Cuando los visitantes dejan comentarios en la web, recopilamos los datos que se muestran en el formulario de comentarios, así como la dirección IP del visitante y la cadena de agentes de usuario del navegador para ayudar a la detección de spam.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Una cadena anónima creada a partir de tu dirección de correo electrónico (también llamada hash) puede ser proporcionada al servicio de Gravatar para ver si la estás usando. La política de privacidad del servicio Gravatar está disponible aquí: https://automattic.com/privacy/. Después de la aprobación de tu comentario, la imagen de tu perfil es visible para el público en el contexto de tu comentario.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Medios</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Texto sugerido: </strong>Si subes imágenes a la web, deberías evitar subir imágenes con datos de ubicación (GPS EXIF) incluidos. Los visitantes de la web pueden descargar y extraer cualquier dato de ubicación de las imágenes de la web.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Cookies</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Texto sugerido: </strong>Si dejas un comentario en nuestro sitio puedes elegir guardar tu nombre, dirección de correo electrónico y web en cookies. Esto es para tu comodidad, para que no tengas que volver a rellenar tus datos cuando dejes otro comentario. Estas cookies tendrán una duración de un año.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Si tienes una cuenta y te conectas a este sitio, instalaremos una cookie temporal para determinar si tu navegador acepta cookies. Esta cookie no contiene datos personales y se elimina al cerrar el navegador.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Cuando accedas, también instalaremos varias cookies para guardar tu información de acceso y tus opciones de visualización de pantalla. Las cookies de acceso duran dos días, y las cookies de opciones de pantalla duran un año. Si seleccionas «Recuérdarme», tu acceso perdurará durante dos semanas. Si sales de tu cuenta, las cookies de acceso se eliminarán.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Si editas o publicas un artículo se guardará una cookie adicional en tu navegador. Esta cookie no incluye datos personales y simplemente indica el ID del artículo que acabas de editar. Caduca después de 1 día.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Contenido incrustado de otros sitios web</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Texto sugerido: </strong>Los artículos de este sitio pueden incluir contenido incrustado (por ejemplo, vídeos, imágenes, artículos, etc.). El contenido incrustado de otras webs se comporta exactamente de la misma manera que si el visitante hubiera visitado la otra web.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Estas web pueden recopilar datos sobre ti, utilizar cookies, incrustar un seguimiento adicional de terceros, y supervisar tu interacción con ese contenido incrustado, incluido el seguimiento de tu interacción con el contenido incrustado si tienes una cuenta y estás conectado a esa web.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Con quién compartimos tus datos</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Texto sugerido: </strong>Si solicitas un restablecimiento de contraseña, tu dirección IP será incluida en el correo electrónico de restablecimiento.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Cuánto tiempo conservamos tus datos</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Texto sugerido: </strong>Si dejas un comentario, el comentario y sus metadatos se conservan indefinidamente. Esto es para que podamos reconocer y aprobar comentarios sucesivos automáticamente, en lugar de mantenerlos en una cola de moderación.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>De los usuarios que se registran en nuestra web (si los hay), también almacenamos la información personal que proporcionan en su perfil de usuario. Todos los usuarios pueden ver, editar o eliminar su información personal en cualquier momento (excepto que no pueden cambiar su nombre de usuario). Los administradores de la web también pueden ver y editar esa información.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Qué derechos tienes sobre tus datos</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Texto sugerido: </strong>Si tienes una cuenta o has dejado comentarios en esta web, puedes solicitar recibir un archivo de exportación de los datos personales que tenemos sobre ti, incluyendo cualquier dato que nos hayas proporcionado. También puedes solicitar que eliminemos cualquier dato personal que tengamos sobre ti. Esto no incluye ningún dato que estemos obligados a conservar con fines administrativos, legales o de seguridad.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Dónde se envían tus datos</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong class=\"privacy-policy-tutorial\">Texto sugerido: </strong>Los comentarios de los visitantes puede que los revise un servicio de detección automática de spam.</p><!-- /wp:paragraph -->', 'Política de privacidad', '', 'draft', 'closed', 'open', '', 'politica-privacidad', '', '', '2023-10-10 17:14:16', '2023-10-10 15:14:16', '', 0, 'http://localhost/wordpress/?page_id=3', 0, 'page', '', 0),
(4, 0, '2023-10-10 17:14:18', '2023-10-10 15:14:18', '<!-- wp:page-list /-->', 'Navegación', '', 'publish', 'closed', 'closed', '', 'navigation', '', '', '2023-10-10 17:14:18', '2023-10-10 15:14:18', '', 0, 'http://localhost/wordpress/2023/10/10/navigation/', 0, 'wp_navigation', '', 0),
(5, 1, '2023-10-10 17:14:43', '0000-00-00 00:00:00', '', 'Borrador automático', '', 'auto-draft', 'open', 'open', '', '', '', '', '2023-10-10 17:14:43', '0000-00-00 00:00:00', '', 0, 'http://localhost/wordpress/?p=5', 0, 'post', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_termmeta`
--

CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_terms`
--

CREATE TABLE `wp_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Sin categoría', 'sin-categoria', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_term_relationships`
--

CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_term_taxonomy`
--

CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_usermeta`
--

CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'Pedro'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'wp_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', ''),
(15, 1, 'show_welcome_panel', '1'),
(16, 1, 'session_tokens', 'a:1:{s:64:\"1a503af80919a2f51869b37b930bd36925348ca56ba59c2e12f28731c839632d\";a:4:{s:10:\"expiration\";i:1697123680;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36\";s:5:\"login\";i:1696950880;}}'),
(17, 1, 'wp_dashboard_quick_press_last_post_id', '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wp_users`
--

CREATE TABLE `wp_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Volcado de datos para la tabla `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'Pedro', '$P$BF.vEKz26NfSsw.kAlcRfTHZ4X0weu.', 'pedro', 'id00801115@usal.es', 'http://localhost/wordpress', '2023-10-10 15:14:16', '', 0, 'Pedro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indices de la tabla `wp_comments`
--
ALTER TABLE `wp_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Indices de la tabla `wp_links`
--
ALTER TABLE `wp_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indices de la tabla `wp_options`
--
ALTER TABLE `wp_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`),
  ADD KEY `autoload` (`autoload`);

--
-- Indices de la tabla `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indices de la tabla `wp_posts`
--
ALTER TABLE `wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indices de la tabla `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indices de la tabla `wp_terms`
--
ALTER TABLE `wp_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indices de la tabla `wp_term_relationships`
--
ALTER TABLE `wp_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indices de la tabla `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indices de la tabla `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indices de la tabla `wp_users`
--
ALTER TABLE `wp_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `wp_comments`
--
ALTER TABLE `wp_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `wp_links`
--
ALTER TABLE `wp_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `wp_options`
--
ALTER TABLE `wp_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT de la tabla `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `wp_posts`
--
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `wp_terms`
--
ALTER TABLE `wp_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `wp_users`
--
ALTER TABLE `wp_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
