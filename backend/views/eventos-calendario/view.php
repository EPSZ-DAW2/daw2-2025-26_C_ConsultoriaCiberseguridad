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



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'proyecto_id',
                'value' => function($model) {
                    return $model->proyecto ? $model->proyecto->nombre : '(Sin Proyecto)';
                }
            ],
            [
                'attribute' => 'auditor_id',
                'value' => function($model) {
                     // Asumiendo relación 'auditor' o buscar usuario
                     $auditor = \common\models\Usuarios::findOne($model->auditor_id);
                     return $auditor ? $auditor->nombre . ' ' . $auditor->apellidos : '-';
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
                    $u = \common\models\Usuarios::findOne($model->creado_por);
                    return $u ? $u->nombre . ' ' . $u->apellidos : $model->creado_por;
                }
            ],
            'fecha_creacion:datetime',
            [
                 'attribute' => 'modificado_por',
                 'value' => function($model) {
                     $u = \common\models\Usuarios::findOne($model->modificado_por);
                     return $u ? $u->nombre . ' ' . $u->apellidos : $model->modificado_por;
                 }
            ],
            'fecha_modificacion:datetime',
        ],
    ]) ?>

</div>
