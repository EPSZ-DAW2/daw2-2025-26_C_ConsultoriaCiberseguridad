<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Configuración';
$user = Yii::$app->user->identity;

// Registrar CSS específico para esta página
$this->registerCss("
    body {
        background-color: #f1f3f4; /* Fondo gris claro tipo Chrome */
    }
    .chrome-settings-layout {
        display: flex;
        min-height: calc(100vh - 56px); /* Restar altura navbar */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #202124;
    }
    /* Sidebar */
    .settings-sidebar {
        width: 250px;
        flex-shrink: 0;
        padding-top: 8px;
        /* background: white;  Opcional si se quiere barra lateral blanca */
    }
    .settings-menu-item {
        display: flex;
        align-items: center;
        padding: 0 24px;
        height: 48px;
        text-decoration: none;
        color: #5f6368;
        font-size: 14px;
        font-weight: 500;
        border-radius: 0 24px 24px 0;
        margin-right: 8px;
    }
    .settings-menu-item:hover {
        background-color: #e8eaed;
        color: #202124;
    }
    .settings-menu-item.active {
        color: #1a73e8;
        background-color: #e8f0fe;
    }
    .settings-menu-item i {
        margin-right: 20px;
        width: 20px;
        text-align: center;
        font-size: 18px;
    }

    /* Main Content */
    .settings-main {
        flex-grow: 1;
        max-width: 960px; /* Ancho máximo típico de configuración */
        margin: 0 auto;
        padding: 0 20px;
    }
    .settings-header {
        position: sticky;
        top: 0;
        background: #f1f3f4;
        z-index: 10;
        padding: 10px 0 20px 0;
    }
    .search-bar {
        background: white;
        border: 1px solid transparent;
        border-radius: 24px;
        box-shadow: 0 1px 3px 0 rgba(60,64,67,.3), 0 4px 8px 3px rgba(60,64,67,.15);
        height: 48px;
        display: flex;
        align-items: center;
        padding: 0 12px;
        width: 100%;
        max-width: 680px;
        margin: 0 auto; /* Centrado */
        transition: background-color .1s cubic-bezier(0.4,0.0,0.2,1),box-shadow 200ms cubic-bezier(0.4,0.0,0.2,1);
    }
    .search-bar:focus-within {
        background: white;
        box-shadow: 0 1px 1px 0 rgba(65,69,73,.3), 0 1px 3px 1px rgba(65,69,73,.15); 
        /* Simplificado, Chrome real es sutil */
    }
    .search-bar i {
        color: #5f6368;
        margin: 0 12px;
    }
    .search-bar input {
        border: none;
        flex-grow: 1;
        height: 100%;
        outline: none;
        font-size: 15px;
        color: #202124;
    }

    /* Cards */
    .settings-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 2px 0 rgba(60,64,67,.3), 0 1px 3px 1px rgba(60,64,67,.15);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .card-content {
        padding: 16px 20px;
    }
    
    /* Profile Section specifics */
    .profile-hero {
        display: flex;
        align-items: center;
        padding: 20px;
    }
    .avatar-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #689f38; /* Verde como en la foto */
        color: white;
        font-size: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        text-transform: uppercase;
    }
    .profile-info {
        flex-grow: 1;
    }
    .profile-name {
        font-size: 16px;
        font-weight: 500;
        color: #202124;
    }
    .profile-email-context {
        font-size: 13px;
        color: #5f6368;
        margin-top: 4px;
    }
    .btn-sync {
        background-color: #1a73e8;
        color: white;
        border: none;
        padding: 8px 24px;
        border-radius: 18px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-sync:hover {
        background-color: #1557b0;
        color: white;
        box-shadow: 0 1px 2px 0 rgba(66,133,244,.3), 0 1px 3px 1px rgba(66,133,244,.15);
    }

    /* List Rows */
    .settings-row {
        display: flex;
        align-items: center; /* Centrar verticalmente */
        justify-content: space-between;
        padding: 14px 20px; /* Ajuste para parecerse a la lista */
        border-top: 1px solid #e8eaed;
        color: #202124;
        text-decoration: none;
        cursor: pointer;
        min-height: 48px;
    }
    .settings-row:first-child {
        border-top: none;
    }
    .settings-row:hover {
        background-color: #f8f9fa;
    }
    .row-label {
        font-size: 14px; /* Tamaño de fuente similar a Chrome */
        color: #202124; /* Color de texto principal */
    }
    .row-icon {
        color: #5f6368;
        font-size: 14px; /* Flecha pequeña */
    }

    /* Section Titles */
    .section-title {
        font-size: 15px; /* Un poco más pequeño que h2 normal */
        font-weight: 500;
        color: #5f6368;
        margin: 20px 0 12px 0; /* Espaciado */
    }

    /* Responsive */
    @media (max-width: 768px) {
        .settings-sidebar {
            display: none; /* Hide sidebar on small screens for now */
        }
    }
");

?>

<div class="chrome-settings-layout">
    <!-- Sidebar -->
    <div class="settings-sidebar d-none d-md-block">
        <div style="padding: 18px 24px; font-size: 22px; color: #202124;">Configuración</div>
        
        <a href="#" class="settings-menu-item active" data-target="section-inicio">
            <i class="fas fa-home"></i> Inicio
        </a>
        <a href="#" class="settings-menu-item" data-target="section-info-personal">
            <i class="fas fa-user-check"></i> Información personal
        </a>
        <a href="#" class="settings-menu-item" data-target="section-seguridad">
            <i class="fas fa-shield-alt"></i> Seguridad e inicio de sesión
        </a>
        <a href="#" class="settings-menu-item" data-target="section-contrasena">
            <i class="fas fa-key"></i> Contraseña
        </a>
        <a href="#" class="settings-menu-item" data-target="section-conexiones">
            <i class="fas fa-plug"></i> Conexiones de terceros
        </a>
        <a href="#" class="settings-menu-item" data-target="section-datos">
            <i class="fas fa-user-secret"></i> Datos y privacidad
        </a>
        <a href="#" class="settings-menu-item" data-target="section-contactos">
            <i class="fas fa-users"></i> Contactos y compartir
        </a>
        <a href="#" class="settings-menu-item" data-target="section-pagos">
            <i class="fas fa-credit-card"></i> Pagos y suscripciones
        </a>
    </div>

    <!-- Main Content -->
    <div class="settings-main">
        <div class="settings-header">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Buscar ajustes" aria-label="Buscar ajustes">
            </div>
            
            <div class="text-end mt-2" style="font-size: 13px;">
                <span class="text-muted">usal.es</span> <a href="#" style="text-decoration: none; color: #1a73e8;">gestiona tu perfil</a>
            </div>
        </div>

        <!-- SECCIÓN: INICIO -->
        <div id="section-inicio" class="content-section">
            <h2 class="section-title">Tu perfil</h2>
            
            <div class="settings-card">
                <div class="profile-hero">
                    <?php 
                        $inicial = strtoupper(substr($user->nombre ?? 'U', 0, 1));
                    ?>
                    <div class="avatar-circle"><?= $inicial ?></div>
                    
                    <div class="profile-info">
                        <div style="font-size: 15px; color: #202124;">
                            Obtén funciones inteligentes en Chrome
                        </div>
                        <div style="font-size: 13px; color: #5f6368; margin-bottom: 12px;">
                            Sincroniza y personaliza Chrome en todos tus dispositivos
                        </div>
                        
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div>
                                <div class="profile-name"><?= Html::encode(($user->nombre ?? '') . ' ' . ($user->apellidos ?? '')) ?></div>
                                <div class="profile-email-context">Has iniciado sesión con <?= Html::encode($user->email ?? 'usuario@ejemplo.com') ?></div>
                            </div>
                            <button class="btn-sync mt-2 mt-sm-0">Activar sincronización</button>
                        </div>
                    </div>
                </div>

                <a href="#" class="settings-row">
                    <div class="row-label">Sincronización y servicios de Google</div>
                    <i class="fas fa-chevron-right row-icon"></i>
                </a>
                <a href="#" class="settings-row">
                    <div class="row-label">Gestionar tu cuenta de Google</div>
                    <i class="fas fa-external-link-alt row-icon"></i>
                </a>
            </div>
        </div>

        <!-- SECCIÓN: INFORMACIÓN PERSONAL -->
        <div id="section-info-personal" class="content-section" style="display: none;">
            <h2 class="section-title">Información personal</h2>
            <div class="settings-card">
                <div class="card-content">
                    <p>Aquí podrás editar tu nombre, foto de perfil y fecha de nacimiento.</p>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: SEGURIDAD -->
        <div id="section-seguridad" class="content-section" style="display: none;">
            <h2 class="section-title">Seguridad e inicio de sesión</h2>
            <div class="settings-card">
                <div class="card-content">
                    <p>Revisa la actividad reciente y activa la verificación en dos pasos.</p>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: CONTRASEÑA -->
        <div id="section-contrasena" class="content-section" style="display: none;">
            <h2 class="section-title">Contraseña</h2>
            <div class="settings-card">
                <div class="card-content">
                    <p>Cambia tu contraseña y gestiona tus claves guardadas.</p>
                    <a href="<?= Url::to(['/site/request-password-reset']) ?>" class="btn btn-primary btn-sm mt-2">Cambiar contraseña</a>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: CONEXIONES -->
        <div id="section-conexiones" class="content-section" style="display: none;">
            <h2 class="section-title">Conexiones de terceros</h2>
            <div class="settings-card">
                <div class="card-content">
                    <p>Gestiona las aplicaciones y sitios que tienen acceso a tu cuenta.</p>
                </div>
            </div>
        </div>

         <!-- SECCIÓN: DATOS -->
         <div id="section-datos" class="content-section" style="display: none;">
            <h2 class="section-title">Datos y privacidad</h2>
            <div class="settings-card">
                <div class="card-content">
                    <p>Controla lo que guardamos para mejorar tu experiencia.</p>
                </div>
            </div>
        </div>

         <!-- SECCIÓN: CONTACTOS -->
         <div id="section-contactos" class="content-section" style="display: none;">
            <h2 class="section-title">Contactos y compartir</h2>
            <div class="settings-card">
                <div class="card-content">
                    <p>Organiza tus contactos y elige qué información ven los demás.</p>
                </div>
            </div>
        </div>

         <!-- SECCIÓN: PAGOS -->
         <div id="section-pagos" class="content-section" style="display: none;">
            <h2 class="section-title">Pagos y suscripciones</h2>
            <div class="settings-card">
                <div class="card-content">
                    <p>Gestiona tus métodos de pago y suscripciones activas.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.settings-menu-item');
    const sections = document.querySelectorAll('.content-section');

    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // 1. Quitar activo de todos
            menuItems.forEach(i => i.classList.remove('active'));
            // 2. Poner activo al actual
            this.classList.add('active');

            // 3. Ocultar todas las secciones
            sections.forEach(s => s.style.display = 'none');

            // 4. Mostrar la sección target
            const targetId = this.getAttribute('data-target');
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.style.display = 'block';
            }
        });
    });
});
</script>
