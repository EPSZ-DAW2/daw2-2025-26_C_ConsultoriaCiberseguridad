<?php

/** @var yii\web\View $this */
/** @var array $cursosAgrupados Array de ['proyecto' => Proyecto, 'servicio' => Servicio, 'cursos' => Cursos[]] */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Campus de Ciberseguridad';
?>
<div class="cursos-index container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-white">
            <i class="fas fa-play-circle text-danger"></i> Mis Cursos de Formación
        </h1>
        <?= Html::a('<i class="fas fa-history"></i> Mi Historial', ['historial'], ['class' => 'btn btn-outline-light']) ?>
    </div>

    <?php foreach ($cursosAgrupados as $grupo): ?>
        <?php
            $proyecto = $grupo['proyecto'];
            $servicio = $grupo['servicio'];
            $cursos = $grupo['cursos'];
        ?>

        <!-- seccion por proyecto/servicio -->
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="text-white mb-1">
                        <i class="fas fa-briefcase text-primary"></i>
                        <?= Html::encode($proyecto->nombre) ?>
                    </h3>
                    <p class="text-muted mb-0">
                        <strong>Servicio:</strong> <?= Html::encode($servicio->nombre) ?>
                        <span class="badge bg-<?= $proyecto->isEstadoEnCurso() ? 'success' : 'info' ?> ms-2">
                            <?= Html::encode($proyecto->estado) ?>
                        </span>
                    </p>
                </div>
                <div class="text-end">
                    <?= Html::a('Ver Proyecto', ['/proyectos/view', 'id' => $proyecto->id], ['class' => 'btn btn-sm btn-outline-secondary']) ?>
                </div>
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

                                <?php
                                // ver progreso del usuario
                                $progreso = \common\models\ProgresoUsuario::findOne([
                                    'usuario_id' => Yii::$app->user->id,
                                    'curso_id' => $curso->id
                                ]);
                                ?>

                                <a href="<?= Url::to(['ver', 'id' => $curso->id]) ?>" class="play-overlay">
                                    <i class="far fa-play-circle fa-4x text-white"></i>
                                </a>

                                <?php if ($progreso): ?>
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <?php if ($progreso->isEstadoAprobado()): ?>
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle"></i> Aprobado
                                            </span>
                                        <?php elseif ($progreso->isEstadoSuspenso()): ?>
                                            <span class="badge bg-warning">
                                                <i class="fas fa-exclamation-circle"></i> Suspenso
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-info">
                                                <i class="fas fa-spinner"></i> En curso
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-truncate" title="<?= Html::encode($curso->nombre) ?>">
                                    <?= Html::encode($curso->nombre) ?>
                                </h5>
                                <p class="card-text small text-muted" style="height: 40px; overflow: hidden;">
                                    <?= Html::encode($curso->descripcion) ?>
                                </p>

                                <?php if ($progreso && $progreso->nota_obtenida !== null): ?>
                                    <div class="mb-2">
                                        <small class="text-light">
                                            <i class="fas fa-star"></i> Nota:
                                            <strong><?= number_format($progreso->nota_obtenida, 2) ?>/10</strong>
                                        </small>
                                    </div>
                                <?php endif; ?>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="badge bg-danger">Formación</span>
                                    <?php if ($progreso && $progreso->isEstadoAprobado()): ?>
                                        <?= Html::a('Revisar', ['ver', 'id' => $curso->id], ['class' => 'btn btn-sm btn-success']) ?>
                                    <?php elseif ($progreso && $progreso->isEstadoEnCurso()): ?>
                                        <?= Html::a('Continuar', ['contenido', 'id' => $curso->id, 'slide' => $progreso->diapositiva_actual], ['class' => 'btn btn-sm btn-primary']) ?>
                                    <?php else: ?>
                                        <?= Html::a('Comenzar', ['ver', 'id' => $curso->id], ['class' => 'btn btn-sm btn-outline-light']) ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <hr class="border-secondary">
        </div>

    <?php endforeach; ?>

</div>

<style>
    /* estilos netflix */
    body {
        background-color: #141414 !important;
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
