<?php

use common\models\Proyectos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\ProyectosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyectos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('gestionarProyectos')): ?>
    <p>
        <?= Html::a('Create Proyectos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'descripcion:ntext',
            [
                'attribute' => 'cliente_id',
                'value' => function ($model) {
                    return $model->cliente ? $model->cliente->nombre . ' ' . $model->cliente->apellidos : null;
                },
                'label' => 'Cliente',
            ],
            [
                'attribute' => 'servicio_id',
                'value' => function ($model) {
                    return $model->servicio ? $model->servicio->nombre : null;
                },
                'label' => 'Servicio',
            ],
            //'consultor_id',
            //'auditor_id',
            'fecha_inicio:date',
            'fecha_fin_prevista:date',
            //'fecha_fin_real',
            'estado',
            //'presupuesto',
            //'notas_internas:ntext',
            //'creado_por',
            //'fecha_creacion',
            //'modificado_por',
            //'fecha_modificacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Proyectos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('gestionarProyectos'),
                    'delete' => Yii::$app->user->can('gestionarProyectos'),
                ],
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-trash"></i>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => '⚠️ ¡ATENCIÓN! ¿Estás seguro de que quieres eliminar este PROYECTO? Esta acción NO se puede deshacer y eliminará todos los Documentos y Eventos asociados.',
                            'data-method' => 'post',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
