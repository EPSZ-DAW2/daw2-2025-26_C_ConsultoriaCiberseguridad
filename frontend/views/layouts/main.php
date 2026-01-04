<?php
/** @var \yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

// --- LÓGICA PARA OBTENER NOMBRE Y ROL ---
$nombreUsuario = 'Invitado';
$rolUsuario = '';

if (!Yii::$app->user->isGuest) {
    $nombreUsuario = Yii::$app->user->identity->nombre; 
    
    $rolUsuario = ucfirst(Yii::$app->user->identity->rol ?? 'Usuario'); 
}
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link href="<?= Yii::getAlias('@web') ?>/template/css/styles.css" rel="stylesheet">

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">

    <?php $this->head() ?>
</head>

<body class="sb-nav-fixed">
<?php $this->beginBody() ?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="<?= Yii::$app->homeUrl ?>">CyberSec Manager</a>

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" type="button">
        <i class="fas fa-bars"></i>
    </button>

    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <li><div class="dropdown-header">Hola, <?= Html::encode($nombreUsuario) ?></div></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <?= Html::a('Cerrar Sesión', ['/site/logout'], [
                            'class' => 'dropdown-item',
                            'data-method' => 'post', // Importante para Yii2
                        ]) ?>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= Url::to(['/site/configuracion']) ?>">Configuración</a>
                    </li>
                <?php else: ?>
                    <li><a class="dropdown-item" href="<?= Url::to(['/site/login']) ?>">Iniciar Sesión</a></li>
                    <li><a class="dropdown-item" href="<?= Url::to(['/site/signup']) ?>">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </li>
    </ul>
</nav>


<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <?php if (!Yii::$app->user->isGuest): ?>
                    <div class="sb-sidenav-menu-heading">Privado</div>
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/dashboard']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <?php endif; ?>

                    <div class="sb-sidenav-menu-heading">Público</div>
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                        Inicio
                    </a>
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/catalogo']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                        Catálogo
                    </a>
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/contact']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                        Contacto
                    </a>
                </div>
            </div>

            <div class="sb-sidenav-footer">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <div class="small">Logged in as:</div>
                    <?= Html::encode(Yii::$app->user->identity->username) ?>
                <?php endif; ?>
            </div>
        </nav>
    </div>

    <div id="layoutSidenav_content">
        <main class="p-4">
            <?= \common\widgets\Alert::widget() ?>
            <?= $content ?>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">&copy; CyberSec Manager <?= date('Y') ?></div>
                    <div>
                        <a href="<?= \yii\helpers\Url::to(['/site/politica-privacidad']) ?>">Política de Privacidad</a> &middot;
                        <a href="<?= \yii\helpers\Url::to(['/site/terminos']) ?>">Términos y Condiciones</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<div id="cookie-banner" class="cookie-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div class="cookie-content bg-light p-4 rounded shadow-lg" style="max-width: 800px; width: 90%; margin: 20px;">
        <h3 class="fw-bold mb-3">Aceptación de Cookies</h3>
        <p class="mb-4">
            ¡Hola! En nuestra web usamos cookies propias y de terceros, incluidos los servicios de terceros proveedores, 
            para analizar el uso que haces de ella y mostrarte anuncios personalizados según tu perfil de navegación.
            <br><br>
            Puedes aceptarlas para seguir navegando, rechazarlas, o bien consultarlas para conocerlas en detalle en nuestra Política de Cookies.
        </p>
        
        <div class="d-flex flex-column flex-md-row gap-3 justify-content-between">
            <button id="reject-cookies" class="btn btn-danger flex-grow-1" style="background-color: #d32f2f; border-color: #d32f2f;">Rechazar todas las cookies</button>
            <button id="config-cookies" class="btn btn-warning text-white flex-grow-1" style="background-color: #7cb342; border-color: #7cb342;">Configuración de cookies</button>
            <button id="accept-cookies" class="btn btn-primary flex-grow-1" style="background-color: #0d47a1; border-color: #0d47a1;">Aceptar todas las cookies</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mostrar si no hay decisión guardada
        if (!localStorage.getItem("cookieConsent")) {
            document.getElementById("cookie-banner").style.display = "flex";
        }

        // Aceptar todas
        document.getElementById("accept-cookies").addEventListener("click", function() {
            localStorage.setItem("cookieConsent", "accepted");
            document.getElementById("cookie-banner").style.display = "none";
        });

        // Rechazar todas
        document.getElementById("reject-cookies").addEventListener("click", function() {
            localStorage.setItem("cookieConsent", "rejected");
            document.getElementById("cookie-banner").style.display = "none";
        });

        // Configurar (por ahora solo cierra, en futuro abriría panel)
        document.getElementById("config-cookies").addEventListener("click", function() {
            alert("Aquí se abriría el panel de configuración de cookies.");
        });
    });
</script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->

<script src="<?= Yii::getAlias('@web') ?>/template/js/scripts.js"></script>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= Yii::getAlias('@web') ?>/template/js/datatables-simple-demo.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>