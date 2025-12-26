-- =====================================================================================================================
-- MySQL Script - CyberSec Manager
-- Proyecto en Grupo - Plataforma de Gestión de Servicios de Ciberseguridad
-- Desarrollo de Aplicaciones Web II
-- Escuela Politécnica Superior de Zamora - Universidad de Salamanca
-- =====================================================================================================================
-- Versión: 1.0
-- Fecha: 13/12/2024
-- 
-- DESCRIPCIÓN:
-- Este script crea la base de datos para CyberSec Manager, una plataforma web que permite:
--   1. Comercializar servicios de ciberseguridad (Consultoría ISO27001/ENS/NIS2, Auditorías, SOC)
--   2. Gestionar proyectos de clientes con documentación y calendarios
--   3. Sistema de ticketing para incidencias de seguridad (SOC)
--   4. Portal de cliente para acceso a documentos y reportar incidentes
--
-- ROLES DE USUARIO (RBAC):
--   - invitado: Visitante que consulta el catálogo público
--   - cliente: Accede a su área privada, descarga documentos y reporta incidencias
--   - consultor: Gestiona proyectos de implantación de normativas
--   - auditor: Gestiona auditorías y calendario de eventos
--   - analista_soc: Gestiona el sistema de tickets/incidencias
--   - admin: Administración completa del sistema
-- =====================================================================================================================

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- =====================================================================================================================
-- CREACIÓN DEL SCHEMA
-- =====================================================================================================================
DROP SCHEMA IF EXISTS `daw2_cybersec_manager` ;
CREATE SCHEMA IF NOT EXISTS `daw2_cybersec_manager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ;
USE `daw2_cybersec_manager` ;

-- =====================================================================================================================
-- TABLA: usuarios
-- =====================================================================================================================
-- DESCRIPCIÓN: 
--   Almacena todos los usuarios del sistema (clientes y personal interno)
--   El rol determina los permisos de acceso según RBAC de Yii2
-- 
-- ROLES:
--   invitado      -> Visitante sin cuenta
--   cliente       -> Cliente que contrata servicios
--   consultor     -> Staff que implementa normativas (ISO27001, ENS, NIS2)
--   auditor       -> Staff que realiza auditorías y gestiona calendario
--   analista_soc  -> Staff que gestiona incidencias de seguridad
--   admin         -> Administrador del sistema
-- =====================================================================================================================
DROP TABLE IF EXISTS `usuarios` ;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL COMMENT 'Correo electrónico único del usuario',
  `password` VARCHAR(255) NOT NULL COMMENT 'Hash de la contraseña (usar bcrypt/Argon2)',
  `nombre` VARCHAR(100) NOT NULL COMMENT 'Nombre del usuario',
  `apellidos` VARCHAR(150) NULL DEFAULT NULL COMMENT 'Apellidos del usuario',
  `rol` ENUM('invitado', 'cliente', 'consultor', 'auditor', 'analista_soc', 'admin') NOT NULL DEFAULT 'invitado' COMMENT 'Rol del usuario en el sistema RBAC',
  `empresa` VARCHAR(200) NULL DEFAULT NULL COMMENT 'Nombre de la empresa (solo para clientes)',
  `telefono` VARCHAR(20) NULL DEFAULT NULL COMMENT 'Teléfono de contacto',
  `direccion` TEXT NULL DEFAULT NULL COMMENT 'Dirección completa',
  `fecha_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta en el sistema',
  `ultimo_acceso` DATETIME NULL DEFAULT NULL COMMENT 'Última vez que inició sesión',
  `intentos_acceso` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Contador de intentos fallidos de login',
  `bloqueado` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Si está bloqueado: 0=No, 1=Por intentos fallidos, 2=Por administrador',
  `fecha_bloqueo` DATETIME NULL DEFAULT NULL COMMENT 'Cuándo se bloqueó la cuenta',
  `motivo_bloqueo` TEXT NULL DEFAULT NULL COMMENT 'Razón del bloqueo',
  `activo` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Usuario activo: 0=Inactivo, 1=Activo',
  
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `idx_rol` (`rol` ASC) COMMENT 'Índice para búsquedas por rol'
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
COMMENT = 'Usuarios del sistema con autenticación y control de roles';

-- =====================================================================================================================
-- TABLA: servicios
-- =====================================================================================================================
-- DESCRIPCIÓN:
--   Catálogo de servicios de ciberseguridad que ofrece la empresa
--
-- CATEGORÍAS:
--   Gobernanza -> Implantación de normativas (ISO27001, ENS, NIS2)
--   Defensa    -> Servicios SOC, respuesta a incidentes
--   Auditoría  -> Pentesting, auditorías de cumplimiento
-- =====================================================================================================================
DROP TABLE IF EXISTS `servicios` ;

