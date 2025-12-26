<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Proyectos[] $proyectos */

$this->title = 'Mis Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyectos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (empty($proyectos)): ?>
        <div class="alert alert-info">
            <p>No tiene proyectos asignados actualmente.</p>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($proyectos as $proyecto): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <?= Html::encode($proyecto->nombre) ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <strong>Servicio:</strong>
                                <?= Html::encode($proyecto->servicio->nombre ?? 'N/A') ?>
                            </p>
                            <p class="card-text">
                                <strong>Estado:</strong>
                                <span class="badge badge-<?= $proyecto->estado == 'Finalizado' ? 'success' : ($proyecto->estado == 'En curso' ? 'primary' : 'secondary') ?>">
                                    <?= Html::encode($proyecto->estado) ?>
                                </span>
                            </p>
                            <p class="card-text">
                                <strong>Fecha Inicio:</strong>
                                <?= Yii::$app->formatter->asDate($proyecto->fecha_inicio) ?>
                            </p>
                            <?php if ($proyecto->fecha_fin_prevista): ?>
                                <p class="card-text">
                                    <strong>Fecha Fin Prevista:</strong>
                                    <?= Yii::$app->formatter->asDate($proyecto->fecha_fin_prevista) ?>
                                </p>
                            <?php endif; ?>
                            <?php if ($proyecto->descripcion): ?>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <?= Html::encode(mb_substr($proyecto->descripcion, 0, 100)) ?>
                                        <?= mb_strlen($proyecto->descripcion) > 100 ? '...' : '' ?>
                                    </small>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <?= Html::a('Ver Detalles', ['view', 'id' => $proyecto->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<style>
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}
</style>
