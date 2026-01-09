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
