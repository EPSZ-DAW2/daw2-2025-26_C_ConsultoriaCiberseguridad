<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Incidencias $model */

$this->title = 'Incidencia #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mis Incidencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="incidencias-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><?= Html::encode($model->titulo) ?></h5>
                    <span class="badge badge-<?= $model->estado_incidencia == 'Resuelto' ? 'success' : ($model->estado_incidencia == 'Cerrado' ? 'secondary' : 'primary') ?> badge-lg">
                        <?= Html::encode($model->estado_incidencia) ?>
                    </span>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'titulo',
                            'descripcion:ntext',
                            [
                                'attribute' => 'severidad',
                                'format' => 'raw',
                                'value' => '<span class="badge badge-' .
                                    ($model->severidad == 'Crítica' ? 'danger' :
                                    ($model->severidad == 'Alta' ? 'warning' :
                                    ($model->severidad == 'Media' ? 'info' : 'success'))) .
                                    ($model->severidad == 'Crítica' ? ' prioridad-critica' : '') . '">' .
                                    Html::encode($model->severidad) . '</span>',
                            ],
                            [
                                'attribute' => 'estado_incidencia',
                                'format' => 'raw',
                                'value' => '<span class="badge badge-' .
                                    ($model->estado_incidencia == 'Resuelto' ? 'success' :
                                    ($model->estado_incidencia == 'Cerrado' ? 'secondary' : 'primary')) . '">' .
                                    Html::encode($model->estado_incidencia) . '</span>',
                            ],
                            'categoria_incidencia',
                            'fecha_reporte:datetime',
                            'ip_origen',
                            'sistema_afectado',
                        ],
                    ]) ?>
                </div>
            </div>

            <?php if ($model->acciones_tomadas): ?>
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-check-circle"></i> Acciones Tomadas por el Equipo SOC</h5>
                    </div>
                    <div class="card-body">
                        <p><?= nl2br(Html::encode($model->acciones_tomadas)) ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Información del Analista</h5>
                </div>
                <div class="card-body">
                    <?php if ($model->analista): ?>
                        <p><strong>Analista Asignado:</strong><br><?= Html::encode($model->analista->nombre . ' ' . ($model->analista->apellidos ?? '')) ?></p>
                        <p><strong>Email:</strong><br><?= Html::encode($model->analista->email) ?></p>
                        <?php if ($model->fecha_asignacion): ?>
                            <p><strong>Fecha Asignación:</strong><br><?= Yii::$app->formatter->asDatetime($model->fecha_asignacion) ?></p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-muted">Pendiente de asignación</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Timeline</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="fas fa-circle text-primary"></i> <strong>Reportado:</strong> <?= Yii::$app->formatter->asDatetime($model->fecha_reporte) ?></li>
                        <?php if ($model->fecha_primera_respuesta): ?>
                            <li class="mt-2"><i class="fas fa-circle text-info"></i> <strong>Primera Respuesta:</strong> <?= Yii::$app->formatter->asDatetime($model->fecha_primera_respuesta) ?></li>
                        <?php endif; ?>
                        <?php if ($model->fecha_resolucion): ?>
                            <li class="mt-2"><i class="fas fa-circle text-success"></i> <strong>Resuelto:</strong> <?= Yii::$app->formatter->asDatetime($model->fecha_resolucion) ?></li>
                        <?php endif; ?>
                    </ul>

                    <?php if ($model->tiempo_resolucion): ?>
                        <hr>
                        <p><strong>Tiempo de Resolución:</strong><br><?= $model->tiempo_resolucion ?> minutos (<?= round($model->tiempo_resolucion / 60, 1) ?> horas)</p>
                    <?php endif; ?>

                    <?php if ($model->sla_cumplido !== null): ?>
                        <p>
                            <strong>SLA:</strong>
                            <span class="badge badge-<?= $model->sla_cumplido ? 'success' : 'danger' ?>">
                                <?= $model->sla_cumplido ? 'Cumplido' : 'No Cumplido' ?>
                            </span>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <p class="mt-4">
        <?= Html::a('Volver a Mis Incidencias', ['index'], ['class' => 'btn btn-secondary']) ?>
    </p>

</div>

<style>
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
