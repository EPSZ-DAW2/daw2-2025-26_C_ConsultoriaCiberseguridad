<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Cursos;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\PreguntasCuestionario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="preguntas-cuestionario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    // Preparar lista de cursos
    $cursos = Cursos::find()->all();
    $cursosLista = ArrayHelper::map($cursos, 'id', 'titulo');
    ?>

    <?= $form->field($model, 'curso_id')->dropDownList($cursosLista, ['prompt' => 'Seleccionar curso']) ?>

    <?= $form->field($model, 'enunciado_pregunta')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'opcion_a')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opcion_b')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opcion_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opcion_correcta')->dropDownList([ 'a' => 'A', 'b' => 'B', 'c' => 'C', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
