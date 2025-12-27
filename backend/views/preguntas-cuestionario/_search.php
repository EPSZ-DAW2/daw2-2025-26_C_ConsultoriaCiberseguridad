<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\PreguntasCuestionarioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="preguntas-cuestionario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'curso_id') ?>

    <?= $form->field($model, 'enunciado_pregunta') ?>

    <?= $form->field($model, 'opcion_a') ?>

    <?= $form->field($model, 'opcion_b') ?>

    <?php // echo $form->field($model, 'opcion_c') ?>

    <?php // echo $form->field($model, 'opcion_correcta') ?>

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
