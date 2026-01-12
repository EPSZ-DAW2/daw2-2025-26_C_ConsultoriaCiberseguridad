<?php

use common\models\Incidencias;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\IncidenciasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Incidencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidencias-index">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <?= Html::a('<i class="fas fa-user-shield"></i> Mis Incidencias', ['index', 'IncidenciasSearch[analista_id]' => Yii::$app->user->id], ['class' => 'btn btn-outline-primary']) ?>
            <?= Html::a('<i class="fas fa-folder-open"></i> Abiertas', ['index', 'IncidenciasSearch[estado_incidencia]' => 'Abierto'], ['class' => 'btn btn-outline-warning']) ?>
            <?= Html::a('Todas', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
        <?= Html::a('<i class="fas fa-plus-circle"></i> Reporte Manual', ['create'], ['class' => 'btn btn-secondary btn-sm']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => 'Mostrando <b>{begin}-{end}</b> de <b>{totalCount}</b> incidencias',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:60px'],
                'contentOptions' => ['class' => 'text-center fw-bold'],
            ],
            [
                'attribute' => 'cliente_id',
                'value' => function($model) {
                    return $model->cliente ? $model->cliente->nombre : 'N/A';
                }
            ],
            [
                'attribute' => 'analista_id',
                'value' => function($model) {
                    return $model->analista ? $model->analista->nombre : 'Sin asignar';
                }
            ],
            'titulo',
            [
                'attribute' => 'severidad',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width:100px'],
                'value' => function($model) {
                    $claseAnimacion = ($model->severidad == 'Crítica') ? 'prioridad-critica' : '';
                    // Mapeo a colores Bootstrap SOC
                    $badgeClass = 'secondary';
                    if ($model->severidad == 'Crítica') $badgeClass = 'danger';
                    if ($model->severidad == 'Alta') $badgeClass = 'warning text-dark';
                    if ($model->severidad == 'Media') $badgeClass = 'info text-dark';
                    if ($model->severidad == 'Baja') $badgeClass = 'success';
                    
                    return '<span class="badge w-100 bg-' . $badgeClass . ' ' . $claseAnimacion . '">' .
                           Html::encode($model->severidad) . '</span>';
                },
                'filter' => Incidencias::optsSeveridad(),
            ],
            [
                'attribute' => 'estado_incidencia',
                'format' => 'raw',
                'value' => function($model) {
                    $badgeClass = $model->estado_incidencia == 'Resuelto' ? 'success' :
                                ($model->estado_incidencia == 'Cerrado' ? 'secondary' : 'primary');
                    return '<span class="badge bg-' . $badgeClass . '">' .
                           Html::encode($model->estado_incidencia) . '</span>';
                },
                'filter' => Incidencias::optsEstadoIncidencia(),
            ],
            'fecha_reporte:datetime',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {close}', // Quitamos delete, añadimos close
                'buttons' => [
                    'close' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-check-double"></i>', ['close', 'id' => $model->id], [
                            'title' => 'Cerrar Incidencia',
                            'class' => 'text-success ms-2',
                            'data' => [
                                'confirm' => '¿Cerrar esta incidencia inmediatamente?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
                'urlCreator' => function ($action, Incidencias $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


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
