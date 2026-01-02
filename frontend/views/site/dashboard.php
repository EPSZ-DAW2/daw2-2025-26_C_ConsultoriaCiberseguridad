<?php

/** @var yii\web\View $this */

$this->title = 'Dashboard Cliente';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-dashboard">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Bienvenido, <?= \yii\helpers\Html::encode(Yii::$app->user->identity->username) ?></h1>
            <p class="col-md-8 fs-4">Este es tu panel de control privado.</p>
            <p>Desde aquí podrás gestionar tus proyectos, ver el estado de tus servicios contratados y acceder a documentación exclusiva.</p>
            <button class="btn btn-primary btn-lg" type="button">Ver mis proyectos</button>
        </div>
    </div>

    <div class="row align-items-md-stretch">
        <div class="col-md-6">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
                <h2>Mis Servicios Activos</h2>
                <p>Consulta el estado de los servicios de ciberseguridad que tienes contratados actualmente.</p>
                <button class="btn btn-outline-light" type="button">Ver Servicios</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 bg-light border rounded-3">
                <h2>Soporte y Ayuda</h2>
                <p>¿Necesitas asistencia técnica? Contacta con nuestro equipo de soporte especializado.</p>
                <a href="<?= \yii\helpers\Url::to(['site/contact']) ?>" class="btn btn-outline-secondary">Contactar Soporte</a>
            </div>
        </div>
    </div>
</div>
