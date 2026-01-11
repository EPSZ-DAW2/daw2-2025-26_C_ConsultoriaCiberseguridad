<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Documentos $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documentos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        
        <?= Html::a('⬇️ Descargar PDF', ['descargar', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

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
            'nombre_archivo',
            'descripcion:ntext',
            'ruta_archivo:ntext',
            'tipo_documento',
            'tamaño_bytes:shortSize',
            'version',
            'visible_cliente:boolean',
            'hash_verificacion',
            [
                'attribute' => 'subido_por',
                'value' => function($model) {
                    $u = \common\models\Usuarios::findOne($model->subido_por);
                    return $u ? $u->nombre . ' ' . $u->apellidos : $model->subido_por;
                }
            ],
            'fecha_subida:datetime',
            'fecha_modificacion:datetime',
            'notas:ntext',
        ],
    ]) ?>

</div>
