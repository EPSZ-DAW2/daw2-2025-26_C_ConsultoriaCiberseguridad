<?php

use common\models\PreguntasCuestionario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\PreguntasCuestionarioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Preguntas Cuestionarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preguntas-cuestionario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Pregunta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'curso_id',
            'enunciado_pregunta:ntext',
            'opcion_a',
            'opcion_b',
            //'opcion_c',
            //'opcion_correcta',
            //'creado_por',
            //'fecha_creacion',
            //'modificado_por',
            //'fecha_modificacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PreguntasCuestionario $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
