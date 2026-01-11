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
                $precioVisual = number_format($servicio->precio_base, 2, ',', '.') . ' €';
            ?>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    
                    <img src="<?= $servicio->getImagenUrl() ?>" class="card-img-top" alt="<?= Html::encode($servicio->nombre) ?>" style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <h4 class="card-title fw-bold"><?= Html::encode($servicio->nombre) ?></h4>
                            <p class="text-muted small mb-2">Categoría: <?= $servicio->categoria ?></p>
                        </div>
                        
                        <p class="card-text text-muted flex-grow-1">
                            <?= Html::encode($servicio->descripcion) ?>
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                            <h2 class="text-primary fw-bold mb-0"><?= $precioVisual ?></h2>
                            
                            <!-- Botón Más Información -->
                            <button class="btn btn-outline-info btn-sm btn-more-info" type="button" data-target="#info-<?= $servicio->id ?>" aria-expanded="false">
                                <i class="fas fa-info-circle"></i> Info
                            </button>
                        </div>

                        <!-- Dropdown Más Info -->
                        <div class="collapse mb-3" id="info-<?= $servicio->id ?>">
                            <div class="card card-body bg-light text-small small border-0">
                                <?= nl2br(Html::encode($servicio->Mas_informacion ?? 'Sin información adicional.')) ?>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-grid gap-2 mt-auto">
                             <a href="<?= \yii\helpers\Url::to(['site/checkout', 'servicio_id' => $servicio->id]) ?>" class="btn btn-primary">
                                <i class="fas fa-credit-card"></i> Contratar con Tarjeta
                            </a>
                            <a href="<?= \yii\helpers\Url::to(['site/solicitar-presupuesto', 'servicio_id' => $servicio->id]) ?>" class="btn btn-outline-secondary btn-sm" data-confirm="¿Deseas solicitar este servicio vía transferencia? Se creará una solicitud.">
                                <i class="fas fa-university"></i> Pago por Transferencia
                            </a>
                        </div>
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

<?php
$script = <<< JS
    $(document).on('click', '.btn-more-info', function(e) {
        e.preventDefault();
        var target = $(this).attr('data-target');
        $(target).slideToggle();
    });
JS;
$this->registerJs($script);
?>