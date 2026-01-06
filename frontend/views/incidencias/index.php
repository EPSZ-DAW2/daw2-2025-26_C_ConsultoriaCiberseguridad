<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Incidencias[] $incidencias */

$this->title = 'Mis Incidencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidencias-index">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('<i class="fas fa-plus"></i> Reportar Nueva Incidencia', ['create'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php if (empty($incidencias)): ?>
        <div class="alert alert-info">
            <h4><i class="fas fa-info-circle"></i> No hay incidencias reportadas</h4>
            <p>No ha reportado ninguna incidencia de seguridad. Si detecta alguna amenaza o problema de seguridad, puede reportarlo haciendo clic en el botón "Reportar Nueva Incidencia".</p>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($incidencias as $incidencia): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                #<?= $incidencia->id ?> - <?= Html::encode($incidencia->titulo) ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <strong>Severidad:</strong>
                                <span class="badge badge-<?= $incidencia->severidad == 'Crítica' ? 'danger' : ($incidencia->severidad == 'Alta' ? 'warning' : ($incidencia->severidad == 'Media' ? 'info' : 'success')) ?> <?= $incidencia->severidad == 'Crítica' ? 'prioridad-critica' : '' ?>">
                                    <?= Html::encode($incidencia->severidad) ?>
                                </span>
                            </p>
                            <p class="card-text">
                                <strong>Estado:</strong>
                                <span class="badge badge-<?= $incidencia->estado_incidencia == 'Resuelto' ? 'success' : ($incidencia->estado_incidencia == 'Cerrado' ? 'secondary' : 'primary') ?>">
                                    <?= Html::encode($incidencia->estado_incidencia) ?>
                                </span>
                            </p>
                            <p class="card-text">
                                <strong>Fecha Reporte:</strong>
                                <?= Yii::$app->formatter->asDatetime($incidencia->fecha_reporte) ?>
                            </p>
                            <?php if ($incidencia->categoria_incidencia): ?>
                                <p class="card-text">
                                    <strong>Categoría:</strong>
                                    <?= Html::encode($incidencia->categoria_incidencia) ?>
                                </p>
                            <?php endif; ?>
                            <p class="card-text">
                                <small class="text-muted">
                                    <?= Html::encode(mb_substr($incidencia->descripcion, 0, 100)) ?>
                                    <?= mb_strlen($incidencia->descripcion) > 100 ? '...' : '' ?>
                                </small>
                            </p>
                        </div>
                        <div class="card-footer">
                            <?= Html::a('Ver Detalles', ['view', 'id' => $incidencia->id], ['class' => 'btn btn-primary btn-sm']) ?>
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

/* animación de parpadeo para prioridad crítica */
@keyframes parpadeo {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
}

.prioridad-critica {
    animation: parpadeo 1.5s ease-in-out infinite;
    font-weight: bold;
}
</style>
