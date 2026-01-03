<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $servicio common\models\Servicios */

$this->title = $servicio->nombre;
$precioVisual = number_format($servicio->precio_base, 0, ',', '.') . ' €';
?>

<div class="site-servicio-detail">
    <div class="container py-5">
        <div class="mb-4">
            <a href="<?= Url::to(['site/catalogo']) ?>" class="text-decoration-none">
                <i class="fas fa-arrow-left"></i> Volver al Catálogo
            </a>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <img src="<?= $servicio->getImagenUrl() ?>" class="img-fluid w-100" alt="<?= Html::encode($servicio->nombre) ?>" style="object-fit: cover; min-height: 400px;">
                </div>
            </div>
            
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold mb-3"><?= Html::encode($servicio->nombre) ?></h1>
                
                <span class="badge bg-secondary mb-3 fs-6"><?= Html::encode($servicio->displayCategoria()) ?></span>
                
                <div class="mb-4">
                    <h2 class="text-primary fw-bold"><?= $precioVisual ?></h2>
                    <?php if ($servicio->duracion_estimada): ?>
                        <p class="text-muted"><i class="far fa-clock"></i> Duración estimada: <?= $servicio->duracion_estimada ?> días</p>
                    <?php endif; ?>
                </div>

                <div class="prose mb-5">
                    <p class="lead"><?= Html::encode($servicio->descripcion ?? 'Descripción no disponible.') ?></p>
                    <p>
                        Este servicio incluye una auditoría completa inicial, implementación de medidas correctivas y un informe detallado de resultados.
                        Nuestro equipo de expertos te guiará paso a paso para asegurar el éxito del proyecto.
                    </p>
                </div>

                <div class="d-grid gap-2 d-md-block">
                    <a href="<?= Url::to(['site/contact', 'servicio' => $servicio->nombre]) ?>" class="btn btn-primary btn-lg px-5">
                        Solicitar Presupuesto
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
