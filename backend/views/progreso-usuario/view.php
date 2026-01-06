<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\ProgresoUsuario $model */

$this->title = $model->usuario->nombre . ' - ' . $model->curso->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Progreso Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="progreso-usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estás seguro de borrar este registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Alumno',
                'value' => $model->usuario->nombre,
            ],
            [
                'label' => 'Curso',
                'value' => $model->curso->nombre,
            ],
            'diapositiva_actual',
            'cuestionario_realizado:boolean',
            'nota_obtenida',
            'fecha_inicio',
            'fecha_fin',
            'estado',
        ],
    ]) ?>

</div>
