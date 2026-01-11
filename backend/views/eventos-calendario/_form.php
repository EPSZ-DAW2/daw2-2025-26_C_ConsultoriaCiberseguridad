<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Proyectos;
use common\models\Usuarios;

/** @var yii\web\View $this */
/** @var common\models\EventosCalendario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="eventos-calendario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'proyecto_id')->dropDownList(
        ArrayHelper::map(Proyectos::find()->orderBy('nombre')->all(), 'id', 'nombre'),
        ['prompt' => 'Seleccione un Proyecto...']
    ) ?>

    <?= $form->field($model, 'auditor_id')->dropDownList(
        ArrayHelper::map(Usuarios::find()->where(['rol' => 'auditor'])->orderBy('nombre')->all(), 'id', function($model) {
            return $model->nombre . ' ' . $model->apellidos;
        }),
        ['prompt' => 'Seleccione un Auditor...']
    ) ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'hora_inicio')->textInput(['type' => 'time']) ?>

    <?= $form->field($model, 'hora_fin')->textInput(['type' => 'time']) ?>

    <?= $form->field($model, 'tipo_evento')->dropDownList(
        \common\models\EventosCalendario::optsTipoEvento(),
        ['prompt' => 'Seleccione Tipo...']
    ) ?>

    <?= $form->field($model, 'ubicacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_evento')->dropDownList(
        \common\models\EventosCalendario::optsEstadoEvento(),
        ['prompt' => 'Seleccione Estado...']
    ) ?>

    <?= $form->field($model, 'recordatorio_enviado')->checkbox() ?>
    
    <?= $form->field($model, 'notas')->textarea(['rows' => 6]) ?>

    <?php
        // Lista de usuarios internos para Creado/Modificado
        $internalUsers = ArrayHelper::map(
            Usuarios::find()->orderBy('nombre')->all(),
            'id', 
            function($model) { return $model->nombre . ' ' . $model->apellidos; }
        );
    ?>

    <?= $form->field($model, 'creado_por')->dropDownList($internalUsers, [
        'prompt' => 'Seleccione Usuario...',
        'disabled' => true // Generalmente no editable manualmente
    ]) ?>

    <?= $form->field($model, 'fecha_creacion')->textInput([
         'type' => 'datetime-local',
         'value' => $model->fecha_creacion ? str_replace(' ', 'T', substr($model->fecha_creacion, 0, 16)) : '',
         'readonly' => true
    ]) ?>

    <?= $form->field($model, 'modificado_por')->dropDownList($internalUsers, [
        'prompt' => 'Seleccione Usuario...',
        'disabled' => true
    ]) ?>

    <?= $form->field($model, 'fecha_modificacion')->textInput([
         'type' => 'datetime-local',
         'value' => $model->fecha_modificacion ? str_replace(' ', 'T', substr($model->fecha_modificacion, 0, 16)) : '',
         'readonly' => true
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
