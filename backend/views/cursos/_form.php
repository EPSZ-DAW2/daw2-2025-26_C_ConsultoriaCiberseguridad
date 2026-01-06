<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Servicios;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Cursos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cursos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'video_url')->textInput(['placeholder' => 'Ej: https://www.youtube.com/embed/...']) ?>

    <?php 
        // Esto crea un desplegable con los servicios que existen
        $servicios = ArrayHelper::map(Servicios::find()->all(), 'id', 'nombre');
    ?>
    <?= $form->field($model, 'servicio_id')->dropDownList($servicios, ['prompt' => 'Selecciona el Servicio...']) ?>

    <?php if ($model->hasAttribute('activo')): ?>
        <?= $form->field($model, 'activo')->dropDownList([1 => 'Sí', 0 => 'No']) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar Curso', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>