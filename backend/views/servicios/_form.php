<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Servicios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="servicios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'categoria')->dropDownList([ 
        'Gobernanza' => 'Gobernanza', 
        'Defensa' => 'Defensa', 
        'Auditoría' => 'Auditoría', 
        'Formación' => 'Formación', 
    ], ['prompt' => 'Seleccione una categoría...']) ?>

    <?= $form->field($model, 'precio_base')->textInput(['type' => 'number', 'step' => '0.01']) ?>

    <?= $form->field($model, 'duracion_estimada')->textInput(['placeholder' => 'Ej: 10 horas']) ?>

    <?= $form->field($model, 'requiere_auditoria')->checkbox() ?>

    <?= $form->field($model, 'activo')->dropDownList([1 => 'Sí', 0 => 'No']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar Servicio', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>