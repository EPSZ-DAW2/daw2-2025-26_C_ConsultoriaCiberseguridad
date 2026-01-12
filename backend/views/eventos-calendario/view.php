<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\EventosCalendario $model */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Eventos Calendarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="eventos-calendario-view">

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
                'attribute' => 'proyecto_id',
                'label' => 'Proyecto',
                'value' => function($model) {
                    return $model->proyecto ? $model->proyecto->nombre : '(Sin Proyecto)';
                }
            ],
            [
                'label' => 'Cliente',
                'value' => function($model) {
                    if ($model->proyecto && $model->proyecto->cliente) {
                        return $model->proyecto->cliente->nombre . ' ' . $model->proyecto->cliente->apellidos . 
                               ($model->proyecto->cliente->empresa ? ' (' . $model->proyecto->cliente->empresa . ')' : '');
                    }
                    return '(Sin Cliente asignado al proyecto)';
                }
            ],
            [
                'attribute' => 'auditor_id',
                'label' => 'Auditor',
                'value' => function($model) {
                     return $model->auditor ? $model->auditor->nombre . ' ' . $model->auditor->apellidos : '(No asignado)';
                }
            ],
            'titulo',
            'descripcion:ntext',
            'fecha:date',
            'hora_inicio',
            'hora_fin',
            'tipo_evento',
            'ubicacion',
            'estado_evento',
            'recordatorio_enviado:boolean',
            'notas:ntext',
            [
                'attribute' => 'creado_por',
                'value' => function($model) {
                    return $model->creadoPor ? $model->creadoPor->nombre . ' ' . $model->creadoPor->apellidos : $model->creado_por;
                }
            ],
            'fecha_creacion:datetime',
            [
                'attribute' => 'modificado_por',
                'value' => function($model) {
                    return $model->modificadoPor ? $model->modificadoPor->nombre . ' ' . $model->modificadoPor->apellidos : $model->modificado_por;
                }
            ],
            'fecha_modificacion:datetime',
        ],
    ]) ?>

</div>
