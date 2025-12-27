<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\PreguntasCuestionario $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Preguntas Cuestionarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="preguntas-cuestionario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'curso_id',
            'enunciado_pregunta:ntext',
            'opcion_a',
            'opcion_b',
            'opcion_c',
            'opcion_correcta',
            'creado_por',
            'fecha_creacion',
            'modificado_por',
            'fecha_modificacion',
        ],
    ]) ?>

</div>
