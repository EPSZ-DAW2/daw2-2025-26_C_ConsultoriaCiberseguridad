<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\DocumentosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="documentos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'proyecto_id') ?>

    <?= $form->field($model, 'nombre_archivo') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'ruta_archivo') ?>

    <?php // echo $form->field($model, 'tipo_documento') ?>

    <?php // echo $form->field($model, 'tamaño_bytes') ?>

    <?php // echo $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'visible_cliente') ?>

    <?php // echo $form->field($model, 'hash_verificacion') ?>

    <?php // echo $form->field($model, 'subido_por') ?>

    <?php // echo $form->field($model, 'fecha_subida') ?>

    <?php // echo $form->field($model, 'fecha_modificacion') ?>

    <?php // echo $form->field($model, 'notas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
