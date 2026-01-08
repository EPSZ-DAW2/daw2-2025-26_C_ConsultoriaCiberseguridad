# CyberSec Manager

Plataforma de Gestión de Servicios de Ciberseguridad

## Instalación

### Clone del repositorio

    git clone <url>
    cd daw2-2025-26_C_ConsultoriaCiberseguridad

### Instalar dependencias con Composer

    composer install

### Inicializar el proyecto Yii2

    php init
    (Seleccionar 0 para Development)

### Configurar base de datos

Editar common/config/main-local.php con credenciales MySQL

    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=daw2_cybersec_manager',
        'username' => 'root',
        'password' => '',
    ],

### Abrir XAMPP, ejecutar Apache y MySQL

### Importar database.sql

### Inicializar RBAC

    php yii rbac/init

### Asignar roles a usuarios

    php yii rbac/assign-all

### XAMPP apuntando a:

Frontend: http://localhost/daw2-2025-26_C_ConsultoriaCiberseguridad/frontend/web  
Backend: http://localhost/daw2-2025-26_C_ConsultoriaCiberseguridad/backend/web

o ejecutar servidor de desarrollo:

Frontend:

    php yii serve --port=8080 --docroot=@frontend/web

Backend:

    php yii serve --port=8081 --docroot=@backend/web


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
