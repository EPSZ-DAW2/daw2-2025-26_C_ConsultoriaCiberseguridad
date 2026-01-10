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
                'value' => $model->proyecto ? $model->proyecto->nombre : null,
            ],
            [
                'attribute' => 'auditor_id',
                'value' => $model->auditor ? $model->auditor->nombre . ' ' . $model->auditor->apellidos : null,
            ],
            'titulo',
            'descripcion:ntext',
            'fecha',
            'hora_inicio',
            'hora_fin',
            'tipo_evento',
            'ubicacion',
            'estado_evento',
            'recordatorio_enviado',
            'notas:ntext',
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
