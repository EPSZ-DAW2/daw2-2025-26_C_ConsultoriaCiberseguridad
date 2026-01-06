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

    // --- AQUÍ EMPIEZA LA MAGIA DEL MENÚ ---
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];

    // Solo mostramos opciones si el usuario NO es invitado
    if (!Yii::$app->user->isGuest) {
        
        // 1. GESTIONAR PROYECTOS (Consultor y Admin)
        if (Yii::$app->user->can('gestionarProyectos')) {
            $menuItems[] = ['label' => 'Gestionar Proyectos', 'url' => ['/proyectos/index']];
        }

        // 2. DOCUMENTACIÓN (Auditor, Consultor y Admin)
        if (Yii::$app->user->can('verDocs')) {
            $menuItems[] = ['label' => 'Documentación', 'url' => ['/documentos/index']];
        }

        // 3. CALENDARIO
        // Si pueden ver el panel (Staff), pueden ver el calendario
        if (Yii::$app->user->can('verPanel')) {
            $menuItems[] = ['label' => 'Calendario', 'url' => ['/eventos-calendario/index']];
        }

        // 3.5. GESTIÓN DE INCIDENCIAS (Admin y Analista SOC)
        $user = Yii::$app->user->identity;
        if ($user && in_array($user->rol, ['admin', 'analista_soc'])) {
            $menuItems[] = ['label' => 'Gestión Incidencias', 'url' => ['/incidencias/index']];
        }

        // 4. GESTIÓN FORMACIÓN (Solo Admin/Gestor)
        if (Yii::$app->user->can('gestionarProyectos')) { // Asumimos mismo permiso por simplicidad
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
