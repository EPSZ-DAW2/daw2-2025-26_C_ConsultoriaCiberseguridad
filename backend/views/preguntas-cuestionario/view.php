<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\PreguntasCuestionario $model */

$this->title = 'Pregunta #' . $model->id;
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
            [
                'attribute' => 'curso_id',
                'value' => $model->curso ? $model->curso->titulo : null,
            ],
            'enunciado_pregunta:ntext',
            'opcion_a',
            'opcion_b',
            'opcion_c',
            'opcion_correcta',
            [
                'attribute' => 'creado_por',
                'value' => $model->creadoPor ? $model->creadoPor->nombre . ' ' . $model->creadoPor->apellidos : null,
            ],
            'fecha_creacion',
            [
                'attribute' => 'modificado_por',
                'value' => $model->modificadoPor ? $model->modificadoPor->nombre . ' ' . $model->modificadoPor->apellidos : null,
            ],
            'fecha_modificacion',
        ],
    ]) ?>

</div>
