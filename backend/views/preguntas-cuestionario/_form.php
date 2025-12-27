<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PreguntasCuestionario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="preguntas-cuestionario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'curso_id')->textInput() ?>

    <?= $form->field($model, 'enunciado_pregunta')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'opcion_a')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opcion_b')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opcion_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opcion_correcta')->dropDownList([ 'a' => 'A', 'b' => 'B', 'c' => 'C', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <?= $form->field($model, 'modificado_por')->textInput() ?>

    <?= $form->field($model, 'fecha_modificacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
