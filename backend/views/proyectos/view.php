<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Proyectos $model */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="proyectos-view">

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
            [
                'attribute' => 'cliente_id',
                'value' => $model->cliente ? $model->cliente->nombre . ' ' . $model->cliente->apellidos . ' (' . $model->cliente->empresa . ')' : null,
                'label' => 'Cliente',
            ],
            [
                'attribute' => 'servicio_id',
                'value' => $model->servicio ? $model->servicio->nombre : null,
                'label' => 'Servicio',
            ],
            [
                'attribute' => 'consultor_id',
                'value' => $model->consultor ? $model->consultor->nombre . ' ' . $model->consultor->apellidos : null,
                'label' => 'Consultor',
            ],
            [
                'attribute' => 'auditor_id',
                'value' => $model->auditor ? $model->auditor->nombre . ' ' . $model->auditor->apellidos : null,
                'label' => 'Auditor',
            ],
            'fecha_inicio:date',
            'fecha_fin_prevista:date',
            'fecha_fin_real:date',
            'estado',
            'presupuesto:currency',
            'notas_internas:ntext',
            [
                'attribute' => 'creado_por',
                'value' => $model->creadoPor ? $model->creadoPor->nombre . ' ' . $model->creadoPor->apellidos : $model->creado_por,
            ],
            'fecha_creacion:datetime',
            [
                'attribute' => 'modificado_por',
                'value' => $model->modificadoPor ? $model->modificadoPor->nombre . ' ' . $model->modificadoPor->apellidos : $model->modificado_por,
            ],
            'fecha_modificacion:datetime',
        ],
    ]) ?>

</div>
