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

    <?= $form->field($model, 'categoria')->dropDownList([ 'Gobernanza' => 'Gobernanza', 'Defensa' => 'Defensa', 'Auditoría' => 'Auditoría', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'precio_base')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duracion_estimada')->textInput() ?>

    <?= $form->field($model, 'requiere_auditoria')->textInput() ?>

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
