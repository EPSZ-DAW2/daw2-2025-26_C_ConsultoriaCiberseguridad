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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Incidencias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
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
                'value' => function($model) {
                    $claseAnimacion = ($model->severidad == 'Crítica') ? 'prioridad-critica' : '';
                    $badgeClass = $model->severidad == 'Crítica' ? 'danger' :
                                ($model->severidad == 'Alta' ? 'warning' :
                                ($model->severidad == 'Media' ? 'info' : 'success'));
                    return '<span class="badge bg-' . $badgeClass . ' ' . $claseAnimacion . '">' .
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
