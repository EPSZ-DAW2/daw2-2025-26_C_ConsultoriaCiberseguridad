<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EventosCalendario */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Calendario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="eventos-calendario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'id',
                    [
                        'attribute' => 'proyecto_id',
                        'value' => function($model) {
                            return $model->proyecto ? $model->proyecto->nombre : '(Sin Proyecto)';
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
                    [
                        'attribute' => 'tipo_evento',
                        'value' => function($model) {
                             return ucfirst($model->tipo_evento);
                        }
                    ]
                ],
            ]) ?>
        </div>
    </div>
    
    <p class="mt-3">
        <?= Html::a('Volver al Calendario', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
