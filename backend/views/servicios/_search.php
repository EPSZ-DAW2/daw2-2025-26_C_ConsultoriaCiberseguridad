<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ServiciosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="servicios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'categoria') ?>

    <?= $form->field($model, 'precio_base') ?>

    <?php // echo $form->field($model, 'duracion_estimada') ?>

    <?php // echo $form->field($model, 'requiere_auditoria') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'fecha_creacion') ?>

    <?php // echo $form->field($model, 'modificado_por') ?>

    <?php // echo $form->field($model, 'fecha_modificacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
