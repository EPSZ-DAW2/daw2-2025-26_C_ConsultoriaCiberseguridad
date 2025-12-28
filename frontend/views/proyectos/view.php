<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Proyectos $model */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Mis Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="proyectos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Información del Proyecto</h5>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'nombre',
                            'descripcion:ntext',
                            [
                                'attribute' => 'servicio_id',
                                'value' => $model->servicio->nombre ?? 'N/A',
                                'label' => 'Servicio Contratado',
                            ],
                            [
                                'attribute' => 'estado',
                                'format' => 'raw',
                                'value' => '<span class="badge badge-' .
                                    ($model->estado == 'Finalizado' ? 'success' :
                                    ($model->estado == 'En curso' ? 'primary' : 'secondary')) . '">' .
                                    Html::encode($model->estado) . '</span>',
                            ],
                            'fecha_inicio:date',
                            'fecha_fin_prevista:date',
                            'fecha_fin_real:date',
                            [
                                'attribute' => 'presupuesto',
                                'value' => $model->presupuesto ? Yii::$app->formatter->asCurrency($model->presupuesto, 'EUR') : 'N/A',
                            ],
                        ],
                    ]) ?>
                </div>
            </div>

            <?php if ($model->consultor): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Consultor Asignado</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre:</strong> <?= Html::encode($model->consultor->nombre . ' ' . ($model->consultor->apellidos ?? '')) ?></p>
                        <p><strong>Email:</strong> <?= Html::encode($model->consultor->email) ?></p>
                        <?php if ($model->consultor->telefono): ?>
                            <p><strong>Teléfono:</strong> <?= Html::encode($model->consultor->telefono) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($model->auditor): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Auditor Asignado</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre:</strong> <?= Html::encode($model->auditor->nombre . ' ' . ($model->auditor->apellidos ?? '')) ?></p>
                        <p><strong>Email:</strong> <?= Html::encode($model->auditor->email) ?></p>
                        <?php if ($model->auditor->telefono): ?>
                            <p><strong>Teléfono:</strong> <?= Html::encode($model->auditor->telefono) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Documentos del Proyecto</h5>
                </div>
                <div class="card-body">
                    <?php
                    $documentos = $model->getDocumentos()->where(['visible_cliente' => 1])->all();
                    if (empty($documentos)):
                    ?>
                        <p class="text-muted">No hay documentos disponibles.</p>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($documentos as $doc): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file text-danger"></i> <?= Html::encode($doc->nombre_archivo) ?>
                                        <br>
                                        <small class="text-muted">
                                            <?= Html::encode($doc->tipo_documento) ?>
                                            <?php if ($doc->version): ?>
                                                - v<?= Html::encode($doc->version) ?>
                                            <?php endif; ?>
                                        </small>
                                    </div>
                                    
                                    <?= Html::a('⬇️ Descargar', ['descargar', 'id' => $doc->id], [
                                        'class' => 'btn btn-sm btn-outline-primary',
                                        'title' => 'Descargar este documento',
                                        'data-pjax' => '0', // Importante para descargas de archivos
                                    ]) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Próximos Eventos</h5>
                </div>
                <div class="card-body">
                    <?php
                    $eventos = $model->getEventosCalendarios()
                        ->where(['>=', 'fecha', date('Y-m-d')])
                        ->orderBy(['fecha' => SORT_ASC, 'hora_inicio' => SORT_ASC])
                        ->limit(5)
                        ->all();
                    if (empty($eventos)):
                    ?>
                        <p class="text-muted">No hay eventos programados.</p>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($eventos as $evento): ?>
                                <li class="list-group-item">
                                    <strong><?= Html::encode($evento->titulo) ?></strong><br>
                                    <small class="text-muted">
                                        <i class="far fa-calendar"></i>
                                        <?= Yii::$app->formatter->asDate($evento->fecha) ?>
                                        <?= Yii::$app->formatter->asTime($evento->hora_inicio) ?>
                                    </small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <p class="mt-4">
        <?= Html::a('Volver a Mis Proyectos', ['index'], ['class' => 'btn btn-secondary']) ?>
    </p>

</div>
