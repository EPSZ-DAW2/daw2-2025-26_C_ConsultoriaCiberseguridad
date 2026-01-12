<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Diapositivas $model */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Diapositivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="diapositivas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
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
            'numero_orden',
            'titulo',
            'contenido_html:ntext',
            'imagen_url:url',
            'video_url:url',
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
