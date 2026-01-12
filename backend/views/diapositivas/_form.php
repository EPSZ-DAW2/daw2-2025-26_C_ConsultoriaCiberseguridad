<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Cursos;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Diapositivas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="diapositivas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    // Preparar lista de cursos
    $cursos = Cursos::find()->all();
    $cursosLista = ArrayHelper::map($cursos, 'id', 'titulo');
    ?>

    <?= $form->field($model, 'curso_id')->dropDownList($cursosLista, ['prompt' => 'Seleccionar curso']) ?>

    <?= $form->field($model, 'numero_orden')->textInput() ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contenido_html')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imagen_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
