# CyberSec Manager

Plataforma de Gestión de Servicios de Ciberseguridad

## Instalación Rápida (XAMPP)

### 1. Descargar el proyecto

Descargar o clonar el repositorio completo en la carpeta `htdocs` de XAMPP:

    git clone <url>

O descargar el ZIP y extraer en: `C:\xampp\htdocs\daw2-2025-26_C_ConsultoriaCiberseguridad`

### 2. Iniciar XAMPP

Abrir XAMPP Control Panel y ejecutar:
- Apache
- MySQL

### 3. Importar la base de datos

1. Abrir phpMyAdmin: http://localhost/phpmyadmin
2. Crear una nueva base de datos llamada: `daw2_cybersec_manager`
3. Importar el archivo: `SQL/database.sql`

### 4. Acceder a la aplicación

**Frontend:** http://localhost/daw2-2025-26_C_ConsultoriaCiberseguridad/frontend/web
**Backend:** http://localhost/daw2-2025-26_C_ConsultoriaCiberseguridad/backend/web



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
