<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);

    // --- MENÚ CON RBAC COMPLETO ---
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];

    if (!Yii::$app->user->isGuest) {

        // PROYECTOS (vista o gestión según permisos)
        if (Yii::$app->user->can('gestionarProyectos')) {
            $menuItems[] = ['label' => 'Gestionar Proyectos', 'url' => ['/proyectos/index']];
        } elseif (Yii::$app->user->can('verPanel')) {
            $menuItems[] = ['label' => 'Ver Proyectos', 'url' => ['/proyectos/index']];
        }

        // DOCUMENTACIÓN (lectura o escritura)
        if (Yii::$app->user->can('verDocs')) {
            $menuItems[] = ['label' => 'Documentación', 'url' => ['/documentos/index']];
        }

        // SERVICIOS (catálogo para comercial)
        if (Yii::$app->user->can('gestionarCatalogo')) {
            $menuItems[] = ['label' => 'Catálogo Servicios', 'url' => ['/servicios/index']];
        }

        // CALENDARIO (staff con acceso al panel)
        if (Yii::$app->user->can('verPanel')) {
            $menuItems[] = ['label' => 'Calendario', 'url' => ['/eventos-calendario/index']];
        }

        // CRM (comercial y admin)
        if (Yii::$app->user->can('gestionarCRM')) {
            $menuItems[] = ['label' => 'CRM', 'url' => ['/crm/index']];
        }

        // MONITORIZACIÓN SOC (analista_soc y admin)
        if (Yii::$app->user->can('verMonitorizacion')) {
            $menuItems[] = ['label' => 'Monitorización SOC', 'url' => ['/monitorizacion/index']];
        }

        // INCIDENCIAS (analista_soc y admin)
        if (Yii::$app->user->can('gestionarTickets')) {
            $menuItems[] = ['label' => 'Gestión Incidencias', 'url' => ['/incidencias/index']];
        }

        // RENTABILIDAD (manager y admin)
        if (Yii::$app->user->can('verRentabilidad')) {
            $menuItems[] = ['label' => 'Rentabilidad', 'url' => ['/rentabilidad/index']];
        }

        // FORMACIÓN (consultor, admin - reusan permiso gestionarProyectos)
        if (Yii::$app->user->can('gestionarProyectos')) {
            $menuItems[] = [
                'label' => 'Formación',
                'items' => [
                    ['label' => 'Cursos', 'url' => ['/cursos/index']],
                    ['label' => 'Diapositivas', 'url' => ['/diapositivas/index']],
                    ['label' => 'Preguntas Examen', 'url' => ['/preguntas-cuestionario/index']],
                    '<div class="dropdown-divider"></div>',
                    ['label' => 'Progreso Alumnos', 'url' => ['/progreso-usuario/index']],
                ],
            ];
        }
    }

    // Botón de Login para invitados (por si acaso, aunque en backend suele estar protegido)
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    }    
    // --------------------------------------

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);

    // Botón de Logout (Salida)
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->nombre . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
