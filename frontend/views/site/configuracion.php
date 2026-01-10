<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Perfil';
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
        <div style="padding: 18px 24px; font-size: 22px; color: #202124;">Perfil</div>
        
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
                <span class="text-muted">CyberSec Manager</span> <span style="color: #5f6368;">gestiona tu perfil</span>
            </div>
        </div>

        <!-- SECCIÓN: INICIO -->
        <div id="section-inicio" class="content-section">
            <h2 class="section-title">Bienvenido, <?= Html::encode($user->nombre) ?></h2>
            
            <!-- Resumen de Cuenta -->
            <div class="settings-card">
                <div class="d-flex align-items-center p-4">
                    <div class="avatar-circle" style="width: 70px; height: 70px; font-size: 30px; margin-right: 24px;">
                        <?= strtoupper(substr($user->nombre ?? 'U', 0, 1)) ?>
                    </div>
                    <div>
                        <h3 style="font-size: 18px; margin: 0 0 4px 0;">CiberSeguridad y Privacidad</h3>
                        <p class="text-muted mb-0">Gestiona tus datos, protege tu privacidad y supervisa tu seguridad.</p>
                    </div>
                </div>
            </div>

            <!-- Tarjetas de Acceso Rápido (Grid) -->
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="settings-card h-100 mb-0 pointer-card" onclick="document.querySelector('[data-target=\'section-info-personal\']').click()" style="cursor: pointer;">
                        <div class="card-content">
                            <i class="fas fa-user-check text-primary mb-3" style="font-size: 24px;"></i>
                            <h4 style="font-size: 16px; font-weight: 500;">Revisar información personal</h4>
                            <p class="text-muted small mb-0">Mantén tus datos actualizados para una mejor gestión.</p>
                        </div>
                        <div class="border-top p-3 text-primary small fw-bold">
                            Gestionar información personal
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="settings-card h-100 mb-0 pointer-card" onclick="document.querySelector('[data-target=\'section-contrasena\']').click()" style="cursor: pointer;">
                        <div class="card-content">
                            <i class="fas fa-shield-alt text-success mb-3" style="font-size: 24px;"></i>
                            <h4 style="font-size: 16px; font-weight: 500;">Seguridad de la cuenta</h4>
                            <p class="text-muted small mb-0">Protege tu cuenta con una contraseña segura.</p>
                        </div>
                        <div class="border-top p-3 text-primary small fw-bold">
                            Gestionar seguridad
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recomendaciones / Consejos -->
             <div class="settings-card mt-4">
                <div class="card-content d-flex align-items-start">
                     <i class="fas fa-lightbulb text-warning me-3 mt-1" style="font-size: 20px;"></i>
                     <div>
                         <h4 style="font-size: 15px; font-weight: 500; margin-bottom: 4px;">Consejo de Seguridad</h4>
                         <p class="text-muted small mb-0">Nunca compartas tu contraseña con nadie. Nuestro equipo nunca te la pedirá por correo o teléfono.</p>
                     </div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: INFORMACIÓN PERSONAL -->
        <div id="section-info-personal" class="content-section" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="section-title mb-0">Información personal</h2>
            </div>
            
            <p class="text-muted mb-4">Gestiona los detalles que mejoran tu experiencia y decide qué información pueden ver los demás.</p>

            <!-- VISTA DE LECTURA -->
            <div id="profile-view-mode" class="settings-card">
                
                <!-- Encabezado con Avatar -->
                <div class="d-flex align-items-center justify-content-between p-4 border-bottom">
                    <div>
                        <div style="font-size: 14px; color: #202124; font-weight: 500;">Perfil básico</div>
                        <div style="font-size: 13px; color: #5f6368;">Alguna información puede ser visible para otras personas.</div>
                    </div>
                    <?php 
                        $inicial = strtoupper(substr($user->nombre ?? 'U', 0, 1));
                    ?>
                    <div class="avatar-circle" style="width: 50px; height: 50px; font-size: 24px; background: #689f38;">
                        <?= $inicial ?>
                    </div>
                </div>

                <!-- Lista de Campos -->
                <div class="d-flex align-items-center p-3 border-bottom settings-row-static">
                    <div class="col-4 text-muted text-uppercase small fw-bold">Nombre</div>
                    <div class="col-8 text-dark"><?= Html::encode(($user->nombre ?? '') . ' ' . ($user->apellidos ?? '')) ?></div>
                </div>

                <div class="d-flex align-items-center p-3 border-bottom settings-row-static">
                    <div class="col-4 text-muted text-uppercase small fw-bold">Empresa</div>
                    <div class="col-8 text-dark"><?= Html::encode($user->empresa ?? '-') ?></div>
                </div>

                <div class="d-flex align-items-center p-3 border-bottom settings-row-static">
                    <div class="col-4 text-muted text-uppercase small fw-bold">Rol</div>
                    <div class="col-8 text-dark"><?= Html::encode($user->rol ?? '-') ?></div>
                </div>

                <!-- Contacto -->
                <div class="d-flex align-items-center justify-content-between p-4 border-bottom bg-light">
                    <div style="font-size: 14px; color: #202124; font-weight: 500;">Información de contacto</div>
                </div>

                <div class="d-flex align-items-center p-3 border-bottom settings-row-static">
                    <div class="col-4 text-muted text-uppercase small fw-bold">Correo electrónico</div>
                    <div class="col-8 text-dark">
                        <?= Html::encode($user->email) ?>
                        <div class="small text-muted">Para cambiarlo contacta con soporte.</div>
                    </div>
                </div>

                <div class="d-flex align-items-center p-3 border-bottom settings-row-static">
                    <div class="col-4 text-muted text-uppercase small fw-bold">Teléfono</div>
                    <div class="col-8 text-dark"><?= Html::encode($user->telefono ?? '-') ?></div>
                </div>

                <div class="d-flex align-items-center p-3 border-bottom settings-row-static">
                    <div class="col-4 text-muted text-uppercase small fw-bold">Dirección</div>
                    <div class="col-8 text-dark"><?= Html::encode($user->direccion ?? '-') ?></div>
                </div>

                <div class="d-flex align-items-center p-3 settings-row-static">
                    <div class="col-4 text-muted text-uppercase small fw-bold">Fecha de registro</div>
                    <div class="col-8 text-dark"><?= Html::encode($user->fecha_registro ?? '-') ?></div>
                </div>
                
                <div class="p-3 text-end bg-light border-top">
                    <button class="btn btn-primary" onclick="toggleEditProfile()">Editar perfil</button>
                </div>
            </div>

            <!-- VISTA DE EDICIÓN (FORMULARIO) -->
            <div id="profile-edit-mode" class="settings-card" style="display: none;">
                <div class="card-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Editar información personal</h4>
                        <button type="button" class="btn-close" onclick="toggleEditProfile()" aria-label="Close"></button>
                    </div>

                    <form action="<?= Url::to(['site/update-profile']) ?>" method="post">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" value="<?= Html::encode($user->nombre) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" value="<?= Html::encode($user->apellidos) ?>" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Rol / Cargo</label>
                                <input type="text" class="form-control" name="rol" value="<?= Html::encode($user->rol ?? '') ?>" placeholder="Ej: Administrador, Mánager...">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Empresa</label>
                                <input type="text" class="form-control" name="empresa" value="<?= Html::encode($user->empresa ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" name="telefono" value="<?= Html::encode($user->telefono ?? '') ?>">
                            </div>
                             <div class="col-md-6">
                                <label class="form-label">Dirección</label>
                                <input type="text" class="form-control" name="direccion" value="<?= Html::encode($user->direccion ?? '') ?>">
                            </div>

                            <div class="col-12">
                                <label class="form-label text-muted">Fecha de registro</label>
                                <input type="text" class="form-control bg-light" value="<?= Html::encode($user->fecha_registro) ?>" readonly disabled>
                            </div>
                        </div>

                        <hr class="my-4">
                        
                        <div class="alert alert-warning">
                            <i class="fas fa-lock me-2"></i> <strong>Seguridad:</strong> Para guardar los cambios, confirma tu identidad.
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirma tu correo electrónico</label>
                            <input type="email" class="form-control" name="auth_email" required placeholder="<?= Html::encode($user->email) ?>">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Contraseña actual</label>
                            <input type="password" class="form-control" name="auth_password" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" onclick="toggleEditProfile()">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
        function toggleEditProfile() {
            var viewMode = document.getElementById('profile-view-mode');
            var editMode = document.getElementById('profile-edit-mode');
            
            if (viewMode.style.display === 'none') {
                viewMode.style.display = 'block';
                editMode.style.display = 'none';
            } else {
                viewMode.style.display = 'none';
                editMode.style.display = 'block';
            }
        }
        </script>

        <!-- SECCIÓN: SEGURIDAD -->
        <div id="section-seguridad" class="content-section" style="display: none;">
            <h2 class="section-title">Seguridad e inicio de sesión</h2>
            
            <!-- Hero Card: Estado de Seguridad -->
            <div class="settings-card mb-4">
                <div class="card-content d-flex align-items-center">
                    <img src="<?= Url::to('@web/images/security_shield.png') ?>" alt="Seguridad" style="width: 48px; height: 48px; margin-right: 20px;">
                    <div>
                        <h3 style="font-size: 16px; margin: 0 0 4px 0;">Tu cuenta está protegida</h3>
                        <p class="text-muted small mb-0">La Revisión de Seguridad ha comprobado tu cuenta y no ha encontrado ninguna acción recomendada.</p>
                    </div>
                </div>
            </div>

            <!-- Actividad Reciente -->
            <div class="mb-4">
                <h4 style="font-size: 14px; color: #202124; font-weight: 500; margin-bottom: 8px;">Actividad relacionada con la seguridad reciente</h4>
                <p class="text-muted small">No ha habido ninguna alerta ni actividad relacionadas con la seguridad en los últimos 28 días.</p>
            </div>

            <!-- Cómo inicias sesión -->
            <div class="settings-card">
                 <div class="p-3 border-bottom">
                    <h3 style="font-size: 16px; margin: 0 0 4px 0;">Cómo inicias sesión en CyberSec Manager</h3>
                    <p class="text-muted small mb-0">Asegúrate de poder acceder siempre a tu cuenta manteniendo al día esta información</p>
                </div>

                <!-- Contraseña (Funcional - Link) -->
                <div class="settings-row" onclick="document.querySelector('[data-target=\'section-contrasena\']').click()">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-asterisk text-muted fs-5 me-3" style="width: 24px; text-align: center;"></i>
                        <div>
                            <div class="row-label fw-bold">Contraseña</div>
                            <div class="small text-muted">Última modificación: Desconocido</div>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right row-icon"></i>
                </div>



                 <!-- Correo Recuperación -->
                 <div class="settings-row border-top mt-2" onclick="toggleRecoveryForm()" style="cursor: pointer;">
                    <div class="d-flex align-items-center">
                        <i class="far fa-envelope text-muted fs-5 me-3" style="width: 24px; text-align: center;"></i>
                        <div>
                            <div class="row-label fw-bold">Correo de recuperación</div>
                            <?php if (!empty($user->email_recuperacion)): ?>
                                <div class="small text-muted"><?= Html::encode($user->email_recuperacion) ?></div>
                            <?php else: ?>
                                <div class="small text-warning bg-warning bg-opacity-10 px-2 py-0 rounded d-inline-block mt-1">
                                    <i class="fas fa-exclamation-circle small me-1"></i> Añadir una dirección de correo electrónico
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right row-icon"></i>
                </div>

                <!-- Formulario Correo Recuperación (Oculto) -->
                <div id="recovery-email-form" class="p-4 bg-light border-top" style="display: none;">
                    <form action="<?= Url::to(['site/update-recovery-email']) ?>" method="post">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                        
                        <p class="small text-muted mb-3">
                            Este correo se utilizará para contactar contigo si detectamos actividad inusual en tu cuenta o si pierdes el acceso.
                        </p>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Correo de recuperación</label>
                            <input type="email" class="form-control" name="email_recuperacion" value="<?= Html::encode($user->email_recuperacion) ?>" placeholder="ejemplo@gmail.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Para continuar, verifica tu contraseña actual</label>
                            <input type="password" class="form-control" name="password_confirm" required>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-sm btn-secondary me-2" onclick="toggleRecoveryForm()">Cancelar</button>
                            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>

                <script>
                function toggleRecoveryForm() {
                    var form = document.getElementById('recovery-email-form');
                    if (form.style.display === 'none') {
                        form.style.display = 'block';
                    } else {
                        form.style.display = 'none';
                    }
                }
                </script>

                 <!-- 2FA ROW -->
                 <div class="settings-row border-top" onclick="toggle2FA()" style="cursor: pointer;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-mobile-alt text-muted fs-5 me-3" style="width: 24px; text-align: center;"></i>
                        <div>
                            <div class="row-label fw-bold">Verificación en dos pasos</div>
                            <div class="small text-muted">
                                <?= $user->totp_activo ? '<span class="text-success fw-bold">Activado <i class="fas fa-check-circle"></i></span>' : 'Desactivado' ?>
                            </div>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right row-icon"></i>
                </div>

                <!-- 2FA SETUP / DISABLE AREA -->
                <div id="2fa-container" class="p-4 bg-light border-top" style="display: none;">
                    
                    <?php if ($user->totp_activo): ?>
                        <!-- ESTADO: ACTIVADO -->
                        <h5 class="text-danger mb-3">Desactivar verificación en dos pasos</h5>
                        <p class="small text-muted mb-3">Si desactivas esta función, tu cuenta estará menos protegida.</p>
                        
                        <form action="<?= Url::to(['site/disable-totp']) ?>" method="post">
                             <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                             <div class="mb-3">
                                <label class="form-label small fw-bold">Confirma tu contraseña</label>
                                <input type="password" class="form-control" name="current_password" required style="max-width: 300px;">
                             </div>
                             <div class="text-end">
                                <button type="button" class="btn btn-sm btn-secondary me-2" onclick="toggle2FA()">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-danger">Desactivar 2FA</button>
                             </div>
                        </form>

                    <?php else: ?>
                        <!-- ESTADO: DESACTIVADO (SETUP) -->
                        <h5 class="text-primary mb-3">Configurar verificación en dos pasos</h5>
                        <div class="row">
                            <div class="col-md-8">
                                <ol class="small text-muted ps-3 mb-4">
                                    <li class="mb-2">Descarga una app de autenticación como <strong>Google Authenticator</strong> o <strong>Microsoft Authenticator</strong> en tu móvil.</li>
                                    <li class="mb-2">Escanea el código QR que aparece a la derecha.</li>
                                    <li class="mb-2">Introduce el código de 6 dígitos que genera la app para confirmar.</li>
                                </ol>

                                <form action="<?= Url::to(['site/enable-totp']) ?>" method="post">
                                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                                    <!-- Enviamos el secreto generado para guardarlo definitivamente -->
                                    <input type="hidden" name="totp_secret" value="<?= $secret ?>">

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Código de verificación</label>
                                        <input type="text" class="form-control form-control-lg" name="totp_code" placeholder="123456" required 
                                               style="max-width: 200px; letter-spacing: 4px; text-align: center;" autocomplete="off">
                                    </div>
                                    
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-secondary me-3" onclick="toggle2FA()">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Activar</button>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="col-md-4 text-center">
                                <div class="bg-white p-3 d-inline-block rounded shadow-sm border mb-2">
                                    <!-- Contenedor QR -->
                                    <div id="qrcode"></div>
                                </div>
                                <div class="small text-muted mt-2">
                                    ¿No puedes escanearlo? <br>
                                    <button class="btn btn-link btn-sm p-0 text-decoration-none" type="button" 
                                            onclick="alert('Tu clave secreta es: <?= $secret ?>')">Ver clave secreta</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Librería QR Code JS -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
                        <script>
                            function generateQR() {
                                var container = document.getElementById("qrcode");
                                // Limpiar por si acaso ya había uno
                                container.innerHTML = "";
                                if (container) {
                                    new QRCode(container, {
                                        text: "<?= $qrCodeUrl ?>",
                                        width: 128,
                                        height: 128,
                                        correctLevel : QRCode.CorrectLevel.M
                                    });
                                }
                            }
                            
                            // Intentar generar si la sección ya es visible o al cargar
                            document.addEventListener('DOMContentLoaded', function() {
                                // Pequeño timeout para asegurar que la librería cargó
                                setTimeout(function() {
                                    var container = document.getElementById('2fa-container');
                                    if (container && container.style.display !== 'none') {
                                        generateQR();
                                    }
                                }, 500);
                            });
                        </script>
                    <?php endif; ?>
                </div>

                <script>
                function toggle2FA() {
                    var container = document.getElementById('2fa-container');
                    if (container.style.display === 'none') {
                        container.style.display = 'block';
                        if (typeof generateQR === 'function') {
                            generateQR();
                        }
                    } else {
                        container.style.display = 'none';
                    }
                }
                </script>

            </div>
        </div>

        <!-- SECCIÓN: CONTRASEÑA -->
        <div id="section-contrasena" class="content-section" style="display: none;">
            <h2 class="section-title">Contraseña</h2>
            <div class="settings-card">
                <div class="card-content">
                    <p class="mb-4">Gestiona tu contraseña para proteger tu cuenta.</p>
                    
                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= Yii::$app->session->getFlash('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (Yii::$app->session->hasFlash('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= Yii::$app->session->getFlash('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= Url::to(['site/change-password']) ?>" method="post">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                        
                        <div class="mb-3">
                            <label for="email" class="form-label" style="font-size: 14px; font-weight: 500;">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="Confirma tu correo actual">
                        </div>
                        
                        <div class="mb-3">
                            <label for="current_password" class="form-label" style="font-size: 14px; font-weight: 500;">Contraseña actual</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="new_password" class="form-label" style="font-size: 14px; font-weight: 500;">Nueva contraseña</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required minlength="6">
                            <div class="form-text">La contraseña debe tener al menos 6 caracteres.</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                    </form>
                </div>
            </div>
        </div>



        <!-- SECCIÓN: PAGOS Y SUSCRIPCIONES (Renombrado a Mis Solicitudes) -->
        <div id="section-pagos" class="content-section" style="display: none;">
            <h2 class="section-title">Mis Solicitudes y Presupuestos</h2>
            
            <?php 
                // Consulta directa a SolicitudesPresupuesto (idealmente debería pasar por Controller)
                $misSolicitudes = \common\models\SolicitudesPresupuesto::find()
                    ->where(['email_contacto' => $user->email])
                    ->orderBy(['fecha_solicitud' => SORT_DESC])
                    ->all();
            ?>

            <?php if (empty($misSolicitudes)): ?>
                <div class="settings-card text-center p-5">
                    <img src="https://img.icons8.com/fluency/96/purchase-order.png" alt="Sin solicitudes" class="mb-3" style="opacity: 0.6;">
                    <h4 class="mb-2">Aún no tienes solicitudes</h4>
                    <p class="text-muted mb-4">Aquí aparecerán los servicios que contrates con nosotros y sus facturas.</p>
                    <a href="<?= Url::to(['site/catalogo']) ?>" class="btn btn-primary">Ver Catálogo de Servicios</a>
                </div>
            <?php else: ?>
                <!-- Resumen -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="settings-card p-3 d-flex align-items-center mb-0">
                            <div class="avatar-circle bg-primary bg-opacity-10 text-primary me-3" style="width: 48px; height: 48px; font-size: 20px;">
                                <i class="fas fa-file-contract"></i>
                            </div>
                            <div>
                                <h3 class="h5 mb-0"><?= count($misSolicitudes) ?></h3>
                                <small class="text-muted">Total Solicitudes</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="settings-card overflow-hidden">
                    <div class="p-4 border-bottom bg-light">
                        <h5 class="mb-0 fs-6 fw-bold text-uppercase text-muted">Historial de Servicios</h5>
                    </div>
                    
                    <?php foreach ($misSolicitudes as $solicitud): ?>
                        <div class="settings-row border-bottom p-3 d-block h-auto">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex">
                                    <div class="me-3 mt-1">
                                        <?php if ($solicitud->isEstadoSolicitudPendiente()): ?>
                                            <span class="badge bg-warning text-dark"><i class="far fa-clock"></i></span>
                                        <?php elseif ($solicitud->isEstadoSolicitudContratado()): ?>
                                            <span class="badge bg-success"><i class="fas fa-check"></i></span>
                                        <?php elseif ($solicitud->isEstadoSolicitudRechazado() || $solicitud->isEstadoSolicitudCancelado()): ?>
                                            <span class="badge bg-secondary"><i class="fas fa-ban"></i></span>
                                        <?php else: ?>
                                            <span class="badge bg-info"><i class="fas fa-sync"></i></span>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark mb-1">
                                            <?= Html::encode($solicitud->servicio ? $solicitud->servicio->nombre : 'Consulta General') ?>
                                        </div>
                                        <div class="small text-muted mb-2">
                                            <i class="far fa-calendar-alt me-1"></i> <?= Yii::$app->formatter->asDate($solicitud->fecha_solicitud, 'long') ?>
                                            &bull; ID: #<?= str_pad($solicitud->id, 5, '0', STR_PAD_LEFT) ?>
                                        </div>
                                        <p class="small text-secondary mb-0 fst-italic">
                                            "<?= \yii\helpers\StringHelper::truncate(Html::encode($solicitud->descripcion_necesidad), 80) ?>"
                                        </p>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge rounded-pill border border-light shadow-sm 
                                        <?= $solicitud->isEstadoSolicitudPendiente() ? 'bg-warning text-dark' : 
                                           ($solicitud->isEstadoSolicitudContratado() ? 'bg-success' : 'bg-secondary') ?>">
                                        <?= Html::encode($solicitud->estado_solicitud) ?>
                                    </span>
                                    
                                    <?php if ($solicitud->usuarioAsignado): ?>
                                        <div class="small text-muted mt-2" title="Agente asignado">
                                            <i class="fas fa-user-tie"></i> <?= Html::encode($solicitud->usuarioAsignado->nombre) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Acciones (Mockup) -->
                            <?php if ($solicitud->isEstadoSolicitudPresupuestoEnviado() || $solicitud->isEstadoSolicitudContratado()): ?>
                                <div class="mt-3 pt-3 border-top d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-file-pdf me-1"></i> Ver Presupuesto</button>
                                    <?php if ($solicitud->isEstadoSolicitudContratado()): ?>
                                        <button class="btn btn-sm btn-outline-success"><i class="fas fa-file-invoice-dollar me-1"></i> Facturas</button>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Bloque Suscripciones (Estático/Promo) -->
                <div class="settings-card mt-4 bg-primary bg-opacity-10 border-0">
                    <div class="card-content d-flex align-items-center">
                         <div class="text-primary fs-1 me-3"><i class="fas fa-headset"></i></div>
                         <div>
                             <h4 class="h6 fw-bold text-primary mb-1">¿No sabes qué servicios contratar?</h4>
                             <p class="small text-muted mb-0">Ponte en contacto con nuestros expertos para obtener ayuda y asesoramiento personalizado.</p>
                         </div>
                         <div class="ms-auto">
                             <a href="<?= Url::to(['site/contact']) ?>" class="btn btn-sm btn-primary">Contactar</a>
                         </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.settings-menu-item');
    const sections = document.querySelectorAll('.content-section');
    const searchInput = document.querySelector('.search-bar input');
    
    // Guardar la pestaña activa actual para restaurarla al limpiar la búsqueda
    let activeTabId = 'section-inicio'; // Por defecto

    // Función auxiliar para normalizar texto (quitar acentos y minúsculas)
    function normalizeText(text) {
        return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    }

    // Lógica de menús (Pestañas)
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Si hay búsqueda activa, limpiarla al cambiar de pestaña manualmente (? opcional, por ahora mantenemos comportamiento estándar)
            // searchInput.value = ''; 

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
                // Restaurar visibilidad de elementos internos por si estaban ocultos por búsqueda
                // Excluyendo explícitamente los paneles de vista/edición de perfil que tienen su propia lógica de display
                const hiddenElements = targetSection.querySelectorAll('[style*="display: none"]');
                hiddenElements.forEach(el => {
                    if (el.id !== 'profile-edit-mode' && el.id !== 'profile-view-mode' && el.id !== 'recovery-email-form' && el.id !== '2fa-container') {
                        el.style.display = '';
                    }
                });
            }
            
            activeTabId = targetId;
        });
    });

    // Lógica de Búsqueda
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = normalizeText(this.value.trim());

            if (searchTerm.length > 0) {
                // MODO BÚSQUEDA: Mostrar todas las secciones para buscar dentro de ellas
                sections.forEach(section => {
                    section.style.display = 'block';
                    
                    let hasVisibleItems = false;
                    
                    // Buscar en títulos de sección
                    const sectionTitle = section.querySelector('.section-title');
                    let sectionMatch = false;
                    if (sectionTitle && normalizeText(sectionTitle.textContent).includes(searchTerm)) {
                        sectionMatch = true; 
                        hasVisibleItems = true;
                    }

                    // Buscar en filas de configuración (.settings-row) y tarjetas (.settings-card p, .profile-info etc)
                    // Estrategia: Buscar en los contenedores de "contenido" más granulares
                    const searchableItems = section.querySelectorAll('.settings-row, .card-content p, .profile-info div');
                    
                    searchableItems.forEach(item => {
                        // Si el título de la sección coincide, mostramos todo el contenido de la sección
                        if (sectionMatch) {
                             if (item.closest('.settings-row')) item.closest('.settings-row').style.display = '';
                             // Los p dentro de card-content no suelen ocultarse individualmente, pero por si acaso
                             return;
                        }

                        // Si no coincide la sección entera, filtramos elementos
                        const text = normalizeText(item.textContent);
                        const parentRow = item.closest('.settings-row');
                        
                        if (text.includes(searchTerm)) {
                            hasVisibleItems = true;
                            if (parentRow) parentRow.style.display = '';
                            item.style.display = ''; 
                            // Asegurar que el padre (card) sea visible
                            item.closest('.settings-card').style.display = '';
                        } else {
                            // Si es una fila de configuración, la ocultamos
                            if (parentRow) {
                                parentRow.style.display = 'none';
                            } 
                            // Para texto dentro de tarjetas, es más complejo ocultar solo el párrafo sin romper diseño,
                            // por ahora si NO hay match en toda la tarjeta, ocultamos la tarjeta entera abajo.
                        }
                    });

                    // Si después de filtrar items no hay nada visible y el título no coincidió, ocultamos la sección entera
                    // Pero necesitamos verificar si quedaron rows visibles o si la tarjeta tiene algo visible
                    
                    // Re-verificación simple de visibilidad
                    const visibleRows = Array.from(section.querySelectorAll('.settings-row')).filter(r => r.style.display !== 'none');
                    // Asumimos que si hay texto en cards (p) que coincida, la card se queda. 
                    // Simplificación: si el texto global de la sección contiene el término, mostramos la sección, 
                    // pero intentamos ocultar las rows que no coinciden.
                    
                    if (!section.textContent || !normalizeText(section.textContent).includes(searchTerm)) {
                        section.style.display = 'none';
                    } else {
                        // La sección tiene algo, asegurarnos de que se vea
                        section.style.display = 'block';
                    }
                });

            } else {
                // MODO NORMAL: Restaurar vista de pestañas
                sections.forEach(s => {
                    // Ocultar todas
                    s.style.display = 'none';
                    // Limpiar estilos inline de display en hijos (restaurar visibilidad)
                    const children = s.querySelectorAll('*');
                    children.forEach(c => c.style.display = '');
                });

                // Mostrar solo la activa
                const activeSection = document.getElementById(activeTabId);
                if (activeSection) activeSection.style.display = 'block';
            }
        });
    }
});
</script>
