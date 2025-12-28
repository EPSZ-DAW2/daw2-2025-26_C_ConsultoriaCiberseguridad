<?php

use common\models\Documentos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\DocumentosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Documentos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'proyecto_id',
            'nombre_archivo',
            'descripcion:ntext',
            'ruta_archivo:ntext',
            //'tipo_documento',
            //'tamaño_bytes',
            //'version',
            //'visible_cliente',
            //'hash_verificacion',
            //'subido_por',
            //'fecha_subida',
            //'fecha_modificacion',
            //'notas:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Documentos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
