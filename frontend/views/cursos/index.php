<?php

/** @var yii\web\View $this */
/** @var common\models\Cursos[] $cursos */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Campus de Ciberseguridad';
?>
<div class="cursos-index container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-white"><i class="fas fa-play-circle text-danger"></i> Cursos Disponibles</h1>
    </div>

    <div class="row">
        <?php foreach ($cursos as $curso): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 bg-dark text-white border-0 shadow-lg course-card">
                    <div class="position-relative">
                        <?php 
                        $img = $curso->imagen_portada ? $curso->imagen_portada : 'https://via.placeholder.com/400x225?text=CyberSecurity';
                        ?>
                        <img src="<?= Html::encode($img) ?>" class="card-img-top" alt="<?= Html::encode($curso->nombre) ?>" style="height: 180px; object-fit: cover; opacity: 0.8;">
                        <a href="<?= Url::to(['ver', 'id' => $curso->id]) ?>" class="play-overlay">
                            <i class="far fa-play-circle fa-4x text-white"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-truncate" title="<?= Html::encode($curso->nombre) ?>"><?= Html::encode($curso->nombre) ?></h5>
                        <p class="card-text small text-muted" style="height: 40px; overflow: hidden;">
                            <?= Html::encode($curso->descripcion) ?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="badge bg-danger">Formación</span>
                            <?= Html::a('Ver Curso', ['ver', 'id' => $curso->id], ['class' => 'btn btn-sm btn-outline-light']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
        <?php if (empty($cursos)): ?>
            <div class="col-12 text-center text-white mt-5">
                <h3>No hay cursos disponibles en este momento.</h3>
            </div>
        <?php endif; ?>
    </div>

</div>

<style>
    /* Estilos "Netflix-like" rápidos */
    body {
        background-color: #141414 !important; /* Fondo oscuro global cuando se ve el campus */
        color: #fff;
    }
    .sb-sidenav-dark {
        background-color: #000 !important;
    }
    .card.course-card {
        transition: transform 0.3s;
    }
    .card.course-card:hover {
        transform: scale(1.05);
        z-index: 10;
        cursor: pointer;
    }
    .play-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.3);
        opacity: 0;
        transition: opacity 0.3s;
        text-decoration: none !important;
    }
    .card:hover .play-overlay {
        opacity: 1;
    }
</style>
