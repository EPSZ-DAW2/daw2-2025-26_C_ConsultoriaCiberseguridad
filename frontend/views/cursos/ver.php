<?php

/** @var yii\web\View $this */
/** @var common\models\Cursos $model */

use yii\helpers\Html;

$this->title = $model->nombre;
?>
<div class="cursos-ver container mt-4">

    <?= Html::a('← Volver al Campus', ['index'], ['class' => 'btn btn-outline-light mb-3']) ?>

    <div class="row">
        <div class="col-lg-9">
            <!-- Video Player -->
            <div class="ratio ratio-16x9 bg-black shadow-lg mb-4 text-center d-flex align-items-center justify-content-center">
                <?php if ($model->video_url): 
                    $embedUrl = str_replace('watch?v=', 'embed/', $model->video_url);
                    $embedUrl = str_replace('youtu.be/', 'www.youtube.com/embed/', $embedUrl);
                ?>
                    <iframe src="<?= Html::encode($embedUrl) ?>" title="<?= Html::encode($model->nombre) ?>" allowfullscreen></iframe>
                <?php else: ?>
                    <div class="text-muted p-5">
                        <i class="fas fa-video-slash fa-3x mb-3"></i><br>
                        Video no disponible
                    </div>
                <?php endif; ?>
            </div>

            <h2 class="text-white"><?= Html::encode($model->nombre) ?></h2>

            <?php
            // ver progreso del usuario
            $progreso = \common\models\ProgresoUsuario::findOne([
                'usuario_id' => Yii::$app->user->id,
                'curso_id' => $model->id
            ]);

            if ($progreso):
            ?>
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <div>
                    <strong>Tu progreso:</strong>
                    <?php if ($progreso->isEstadoAprobado()): ?>
                        <span class="badge bg-success ms-2">
                            <i class="fas fa-trophy"></i> Aprobado - Nota: <?= number_format($progreso->nota_obtenida, 2) ?>/10
                        </span>
                    <?php elseif ($progreso->isEstadoSuspenso()): ?>
                        <span class="badge bg-warning ms-2">
                            <i class="fas fa-redo"></i> Suspenso - Nota: <?= number_format($progreso->nota_obtenida, 2) ?>/10
                        </span>
                    <?php else: ?>
                        <span class="badge bg-primary ms-2">
                            <i class="fas fa-spinner"></i> En curso - Diapositiva <?= $progreso->diapositiva_actual ?>
                        </span>
                    <?php endif; ?>
                </div>
                <?php if ($progreso->isEstadoEnCurso()): ?>
                    <?= Html::a('Continuar donde lo dejaste', ['contenido', 'id' => $model->id, 'slide' => $progreso->diapositiva_actual], ['class' => 'btn btn-primary']) ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <p class="text-secondary"><?= Html::encode($model->descripcion) ?></p>

        </div>
        
        <div class="col-lg-3">
             <div class="card bg-dark text-white mb-3">
                <div class="card-header">Detalles</div>
                <div class="card-body">
                     <p><strong><i class="fas fa-clock"></i> Duración:</strong> Variable</p>
                     <p><strong><i class="fas fa-star"></i> Nivel:</strong> Intermedio</p>
                     <p><strong><i class="fas fa-certificate"></i> Certificado:</strong> Al completar</p>
                     
                     <hr class="border-secondary">
                     
                     <div class="d-grid">
                         <?= Html::a('<i class="fas fa-book-open"></i> Comenzar Lecciones', ['contenido', 'id' => $model->id, 'slide' => 1], ['class' => 'btn btn-success']) ?>
                     </div>
                </div>
             </div>
             
             <!-- Aquí podrían ir "Siguientes lecciones" -->
        </div>
    </div>

</div>

<style>
    body {
        background-color: #141414 !important;
        color: #fff;
    }
</style>
