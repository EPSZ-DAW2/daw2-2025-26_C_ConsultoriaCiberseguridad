<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mis Empleados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-usuarios">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nuevo Empleado', ['create-user'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'apellidos',
            'email:email',
            'telefono',
            [
                'attribute' => 'activo',
                'value' => function($model) {
                    return $model->activo ? 'Sí' : 'No';
                }
            ],

            // En un futuro podrían editar, por ahora listado simple
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
