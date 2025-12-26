<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Cursos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cursos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imagen_portada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nota_minima_aprobado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <?= $form->field($model, 'modificado_por')->textInput() ?>

    <?= $form->field($model, 'fecha_modificacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
