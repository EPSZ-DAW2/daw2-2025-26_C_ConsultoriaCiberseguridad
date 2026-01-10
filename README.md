# CyberSec Manager

Plataforma de Gestión de Servicios de Ciberseguridad

## Guía de Despliegue y Pruebas

Para poner en marcha el proyecto en otro equipo, sigue estos pasos estrictamente:

### 1. Descargar el código
Clona el repositorio o descomprime el ZIP en `htdocs`:
`git clone <url>`

### 2. Instalar Dependencias (IMPORTANTE)
El proyecto usa librerías externas (como Google2FA) que no se suben al repositorio.
**Ejecuta el archivo incluído `instalar_todo.bat`** haciendo doble clic.
*Esto descargará todas las librerías necesarias automáticamente.*

### 3. Base de Datos
1.  Abrir phpMyAdmin: http://localhost/phpmyadmin
2.  Importar el archivo: `SQL/database.sql` (la base de datos se crea automáticamente).
3.  Si necesitas configurar usuario/contraseña de BD, edita `common/config/main-local.php` (si no existe, copia `common/config/main-local-example.php`).

### 4. Inicializar Entorno (Solo primera vez)
Ejecuta el archivo `init.bat` en la raíz, selecciona opción `0` (Development) y `yes`.

### 5. Probando la Verificación en 2 Pasos (2FA)
El sistema incluye autenticación de doble factor. Para probarla:

1.  Accede al Frontend: `/daw2-2025-26_C_ConsultoriaCiberseguridad/frontend/web`
2.  Loguéate con un usuario (o crea uno nuevo).
3.  Ve a **Configuración** (Menú superior -> Configuración).
4.  Baja a la sección **Seguridad**.
5.  Haz clic en **"Verificación en dos pasos"**.
6.  Escanea el QR con **Google Authenticator** (móvil) e introduce el código numérico.
7.  Al activarse, sal del sistema (`Logout`).
8.  Al volver a entrar, tras poner tu contraseña, te pedirá el código 2FA.

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
