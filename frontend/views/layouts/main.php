<<?php
/** @var \yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- SB Admin styles -->
    <link href="<?= Yii::getAlias('@web') ?>/template/css/styles.css" rel="stylesheet">

    <!-- Font Awesome (para los iconos del menú) -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- (Opcional) Simple Datatables CSS si lo usas -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">

    <?php $this->head() ?>
</head>

<body class="sb-nav-fixed">
<?php $this->beginBody() ?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand -->
    <a class="navbar-brand ps-3" href="<?= Yii::$app->homeUrl ?>">CyberSec Manager</a>

    <!-- Sidebar Toggle -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" type="button">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search (si no lo quieres, bórralo) -->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for...">
            <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>

    <!-- Navbar user -->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#!">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>

                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

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
                <div class="small">Logged in as:</div>
                <?= Yii::$app->user->isGuest ? 'Invitado' : Html::encode(Yii::$app->user->identity->username) ?>
            </div>
        </nav>
    </div>

    <div id="layoutSidenav_content">
        <main class="p-4">
            <?= $content ?>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">&copy; CyberSec Manager <?= date('Y') ?></div>
                    <div>
                        <a href="#">Privacy Policy</a> &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- JS (orden importante) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<!-- scripts.js de SB Admin (ojo a la ruta /template/) -->
<script src="<?= Yii::getAlias('@web') ?>/template/js/scripts.js"></script>

<!-- (Opcional) Datatables si lo usas -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= Yii::getAlias('@web') ?>/template/js/datatables-simple-demo.js"></script>

<!-- (Opcional) Charts si lo usas -->
<