CREATE TABLE IF NOT EXISTS `servicios` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NOT NULL COMMENT 'Nombre del servicio (ej: "Implantación ISO 27001")',
  `descripcion` TEXT NULL DEFAULT NULL COMMENT 'Descripción detallada del servicio',
  `categoria` ENUM('Gobernanza', 'Defensa', 'Auditoría') NOT NULL DEFAULT 'Gobernanza' COMMENT 'Categoría del servicio',
  `precio_base` DECIMAL(10,2) NULL DEFAULT NULL COMMENT 'Precio de referencia en euros (puede ser NULL si es variable)',
  `duracion_estimada` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Duración típica en días',
  `requiere_auditoria` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Si requiere auditoría posterior: 0=No, 1=Sí',
  `activo` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Visible en catálogo: 0=No, 1=Sí',
  
  -- Campos de auditoría (quién creó/modificó el registro)
  `creado_por` INT UNSIGNED NULL DEFAULT NULL COMMENT 'ID del usuario que creó este servicio',
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Cuándo se creó',
  `modificado_por` INT UNSIGNED NULL DEFAULT NULL COMMENT 'ID del último usuario que lo modificó',
  `fecha_modificacion` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Última modificación',
  
  PRIMARY KEY (`id`),
  INDEX `idx_categoria` (`categoria` ASC),
  INDEX `idx_activo` (`activo` ASC),
  
  -- Claves foráneas para rastrear quién gestiona los servicios
  CONSTRAINT `fk_servicios_creador`
    FOREIGN KEY (`creado_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
    
  CONSTRAINT `fk_servicios_modificador`
    FOREIGN KEY (`modificado_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
COMMENT = 'Catálogo de servicios de ciberseguridad ofrecidos';

-- =====================================================================================================================
-- TABLA: proyectos
-- =====================================================================================================================
-- DESCRIPCIÓN:
--   Proyectos contratados por los clientes. Cada proyecto vincula:
--     - Un CLIENTE (quien contrata)
--     - Un SERVICIO (qué se contrató)
--     - Un CONSULTOR (quién implementa, si es de tipo Gobernanza)
--     - Un AUDITOR (quién audita, si requiere auditoría)
--
-- ESTADOS POSIBLES:
--   Planificación -> Proyecto nuevo, aún no iniciado
--   En curso      -> Actualmente en ejecución
--   En revisión   -> Esperando aprobación/revisión
--   Finalizado    -> Completado exitosamente
--   Cancelado     -> Cancelado antes de finalizar
--   Suspendido    -> Pausado temporalmente
-- =====================================================================================================================
DROP TABLE IF EXISTS `proyectos` ;

CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL COMMENT 'Nombre descriptivo (ej: "Implantación ENS para Empresa X")',
  `descripcion` TEXT NULL DEFAULT NULL COMMENT 'Descripción detallada del alcance',
  
  -- Relaciones principales del proyecto
  `cliente_id` INT UNSIGNED NOT NULL COMMENT 'ID del cliente que contrató (FK a usuarios con rol=cliente)',
  `servicio_id` INT UNSIGNED NOT NULL COMMENT 'ID del servicio contratado (FK a servicios)',
  `consultor_id` INT UNSIGNED NULL DEFAULT NULL COMMENT 'ID del consultor asignado (FK a usuarios con rol=consultor)',
  `auditor_id` INT UNSIGNED NULL DEFAULT NULL COMMENT 'ID del auditor asignado (FK a usuarios con rol=auditor)',
  
  -- Fechas y control del proyecto
  `fecha_inicio` DATE NOT NULL COMMENT 'Fecha de inicio del proyecto',
  `fecha_fin_prevista` DATE NULL DEFAULT NULL COMMENT 'Fecha estimada de finalización',
  `fecha_fin_real` DATE NULL DEFAULT NULL COMMENT 'Fecha real de cierre (NULL si no ha finalizado)',
  `estado` ENUM('Planificación', 'En curso', 'En revisión', 'Finalizado', 'Cancelado', 'Suspendido') NOT NULL DEFAULT 'Planificación' COMMENT 'Estado actual del proyecto',
  `presupuesto` DECIMAL(10,2) NULL DEFAULT NULL COMMENT 'Presupuesto acordado en euros',
  `notas_internas` TEXT NULL DEFAULT NULL COMMENT 'Notas del equipo (no visibles para el cliente)',
  
  -- Campos de auditoría
  `creado_por` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Quién creó el proyecto',
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modificado_por` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Quién lo modificó por última vez',
  `fecha_modificacion` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`id`),
  INDEX `idx_cliente` (`cliente_id` ASC),
  INDEX `idx_servicio` (`servicio_id` ASC),
  INDEX `idx_estado` (`estado` ASC),
  
  -- Claves foráneas: cada proyecto DEBE tener cliente y servicio
  CONSTRAINT `fk_proyectos_cliente`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE RESTRICT  -- No permitir borrar cliente si tiene proyectos
    ON UPDATE CASCADE,
    
  CONSTRAINT `fk_proyectos_servicio`
    FOREIGN KEY (`servicio_id`)
    REFERENCES `servicios` (`id`)
    ON DELETE RESTRICT  -- No permitir borrar servicio si está en uso
    ON UPDATE CASCADE,
    
  -- Consultor y Auditor son opcionales (pueden ser NULL)
  CONSTRAINT `fk_proyectos_consultor`
    FOREIGN KEY (`consultor_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL  -- Si se borra el consultor, el proyecto queda sin asignar
    ON UPDATE CASCADE,
    
  CONSTRAINT `fk_proyectos_auditor`
    FOREIGN KEY (`auditor_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
    
  CONSTRAINT `fk_proyectos_creador`
    FOREIGN KEY (`creado_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
    
  CONSTRAINT `fk_proyectos_modificador`
    FOREIGN KEY (`modificado_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
COMMENT = 'Proyectos contratados por clientes';

-- =====================================================================================================================
-- TABLA: documentos
-- =====================================================================================================================
-- DESCRIPCIÓN:
--   Documentos generados en los proyectos (políticas, procedimientos, informes)
--   Los consultores suben documentos que los clientes pueden descargar
--
-- TIPOS DE DOCUMENTO:
--   Política                -> Política de seguridad
--   Procedimiento           -> Procedimiento operativo
--   Informe de Auditoría    -> Resultado de auditoría
--   Informe SOC             -> Informe de incidente
--   Plan de Acción          -> Plan de mejora
--   Certificado             -> Certificación obtenida
--   Documentación Técnica   -> Manuales, guías
--   Otros                   -> Otros documentos
-- =====================================================================================================================
DROP TABLE IF EXISTS `documentos` ;

CREATE TABLE IF NOT EXISTS `documentos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `proyecto_id` INT UNSIGNED NOT NULL COMMENT 'Proyecto al que pertenece (FK a proyectos)',
  `nombre_archivo` VARCHAR(255) NOT NULL COMMENT 'Nombre del archivo (ej: "Politica_Seguridad_v2.pdf")',
  `descripcion` TEXT NULL DEFAULT NULL COMMENT 'Descripción del contenido',
  `ruta_archivo` TEXT NOT NULL COMMENT 'Ruta en el servidor donde se guarda el archivo',
  `tipo_documento` ENUM('Política', 'Procedimiento', 'Informe de Auditoría', 'Informe SOC', 'Plan de Acción', 'Certificado', 'Documentación Técnica', 'Otros') NOT NULL DEFAULT 'Otros' COMMENT 'Tipo de documento',
  `tamaño_bytes` BIGINT UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Tamaño del archivo en bytes',
  `version` VARCHAR(20) NULL DEFAULT '1.0' COMMENT 'Versión del documento',
  `visible_cliente` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Si el cliente puede verlo: 0=No, 1=Sí',
  `hash_verificacion` VARCHAR(64) NULL DEFAULT NULL COMMENT 'Hash SHA-256 para verificar integridad del archivo',
  
  -- Control de subida
  `subido_por` INT UNSIGNED NOT NULL COMMENT 'Usuario que subió el documento (FK a usuarios)',
  `fecha_subida` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Cuándo se subió',
  `fecha_modificacion` DATETIME NULL DEFAULT NULL COMMENT 'Si se modificó el archivo',
  `notas` TEXT NULL DEFAULT NULL COMMENT 'Notas adicionales sobre el documento',
  
  PRIMARY KEY (`id`),
  INDEX `idx_proyecto` (`proyecto_id` ASC),
  INDEX `idx_tipo` (`tipo_documento` ASC),
  
  -- Un documento DEBE pertenecer a un proyecto
  CONSTRAINT `fk_documentos_proyecto`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `proyectos` (`id`)
    ON DELETE CASCADE  -- Si se borra el proyecto, se borran sus documentos
    ON UPDATE CASCADE,
    
  -- Debe haber un responsable de la subida
  CONSTRAINT `fk_documentos_usuario`
    FOREIGN KEY (`subido_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE RESTRICT  -- No borrar usuario si tiene documentos
    ON UPDATE CASCADE
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
COMMENT = 'Documentos entregables de los proyectos';

-- =====================================================================================================================
-- TABLA: eventos_calendario
-- =====================================================================================================================
-- DESCRIPCIÓN:
--   Calendario de eventos relacionados con proyectos (principalmente auditorías)
--   Los auditores programan fechas que ven consultores y clientes
--
-- TIPOS DE EVENTO:
--   Auditoría Interna          -> Auditoría interna del cliente
--   Auditoría de Certificación -> Auditoría oficial para certificar
--   Auditoría de Seguimiento   -> Revisión periódica
--   Reunión Cliente            -> Reunión de coordinación
--   Revisión Documental        -> Revisión de documentos
--   Entrega Resultados         -> Presentación de resultados
--   Otros                      -> Otros eventos
--
-- ESTADOS:
--   Programado  -> Agendado pero no confirmado
--   Confirmado  -> Confirmado por todas las partes
--   En curso    -> Evento en ejecución
--   Completado  -> Finalizado
--   Pospuesto   -> Reprogramado
--   Cancelado   -> Cancelado definitivamente
-- =====================================================================================================================
DROP TABLE IF EXISTS `eventos_calendario` ;

CREATE TABLE IF NOT EXISTS `eventos_calendario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `proyecto_id` INT UNSIGNED NOT NULL COMMENT 'Proyecto relacionado (FK a proyectos)',
  `auditor_id` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Auditor responsable (FK a usuarios con rol=auditor)',
  `titulo` VARCHAR(200) NOT NULL COMMENT 'Título del evento (ej: "Auditoría ISO 27001 - Fase 1")',
  `descripcion` TEXT NULL DEFAULT NULL COMMENT 'Descripción detallada',
  `fecha` DATE NOT NULL COMMENT 'Fecha del evento',
  `hora_inicio` TIME NOT NULL COMMENT 'Hora de inicio',
  `hora_fin` TIME NULL DEFAULT NULL COMMENT 'Hora de finalización (puede no estar definida)',
  `tipo_evento` ENUM('Auditoría Interna', 'Auditoría de Certificación', 'Auditoría de Seguimiento', 'Reunión Cliente', 'Revisión Documental', 'Entrega Resultados', 'Otros') NOT NULL DEFAULT 'Otros' COMMENT 'Tipo de evento',
  `ubicacion` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Lugar (dirección o "Virtual - Zoom")',
  `estado_evento` ENUM('Programado', 'Confirmado', 'En curso', 'Completado', 'Pospuesto', 'Cancelado') NOT NULL DEFAULT 'Programado' COMMENT 'Estado actual',
  `recordatorio_enviado` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Si ya se envió recordatorio: 0=No, 1=Sí',
  `notas` TEXT NULL DEFAULT NULL COMMENT 'Notas adicionales',
  
  -- Campos de auditoría
  `creado_por` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Quién creó el evento',
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modificado_por` INT UNSIGNED NULL DEFAULT NULL,
  `fecha_modificacion` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`id`),
  INDEX `idx_proyecto` (`proyecto_id` ASC),
  INDEX `idx_fecha` (`fecha` ASC),
  INDEX `idx_estado` (`estado_evento` ASC),
  
  -- Todo evento DEBE estar asociado a un proyecto
  CONSTRAINT `fk_eventos_proyecto`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `proyectos` (`id`)
    ON DELETE CASCADE  -- Si se borra el proyecto, se borran sus eventos
    ON UPDATE CASCADE,
    
  -- El auditor es opcional (puede no estar asignado aún)
  CONSTRAINT `fk_eventos_auditor`
    FOREIGN KEY (`auditor_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
    
  CONSTRAINT `fk_eventos_creador`
    FOREIGN KEY (`creado_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
    
  CONSTRAINT `fk_eventos_modificador`
    FOREIGN KEY (`modificado_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
COMMENT = 'Calendario de eventos y auditorías';

-- =====================================================================================================================
-- TABLA: incidencias
-- =====================================================================================================================
-- DESCRIPCIÓN:
--   Sistema de ticketing SOC para incidencias de seguridad
--   Los clientes reportan incidentes y los analistas SOC las gestionan
--
-- SEVERIDADES:
--   Crítica     -> Requiere atención inmediata (< 15 min)
--   Alta        -> Muy urgente (< 1 hora)
--   Media       -> Urgente (< 4 horas)
--   Baja        -> Normal (< 24 horas)
--   Informativa -> Solo informativo
--
-- ESTADOS:
--   Abierto          -> Recién reportada, sin asignar
--   Asignado         -> Asignada a un analista
--   En Análisis      -> Siendo investigada
--   En Contención    -> Conteniendo el incidente
--   En Remediación   -> Aplicando solución
--   Resuelto         -> Solucionada, pendiente de cierre
--   Cerrado          -> Cerrada definitivamente
--   Falso Positivo   -> No era una incidencia real
-- =====================================================================================================================
DROP TABLE IF EXISTS `incidencias` ;

CREATE TABLE IF NOT EXISTS `incidencias` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cliente_id` INT UNSIGNED NOT NULL COMMENT 'Cliente que reporta (FK a usuarios con rol=cliente)',
  `analista_id` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Analista SOC asignado (FK a usuarios con rol=analista_soc)',
  `titulo` VARCHAR(255) NOT NULL COMMENT 'Título breve de la incidencia',
  `descripcion` TEXT NOT NULL COMMENT 'Descripción detallada del problema',
  `severidad` ENUM('Crítica', 'Alta', 'Media', 'Baja', 'Informativa') NOT NULL DEFAULT 'Media' COMMENT 'Nivel de severidad',
  `estado_incidencia` ENUM('Abierto', 'Asignado', 'En Análisis', 'En Contención', 'En Remediación', 'Resuelto', 'Cerrado', 'Falso Positivo') NOT NULL DEFAULT 'Abierto' COMMENT 'Estado actual',
  `categoria_incidencia` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Categoría (malware, phishing, DDoS, etc.)',
  
  -- Control de tiempos para SLA (Service Level Agreement)
  `fecha_reporte` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Cuándo se reportó',
  `fecha_asignacion` DATETIME NULL DEFAULT NULL COMMENT 'Cuándo se asignó a un analista',
  `fecha_primera_respuesta` DATETIME NULL DEFAULT NULL COMMENT 'Primera respuesta del analista',
  `fecha_resolucion` DATETIME NULL DEFAULT NULL COMMENT 'Cuándo se resolvió',
  `tiempo_resolucion` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Minutos que tomó resolver (calculado)',
  `sla_cumplido` TINYINT(1) NULL DEFAULT NULL COMMENT 'Si se cumplió el SLA: 0=No, 1=Sí, NULL=No evaluado',
  
  -- Información técnica
  `ip_origen` VARCHAR(45) NULL DEFAULT NULL COMMENT 'IP desde donde se detectó (IPv4 o IPv6)',
  `sistema_afectado` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Sistema o servidor afectado',
  `acciones_tomadas` TEXT NULL DEFAULT NULL COMMENT 'Descripción de acciones realizadas',
  `notas_internas` TEXT NULL DEFAULT NULL COMMENT 'Notas del equipo SOC',
  `visible_cliente` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Si el cliente puede ver esta incidencia: 0=No, 1=Sí',
  
  PRIMARY KEY (`id`),
  INDEX `idx_cliente` (`cliente_id` ASC),
  INDEX `idx_analista` (`analista_id` ASC),
  INDEX `idx_severidad` (`severidad` ASC),
  INDEX `idx_estado` (`estado_incidencia` ASC),
  INDEX `idx_fecha` (`fecha_reporte` ASC),
  
  -- Toda incidencia DEBE tener un cliente que la reporta
  CONSTRAINT `fk_incidencias_cliente`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE RESTRICT  -- No borrar cliente si tiene incidencias
    ON UPDATE CASCADE,
    
  -- El analista es opcional (puede no estar asignada aún)
  CONSTRAINT `fk_incidencias_analista`
    FOREIGN KEY (`analista_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL  -- Si se borra el analista, la incidencia queda sin asignar
    ON UPDATE CASCADE
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
COMMENT = 'Sistema de ticketing SOC para incidencias de seguridad';

-- =====================================================================================================================
-- TABLA: solicitudes_presupuesto
-- =====================================================================================================================
-- DESCRIPCIÓN:
--   Formularios de solicitud de presupuesto desde la web pública
--   Potenciales clientes solicitan información sobre servicios
--
-- ESTADOS:
--   Pendiente           -> Recién recibida, sin revisar
--   En Revisión         -> Siendo evaluada por el equipo
--   Contactado          -> Ya se contactó al cliente
--   Presupuesto Enviado -> Se envió propuesta formal
--   Negociación         -> En proceso de negociación
--   Contratado          -> Se cerró la venta (se crea proyecto)
--   Rechazado           -> Cliente rechazó la oferta
--   Cancelado           -> Se canceló el proceso
-- =====================================================================================================================
DROP TABLE IF EXISTS `solicitudes_presupuesto` ;

CREATE TABLE IF NOT EXISTS `solicitudes_presupuesto` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `servicio_id` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Servicio de interés (FK a servicios), NULL si es consulta general',
  
  -- Datos de contacto
  `nombre_contacto` VARCHAR(150) NOT NULL COMMENT 'Nombre completo',
  `email_contacto` VARCHAR(255) NOT NULL COMMENT 'Email para responder',
  `telefono_contacto` VARCHAR(20) NULL DEFAULT NULL COMMENT 'Teléfono (opcional)',
  
  -- Datos de empresa
  `empresa` VARCHAR(200) NOT NULL COMMENT 'Nombre de la empresa',
  `nif_cif` VARCHAR(20) NULL DEFAULT NULL COMMENT 'NIF/CIF fiscal (opcional)',
  `num_empleados` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Tamaño de la empresa',
  `sector_actividad` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Sector (ej: Banca, Salud, Industrial)',
  
  -- Detalles de la necesidad
  `descripcion_necesidad` TEXT NOT NULL COMMENT 'Qué necesita el cliente',
  `alcance_solicitado` TEXT NULL DEFAULT NULL COMMENT 'Alcance específico (opcional)',
  `presupuesto_estimado` DECIMAL(10,2) NULL DEFAULT NULL COMMENT 'Presupuesto máximo del cliente (opcional)',
  `fecha_inicio_deseada` DATE NULL DEFAULT NULL COMMENT 'Cuándo desea empezar',
  
  -- Gestión de la solicitud
  `estado_solicitud` ENUM('Pendiente', 'En Revisión', 'Contactado', 'Presupuesto Enviado', 'Negociación', 'Contratado', 'Rechazado', 'Cancelado') NOT NULL DEFAULT 'Pendiente' COMMENT 'Estado del proceso comercial',
  `prioridad` TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Prioridad: 1=Baja, 2=Media, 3=Alta, 4=Urgente',
  `fecha_solicitud` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Cuándo se recibió',
  `fecha_contacto` DATETIME NULL DEFAULT NULL COMMENT 'Cuándo se contactó al cliente',
  `usuario_asignado_id` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Usuario de ventas asignado (FK a usuarios)',
  `notas_comerciales` TEXT NULL DEFAULT NULL COMMENT 'Notas del equipo de ventas',
  `origen_solicitud` VARCHAR(50) NOT NULL DEFAULT 'Web' COMMENT 'Origen: Web, Teléfono, Email, Referido, Evento',
  
  PRIMARY KEY (`id`),
  INDEX `idx_servicio` (`servicio_id` ASC),
  INDEX `idx_estado` (`estado_solicitud` ASC),
  INDEX `idx_fecha` (`fecha_solicitud` ASC),
  
  -- El servicio es opcional (puede ser consulta general)
  CONSTRAINT `fk_solicitudes_servicio`
    FOREIGN KEY (`servicio_id`)
    REFERENCES `servicios` (`id`)
    ON DELETE SET NULL  -- Si se borra el servicio, la solicitud sigue existiendo
    ON UPDATE CASCADE,
    
  -- El usuario asignado es opcional (puede no estar asignado)
  CONSTRAINT `fk_solicitudes_usuario`
    FOREIGN KEY (`usuario_asignado_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
COMMENT = 'Solicitudes de presupuesto desde la web pública';

-- =====================================================================================================================
-- TABLA: cursos
-- =====================================================================================================================
-- DESCRIPCIÓN:
--   Cursos de formación en ciberseguridad que la empresa ofrece a sus clientes
--   Modalidad e-learning de autoformación (el cliente lo realiza a su ritmo)
--
-- EJEMPLOS:
--   - "Concienciación en Phishing"
--   - "Seguridad en Teletrabajo"
--   - "Protección de Datos Personales (RGPD)"
--   - "Gestión de Contraseñas Seguras"
-- =====================================================================================================================
DROP TABLE IF EXISTS `cursos` ;

CREATE TABLE IF NOT EXISTS `cursos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NOT NULL COMMENT 'Nombre del curso (ej: "Concienciación Phishing")',
  `descripcion` TEXT NULL DEFAULT NULL COMMENT 'Descripción del contenido del curso',
  `imagen_portada` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Ruta a la imagen de portada del curso o NULL si no tiene',
  `nota_minima_aprobado` DECIMAL(4,2) NOT NULL DEFAULT 5.00 COMMENT 'Nota mínima para aprobar el cuestionario (ej: 5.00 sobre 10)',
  `activo` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Curso activo y disponible: 0=Inactivo, 1=Activo',
  
  -- Campos de auditoría
  `creado_por` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Usuario que creó el curso',
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modificado_por` INT UNSIGNED NULL DEFAULT NULL,
  `fecha_modificacion` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`id`),
  INDEX `idx_activo` (`activo` ASC),
  
  CONSTRAINT `fk_cursos_creador`
    FOREIGN KEY (`creado_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
    
  CONSTRAINT `fk_cursos_modificador`
    FOREIGN KEY (`modificado_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
COMMENT = 'Cursos de formación e-learning en ciberseguridad';

-- =====================================================================================================================
-- TABLA: diapositivas
-- =====================================================================================================================
-- DESCRIPCIÓN:
--   Contenido de cada curso dividido en diapositivas (slides)
--   El usuario navega secuencialmente: diapositiva 1 → 2 → 3 → ... → última
--   Al terminar la última diapositiva, se desbloquea el cuestionario
--
-- FUNCIONAMIENTO:
--   - Cada diapositiva tiene texto explicativo, imágenes y opcionalmente videos
--   - El sistema lleva control de qué diapositiva está viendo cada usuario (tabla progreso_usuario)
--   - Funciona como un carrusel/presentación paso a paso
-- =====================================================================================================================
DROP TABLE IF EXISTS `diapositivas` ;

CREATE TABLE IF NOT EXISTS `diapositivas` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `curso_id` INT UNSIGNED NOT NULL COMMENT 'Curso al que pertenece (FK a cursos)',
  `numero_orden` INT UNSIGNED NOT NULL COMMENT 'Orden de la diapositiva (1, 2, 3, ...). Determina la secuencia.',
  `titulo` VARCHAR(255) NOT NULL COMMENT 'Título de la diapositiva',
  `contenido_html` TEXT NULL DEFAULT NULL COMMENT 'Contenido explicativo en formato HTML o NULL si solo tiene multimedia',
  `imagen_url` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Ruta a imagen/esquema explicativo o NULL si no tiene',
  `video_url` VARCHAR(500) NULL DEFAULT NULL COMMENT 'URL a video (YouTube, Vimeo, servidor propio) o NULL si no tiene',
  
  -- Campos de auditoría
  `creado_por` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Usuario que creó la diapositiva',
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modificado_por` INT UNSIGNED NULL DEFAULT NULL,
  `fecha_modificacion` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`id`),
  INDEX `idx_curso` (`curso_id` ASC),
  INDEX `idx_orden` (`curso_id` ASC, `numero_orden` ASC),
  
  -- Toda diapositiva DEBE pertenecer a un curso
  CONSTRAINT `fk_diapositivas_curso`
    FOREIGN KEY (`curso_id`)
    REFERENCES `cursos` (`id`)
    ON DELETE CASCADE  -- Si se borra el curso, se borran todas sus diapositivas
    ON UPDATE CASCADE,
    
  CONSTRAINT `fk_diapositivas_creador`
    FOREIGN KEY (`creado_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
    
  CONSTRAINT `fk_diapositivas_modificador`
    FOREIGN KEY (`modificado_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
COMMENT = 'Diapositivas/slides que componen cada curso';

-- =====================================================================================================================
-- TABLA: preguntas_cuestionario
-- =====================================================================================================================
-- DESCRIPCIÓN:
--   Preguntas tipo test de opción múltiple para evaluar el curso
--   Cada curso tiene su batería de preguntas (normalmente 5-10 preguntas)
--   Corrección automática comparando la respuesta del usuario con opcion_correcta
--
-- FORMATO:
--   - Pregunta con 3 opciones (A, B, C)
--   - Solo una opción es correcta
--   - El sistema calcula automáticamente la nota: (correctas/total) * 10
-- =====================================================================================================================
DROP TABLE IF EXISTS `preguntas_cuestionario` ;

CREATE TABLE IF NOT EXISTS `preguntas_cuestionario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `curso_id` INT UNSIGNED NOT NULL COMMENT 'Curso al que pertenece la pregunta (FK a cursos)',
  `enunciado_pregunta` TEXT NOT NULL COMMENT 'Texto de la pregunta',
  `opcion_a` VARCHAR(500) NOT NULL COMMENT 'Texto de la opción A',
  `opcion_b` VARCHAR(500) NOT NULL COMMENT 'Texto de la opción B',
  `opcion_c` VARCHAR(500) NOT NULL COMMENT 'Texto de la opción C',
  `opcion_correcta` ENUM('a', 'b', 'c') NOT NULL COMMENT 'Cuál es la respuesta correcta',
  
  -- Campos de auditoría
  `creado_por` INT UNSIGNED NULL DEFAULT NULL COMMENT 'Usuario que creó la pregunta',
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modificado_por` INT UNSIGNED NULL DEFAULT NULL,
  `fecha_modificacion` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`id`),
  INDEX `idx_curso` (`curso_id` ASC),
  
  -- Toda pregunta DEBE pertenecer a un curso
  CONSTRAINT `fk_preguntas_curso`
    FOREIGN KEY (`curso_id`)
    REFERENCES `cursos` (`id`)
    ON DELETE CASCADE  -- Si se borra el curso, se borran todas sus preguntas
    ON UPDATE CASCADE,
    
  CONSTRAINT `fk_preguntas_creador`
    FOREIGN KEY (`creado_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
    
  CONSTRAINT `fk_preguntas_modificador`
    FOREIGN KEY (`modificado_por`)
    REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
COMMENT = 'Preguntas tipo test para evaluación de cursos';

-- =====================================================================================================================
-- TABLA: progreso_usuario
-- =====================================================================================================================
-- DESCRIPCIÓN:
--   Seguimiento del avance individual de cada cliente en cada curso
--   Almacena: qué diapositiva está viendo, si hizo el test, qué nota obtuvo
--
-- FUNCIONAMIENTO:
--   1. Cliente empieza curso → se crea registro con estado='En curso', diapositiva_actual=1
--   2. Cliente navega → se actualiza diapositiva_actual (2, 3, 4...)
--   3. Cliente termina diapositivas → puede hacer cuestionario
--   4. Cliente hace test → cuestionario_realizado=1, se calcula nota_obtenida
--   5. Sistema evalúa → si nota >= nota_minima_aprobado: estado='Aprobado', sino 'Suspenso'
--
-- ESTADOS:
--   En curso  -> Aún no ha terminado
--   Aprobado  -> Completó y superó el test
--   Suspenso  -> Completó pero no superó el test (puede reintentar)
-- =====================================================================================================================
DROP TABLE IF EXISTS `progreso_usuario` ;

CREATE TABLE IF NOT EXISTS `progreso_usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` INT UNSIGNED NOT NULL COMMENT 'Cliente realizando el curso (FK a usuarios con rol=cliente)',
  `curso_id` INT UNSIGNED NOT NULL COMMENT 'Curso que está realizando (FK a cursos)',
  `diapositiva_actual` INT UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Última diapositiva vista (número de orden)',
  `cuestionario_realizado` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Si ya hizo el test final: 0=No, 1=Sí',
  `nota_obtenida` DECIMAL(4,2) NULL DEFAULT NULL COMMENT 'Nota del cuestionario (0-10) o NULL si no lo ha hecho',
  `fecha_inicio` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Cuándo empezó el curso',
  `fecha_fin` DATETIME NULL DEFAULT NULL COMMENT 'Cuándo completó el curso (aprobó o suspendió)',
  `estado` ENUM('En curso', 'Aprobado', 'Suspenso') NOT NULL DEFAULT 'En curso' COMMENT 'Estado actual del progreso',
  
  PRIMARY KEY (`id`),
  INDEX `idx_usuario` (`usuario_id` ASC),
  INDEX `idx_curso` (`curso_id` ASC),
  UNIQUE INDEX `idx_usuario_curso` (`usuario_id` ASC, `curso_id` ASC) COMMENT 'Un usuario solo puede tener un progreso activo por curso',
  
  -- El usuario debe existir (normalmente un cliente)
  CONSTRAINT `fk_progreso_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE CASCADE  -- Si se borra el usuario, se borra su progreso
    ON UPDATE CASCADE,
    
  -- El curso debe existir
  CONSTRAINT `fk_progreso_curso`
    FOREIGN KEY (`curso_id`)
    REFERENCES `cursos` (`id`)
    ON DELETE CASCADE  -- Si se borra el curso, se borra el progreso de todos
    ON UPDATE CASCADE
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci
COMMENT = 'Seguimiento del progreso individual de cada usuario en cada curso';

-- =====================================================================================================================
-- RESTAURAR CONFIGURACIÓN ORIGINAL
-- =====================================================================================================================
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- =====================================================================================================================
-- NOTAS FINALES
-- =====================================================================================================================
-- 
-- TOTAL DE TABLAS: 11
--   MÓDULO PRINCIPAL (7 tablas):
--     1. usuarios - Autenticación y control de roles
--     2. servicios - Catálogo de servicios de ciberseguridad
--     3. proyectos - Proyectos contratados por clientes
--     4. documentos - Archivos entregables de proyectos
--     5. eventos_calendario - Calendario de auditorías y eventos
--     6. incidencias - Sistema de ticketing SOC
--     7. solicitudes_presupuesto - Formularios de captación comercial
--
--   MÓDULO DE FORMACIÓN (4 tablas):
--     8. cursos - Cursos e-learning de ciberseguridad
--     9. diapositivas - Contenido de cada curso (slides)
--     10. preguntas_cuestionario - Preguntas tipo test para evaluación
--     11. progreso_usuario - Seguimiento individual del avance en cursos
--
-- POLÍTICAS DE CLAVES FORÁNEAS:
--   ON DELETE RESTRICT -> No permite borrar si hay referencias (protege datos críticos)
--                         Ejemplo: No borrar cliente si tiene proyectos activos
--   
--   ON DELETE CASCADE  -> Borra en cascada (elimina registros dependientes)
--                         Ejemplo: Si borro proyecto, borro sus documentos
--                         Ejemplo: Si borro curso, borro sus diapositivas y preguntas
--   
--   ON DELETE SET NULL -> Pone NULL si se borra (mantiene el registro pero sin referencia)
--                         Ejemplo: Si borro consultor, proyecto queda sin asignar
--   
--   ON UPDATE CASCADE  -> Actualiza automáticamente si cambia el ID referenciado
--
-- ÍNDICES CREADOS:
--   - Claves foráneas (mejora JOIN performance)
--   - Campos de búsqueda frecuente (estado, fecha, rol, severidad)
--   - Campos únicos (email)
--   - Índices compuestos (usuario_id + curso_id en progreso_usuario)
--
-- CHARSET:
--   utf8mb4 -> Soporta caracteres especiales, tildes, ñ y emojis
--              (Mejor que utf8 estándar que tiene limitaciones)
--
-- SEGURIDAD:
--   - El campo 'password' debe almacenar SOLO hashes (nunca texto plano)
--   - Usar password_hash() de PHP con PASSWORD_BCRYPT o PASSWORD_ARGON2ID
--   - Validar y sanitizar todas las entradas antes de INSERT/UPDATE
--   - Implementar control de acceso RBAC en Yii2 (uso del campo 'rol')
--   - Proteger rutas de archivos con .htaccess o almacenarlos fuera de webroot
--   - Calcular hash_verificacion (SHA-256) en documentos para detectar manipulación
--
-- MÓDULO DE FORMACIÓN - FLUJO TÍPICO:
--   1. Admin crea un Curso nuevo (ej: "Concienciación Phishing")
--   2. Admin añade Diapositivas al curso (slide 1, 2, 3... con contenido)
--   3. Admin añade Preguntas_Cuestionario (batería de test con respuestas)
--   4. Cliente accede al curso → se crea registro en Progreso_Usuario
--   5. Cliente navega por diapositivas → se actualiza diapositiva_actual
--   6. Cliente completa todas las diapositivas → se habilita el cuestionario
--   7. Cliente hace el test → sistema calcula nota_obtenida automáticamente
--   8. Sistema compara nota con nota_minima_aprobado del curso
--   9. Si nota >= mínimo → estado='Aprobado', sino estado='Suspenso'
--   10. Cliente puede reintentar si suspende (resetear cuestionario_realizado)
--
-- CONSIDERACIONES DE DISEÑO:
--   - Los cursos NO tienen fechas de inicio/fin (son autoformativos)
--   - El orden de las diapositivas es CRÍTICO (campo numero_orden)
--   - Un usuario solo puede tener UN progreso activo por curso (UNIQUE INDEX)
--   - Las preguntas son siempre de 3 opciones (a, b, c) para simplificar
--   - La nota se calcula: (respuestas_correctas / total_preguntas) * 10
--
-- =====================================================================================================================
