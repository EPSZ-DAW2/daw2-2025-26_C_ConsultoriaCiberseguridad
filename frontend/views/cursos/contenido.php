<?php

/** @var yii\web\View $this */
/** @var common\models\Cursos $curso */
/** @var common\models\Diapositivas $diapositiva */
/** @var int $currentSlide */
/** @var int $totalSlides */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $curso->nombre . ' - Diapositiva ' . $currentSlide;
?>

<div class="curso-contenido container mt-4">
    
    <!-- Barra de Progreso -->
    <div class="progress mb-4" style="height: 20px;">
        <?php 
            $porcentaje = ($currentSlide / $totalSlides) * 100;
        ?>
        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $porcentaje ?>%;" aria-valuenow="<?= $porcentaje ?>" aria-valuemin="0" aria-valuemax="100">
            <?= round($porcentaje) ?>%
        </div>
    </div>

    <!-- Título y Navegación Superior -->
    <div class="d-flex justify-content-between align-items-center mb-4 text-white">
        <h2><?= Html::encode($diapositiva->titulo) ?></h2>
        <span class="badge bg-secondary">Diapositiva <?= $currentSlide ?> de <?= $totalSlides ?></span>
    </div>

    <!-- Contenido Principal -->
    <div class="card bg-dark text-white shadow-lg mb-4">
        <div class="card-body">
            
            <!-- 1. Imagen o Esquema -->
            <?php if ($diapositiva->imagen_url): ?>
                <div class="text-center mb-4">
                    <img src="<?= Html::encode($diapositiva->imagen_url) ?>" class="img-fluid rounded" alt="Esquema" style="max-height: 400px;">
                </div>
            <?php endif; ?>

            <!-- 2. Video -->
            <?php if ($diapositiva->video_url): ?>
                <div class="ratio ratio-16x9 mb-4">
                    <iframe src="<?= Html::encode($diapositiva->video_url) ?>" allowfullscreen></iframe>
                </div>
            <?php endif; ?>

            <!-- 3. Texto HTML -->
            <div class="contenido-texto fs-5">
                <?= $diapositiva->contenido_html ?>
            </div>

        </div>
        
        <!-- Botones de Navegación Pie -->
        <div class="card-footer d-flex justify-content-between">
            <?php if ($currentSlide > 1): ?>
                <a href="<?= Url::to(['contenido', 'id' => $curso->id, 'slide' => $currentSlide - 1]) ?>" class="btn btn-outline-light">
                    <i class="fas fa-arrow-left"></i> Anterior
                </a>
            <?php else: ?>
                <a href="<?= Url::to(['ver', 'id' => $curso->id]) ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-home"></i> Inicio Curso
                </a>
            <?php endif; ?>

            <?php if ($currentSlide < $totalSlides): ?>
                <a href="<?= Url::to(['contenido', 'id' => $curso->id, 'slide' => $currentSlide + 1]) ?>" class="btn btn-primary">
                    Siguiente <i class="fas fa-arrow-right"></i>
                </a>
            <?php else: ?>
                <a href="<?= Url::to(['examen', 'id' => $curso->id]) ?>" class="btn btn-success btn-lg pulsate">
                    <i class="fas fa-graduation-cap"></i> REALIZAR EXAMEN FINAL
                </a>
            <?php endif; ?>
        </div>
    </div>

</div>

<style>
    body { background-color: #141414 !important; color: white; }
    .contenido-texto p { margin-bottom: 1.5rem; line-height: 1.6; }
    .pulsate { animation: pulsate 1.5s infinite; }
    @keyframes pulsate {
        0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
        70% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
        100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
    }
</style>
