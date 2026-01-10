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
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        
        <?= Html::a('⬇️ Descargar PDF', ['descargar', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'proyecto_id',
            'nombre_archivo',
            'descripcion:ntext',
            'ruta_archivo:ntext',
            'tipo_documento',
            'tamaño_bytes',
            'version',
            'visible_cliente',
            'hash_verificacion',
            'subido_por',
            'fecha_subida',
            'fecha_modificacion',
            'notas:ntext',
        ],
    ]) ?>

</div>
