# CyberSec Manager
Plataforma de Gestión de Servicios de Ciberseguridad

### Guía de Despliegue y Pruebas
Para poner en marcha el proyecto en otro equipo, sigue estos pasos:

1. Descargar el código
Clona el repositorio o descomprime el ZIP en htdocs: git clone <url>

2. Instalación Automática
El proyecto incluye un script que instala las dependencias (PHP/Composer) y configura la base de datos automáticamente.

Haz doble clic en 
instalar_todo.bat
.
El script descargará las librerías necesarias.
Cuando te pregunte "¿Desea importar la base de datos?", responde Sí (S).
Nota: Si prefieres hacerlo manualmente o el script falla:

Abre phpMyAdmin y crea una BD llamada daw2_cybersec_manager.
Importa el archivo 
SQL/database.sql

Configura tus credenciales en 
common/config/main-local.php

3. Probando la Verificación en 2 Pasos (2FA)
El sistema incluye autenticación de doble factor. Para probarla:

Accede al Frontend: http://localhost/<TU_CARPETA_PROYECTO>/frontend/web
Inicia sesión 
Ve a Configuración 
Baja a la sección Seguridad y haz clic en "Verificación en dos pasos".
Escanea el QR con Google Authenticator e introduce el código.
Sal del sistema (Logout) y vuelve a entrar para verificar que te pide el código.

Rutas de Acceso:

Frontend (Usuarios): http://localhost/<TU_CARPETA_PROYECTO>/frontend/web
Backend (Gestión): http://localhost/<TU_CARPETA_PROYECTO>/backend/web



DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations (database, RBAC)
    mail/                contains view files for e-mails
    models/              contains shared models (User, SolicitudesPresupuesto, Servicios, etc.)
    tests/               contains tests for common classes
console
    config/              contains console configurations
    controllers/         contains console controllers (RbacController for RBAC management)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains backend controllers (CRM, Proyectos, Cursos, Calendario, etc.)
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application
    views/               contains view files for backend modules
        crm/             CRM module (gestión de solicitudes de presupuesto)
        proyectos/       Proyectos module
        cursos/          Formación module
        calendarios/     Calendario de eventos
        documentos/      Gestión documental
        site/            Backend dashboard and authentication
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains frontend controllers (SiteController)
    models/              contains frontend-specific models (SignupForm, etc.)
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for frontend
        site/            Public pages (home, catálogo, login, signup, etc.)
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
SQL/                     contains database schema (database.sql)
```
