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

    $rolUsuario = ucfirst(Yii::$app->user->identity->getRoleName() ?? 'Usuario');
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
                        <a class="dropdown-item" href="<?= Url::to(['/site/configuracion']) ?>">Perfil</a>
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
                    <div class="sb-sidenav-menu-heading">Área Privada</div>

                    <!-- Dashboard Empresa (solo cliente_admin) -->
                    <?php 
                    $user = Yii::$app->user->identity;
                    $canManageCompany = Yii::$app->user->can('gestionarEmpresa') || 
                                        $user->rol === 'cliente_admin' || 
                                        $user->rol === 'admin';
                    
                    if ($canManageCompany): 
                    ?>
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/dashboard']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard Empresa
                    </a>
                    <!-- Mis Empleados (solo cliente_admin) -->
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/usuarios']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Mis Empleados
                    </a>
                    <?php endif; ?>

                    <!-- Mis Proyectos (Visible para todos los autenticados) -->
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/proyectos/index']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                        Mis Proyectos
                    </a>

                    <!-- Reportar Incidencia (Requiere SOC/Defensa) -->
                    <?php if (Yii::$app->user->identity->hasContratoActivo(\common\models\Servicios::CATEGORIA_DEFENSA)): ?>
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/incidencias/index']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-exclamation-triangle"></i></div>
                        Mis Incidencias
                    </a>
                    <?php endif; ?>

                    <!-- Calendario (Visible para todos los usuarios autenticados) -->
                    <?php if (!Yii::$app->user->isGuest): ?>
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/calendario/index']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                        Calendario
                    </a>
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/documentos/index']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                        Gestor Documental
                    </a>
                    <?php endif; ?>

                    <!-- Campus Virtual (Requiere Formación) -->
                    <?php if (Yii::$app->user->identity->hasContratoActivo(\common\models\Servicios::CATEGORIA_FORMACION)): ?>
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/cursos/index']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                        Campus Virtual
                    </a>
                    <?php endif; ?>

                    <?php endif; ?>

                    <div class="sb-sidenav-menu-heading">Público</div>
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                        Inicio
                    </a>
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/catalogo']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                        Catálogo Servicios
                    </a>
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/contact']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                        Contacto
                    </a>
                </div>
            </div>

            <div class="sb-sidenav-footer">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <div class="small">Conectado como:</div>
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

<?= $this->renderFile(Yii::getAlias('@frontend/views/site/_cookies_modal.php')) ?>



<script src="<?= Yii::getAlias('@web') ?>/template/js/scripts.js"></script>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= Yii::getAlias('@web') ?>/template/js/datatables-simple-demo.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>