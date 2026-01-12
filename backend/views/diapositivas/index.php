<?php

use common\models\Diapositivas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\DiapositivasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Diapositivas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diapositivas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Diapositiva', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'curso_id',
            'numero_orden',
            'titulo',
            'contenido_html:ntext',
            //'imagen_url:url',
            //'video_url:url',
            //'creado_por',
            //'fecha_creacion',
            //'modificado_por',
            //'fecha_modificacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Diapositivas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
