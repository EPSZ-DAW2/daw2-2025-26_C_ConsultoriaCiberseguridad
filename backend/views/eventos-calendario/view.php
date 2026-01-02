<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\EventosCalendario $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Eventos Calendarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="eventos-calendario-view">

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
            'proyecto_id',
            'auditor_id',
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
            'creado_por',
            'fecha_creacion',
            'modificado_por',
            'fecha_modificacion',
        ],
    ]) ?>

</div>
