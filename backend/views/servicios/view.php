<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Servicios $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="servicios-view">

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
            'nombre',
            'descripcion:ntext',
            'categoria',
            'precio_base',
            [
                'attribute' => 'duracion_estimada',
                'value' => $model->duracion_estimada . ' días',
            ],
            [
                'attribute' => 'requiere_auditoria',
                'value' => $model->requiere_auditoria ? 'Sí' : 'No',
            ],
            [
                'attribute' => 'activo',
                'value' => $model->activo ? 'Sí' : 'No',
                'label' => 'Activo en el catálogo',
            ],
            'creado_por',
            'fecha_creacion',
            'modificado_por',
            'fecha_modificacion',
        ],
    ]) ?>

</div>
