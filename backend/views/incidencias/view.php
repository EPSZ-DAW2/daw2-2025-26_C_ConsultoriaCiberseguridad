<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Incidencias $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incidencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="incidencias-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'cliente_id',
                'value' => function($model) {
                    $u = \common\models\Usuarios::findOne($model->cliente_id);
                    return $u ? $u->nombre . ' ' . $u->apellidos . ' (' . ($u->empresa ?? '-') . ')' : '-';
                },
            ],
            [
                'attribute' => 'analista_id',
                'value' => function($model) {
                    $u = \common\models\Usuarios::findOne($model->analista_id);
                    return $u ? $u->nombre . ' ' . $u->apellidos : '-';
                },
            ],
            'titulo',
            'descripcion:ntext',
            'severidad',
            'estado_incidencia',
            'categoria_incidencia',
            'fecha_reporte:datetime',
            'fecha_asignacion:datetime',
            'fecha_primera_respuesta:datetime',
            'fecha_resolucion:datetime',
            'tiempo_resolucion',
            'sla_cumplido:boolean',
            'ip_origen',
            'sistema_afectado',
            'acciones_tomadas:ntext',
            'notas_internas:ntext',
            'visible_cliente:boolean',
        ],
    ]) ?>

</div>
