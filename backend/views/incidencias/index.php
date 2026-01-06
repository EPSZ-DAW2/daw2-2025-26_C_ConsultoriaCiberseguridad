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
            'cliente_id',
            'analista_id',
            'titulo',
            'descripcion:ntext',
            //'severidad',
            //'estado_incidencia',
            //'categoria_incidencia',
            //'fecha_reporte',
            //'fecha_asignacion',
            //'fecha_primera_respuesta',
            //'fecha_resolucion',
            //'tiempo_resolucion',
            //'sla_cumplido',
            //'ip_origen',
            //'sistema_afectado',
            //'acciones_tomadas:ntext',
            //'notas_internas:ntext',
            //'visible_cliente',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Incidencias $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
