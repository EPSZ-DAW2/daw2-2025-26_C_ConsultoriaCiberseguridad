<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Servicios;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Cursos $model */

$this->title = 'Wizard de Creación de Curso - Paso 1';
?>
<div class="cursos-wizard-step1">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- indicador de progreso -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5><i class="fas fa-check-circle"></i> Paso 1: Datos Básicos</h5>
                    <small>Activo</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary text-white">
                <div class="card-body text-center">
                    <h5><i class="fas fa-circle"></i> Paso 2: Diapositivas</h5>
                    <small>Pendiente</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary text-white">
                <div class="card-body text-center">
                    <h5><i class="fas fa-circle"></i> Paso 3: Preguntas</h5>
                    <small>Pendiente</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'descripcion')->textarea(['rows' => 4]) ?>

            <?php
            // obtener servicios de formacion
            $serviciosFormacion = Servicios::find()
                ->where(['categoria' => Servicios::CATEGORIA_FORMACION])
                ->andWhere(['activo' => 1])
                ->all();

            $serviciosList = ArrayHelper::map($serviciosFormacion, 'id', 'nombre');
            ?>

            <?= $form->field($model, 'servicio_id')->dropDownList($serviciosList, [
                'prompt' => 'Selecciona un servicio de formación...'
            ]) ?>

            <?= $form->field($model, 'video_url')->textInput(['maxlength' => true, 'placeholder' => 'https://www.youtube.com/watch?v=...']) ?>

            <?= $form->field($model, 'imagen_portada')->textInput(['maxlength' => true, 'placeholder' => 'https://...']) ?>

            <?= $form->field($model, 'nota_minima_aprobado')->input('number', [
                'step' => '0.01',
                'min' => 0,
                'max' => 10,
                'value' => $model->isNewRecord ? 5.00 : $model->nota_minima_aprobado
            ]) ?>

            <?= $form->field($model, 'activo')->dropDownList([
                1 => 'Sí',
                0 => 'No'
            ]) ?>

            <div class="form-group mt-4">
                <?= Html::a('Cancelar', ['cancel-wizard'], [
                    'class' => 'btn btn-secondary',
                    'data-confirm' => '¿Seguro que quieres cancelar el wizard? Se perderán todos los datos.'
                ]) ?>

                <?= Html::submitButton('Siguiente: Añadir Diapositivas <i class="fas fa-arrow-right"></i>', [
                    'class' => 'btn btn-primary float-end'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
