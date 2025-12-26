<?php
/** @var \yii\web\View $this */
/** @var array $servicios */

use yii\helpers\Html;

$this->title = 'Catálogo de Servicios';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4"><?= Html::encode($this->title) ?></h1>
    <p class="text-muted">Servicios disponibles de consultoría y ciberseguridad.</p>

    <div class="row g-4 mt-2">
        <?php foreach ($servicios as $s): ?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card h-100 shadow-sm">
                    <img src="<?= Html::encode($s['imagen']) ?>" class="card-img-top" alt="<?= Html::encode($s['nombre']) ?>" style="height: 180px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= Html::encode($s['nombre']) ?></h5>
                        <p class="card-text text-muted mb-4"><?= Html::encode($s['precio']) ?></p>
                        <a href="#" class="btn btn-primary mt-auto">Ver servicio</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
