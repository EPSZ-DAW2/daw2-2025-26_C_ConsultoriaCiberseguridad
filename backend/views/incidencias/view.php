<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Incidencias $model */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Incidencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="incidencias-view">

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
                'attribute' => 'cliente_id',
                'value' => $model->cliente ? $model->cliente->nombre . ' ' . $model->cliente->apellidos . ' (' . $model->cliente->empresa . ')' : null,
            ],
            [
                'attribute' => 'analista_id',
                'value' => $model->analista ? $model->analista->nombre . ' ' . $model->analista->apellidos : null,
            ],
            'titulo',
            'descripcion:ntext',
            'severidad',
            'estado_incidencia',
            'categoria_incidencia',
            'fecha_reporte',
            'fecha_asignacion',
            'fecha_primera_respuesta',
            'fecha_resolucion',
            'tiempo_resolucion',
            'sla_cumplido',
            'ip_origen',
            'sistema_afectado',
            'acciones_tomadas:ntext',
            'notas_internas:ntext',
            'visible_cliente',
        ],
    ]) ?>

</div>
