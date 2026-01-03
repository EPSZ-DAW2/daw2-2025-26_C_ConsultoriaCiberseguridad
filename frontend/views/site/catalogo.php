<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $servicios array */

$this->title = 'Catálogo de Servicios';
?>

<div class="site-catalogo">
    <div class="text-center mb-5">
        <h1><?= Html::encode($this->title) ?></h1>
        <p class="lead">Soluciones profesionales de ciberseguridad</p>
    </div>

    <div class="row">
        <?php foreach ($servicios as $servicio): ?>
            
            <?php 
                $precioVisual = number_format($servicio->precio_base, 0, ',', '.') . ' €';
            ?>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    
                    <img src="<?= $servicio->getImagenUrl() ?>" class="card-img-top" alt="<?= Html::encode($servicio->nombre) ?>" style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= Html::encode($servicio->nombre) ?></h5>
                        
                        <p class="card-text flex-grow-1">
                            <?= Html::encode($servicio->descripcion ?? 'Servicio profesional de ciberseguridad.') ?>
                        </p>
                        
                        <div class="mt-3">
                            <p class="text-primary fw-bold mb-1" style="font-size: 1.2rem;">
                                Desde <?= $precioVisual ?>
                            </p>
                            <?php if (!empty($servicio->duracion_estimada)): ?>
                                <small class="text-muted">Duración est.: <?= $servicio->duracion_estimada ?> días</small>
                            <?php endif; ?>
                        </div>

                        <a href="<?= \yii\helpers\Url::to(['site/servicio', 'id' => $servicio->id]) ?>" class="btn btn-primary w-100 mt-3">Más información</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        <?php if (empty($servicios)): ?>
            <div class="col-12 text-center alert alert-warning">
                No hay servicios activos.
            </div>
        <?php endif; ?>
    </div>
</div>