<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Usuarios;
use common\models\Servicios;
use common\models\Proyectos;

/** @var yii\web\View $this */
/** @var common\models\Proyectos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="proyectos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cliente_id')->dropDownList(
        ArrayHelper::map(Usuarios::find()->where(['rol' => Usuarios::ROL_CLIENTE_USER])->orderBy('nombre')->all(), 'id', function($model) {
            return $model->nombre . ' ' . $model->apellidos . ' (' . ($model->empresa ?? 'Sin Empresa') . ')';
        }),
        ['prompt' => 'Seleccione Cliente...']
    ) ?>

    <?= $form->field($model, 'servicio_id')->dropDownList(
        ArrayHelper::map(Servicios::find()->where(['activo' => 1])->orderBy('nombre')->all(), 'id', 'nombre'),
        ['prompt' => 'Seleccione Servicio...']
    ) ?>

    <?= $form->field($model, 'consultor_id')->dropDownList(
        ArrayHelper::map(Usuarios::find()->where(['rol' => Usuarios::ROL_CONSULTOR])->orderBy('nombre')->all(), 'id', function($model) {
            return $model->nombre . ' ' . $model->apellidos;
        }),
        ['prompt' => 'Seleccione Consultor (Opcional)...']
    ) ?>

    <?= $form->field($model, 'auditor_id')->dropDownList(
        ArrayHelper::map(Usuarios::find()->where(['rol' => Usuarios::ROL_AUDITOR])->orderBy('nombre')->all(), 'id', function($model) {
            return $model->nombre . ' ' . $model->apellidos;
        }),
        ['prompt' => 'Seleccione Auditor (Opcional)...']
    ) ?>

    <?= $form->field($model, 'fecha_inicio')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'fecha_fin_prevista')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'fecha_fin_real')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'estado')->dropDownList(
        Proyectos::optsEstado(),
        ['prompt' => 'Seleccione Estado...']
    ) ?>

    <?= $form->field($model, 'presupuesto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notas_internas')->textarea(['rows' => 6]) ?>

    <?php
        $internalUsers = ArrayHelper::map(
            Usuarios::find()->where(['!=', 'rol', Usuarios::ROL_CLIENTE_USER])->orderBy('nombre')->all(),
            'id', 
            function($model) { return $model->nombre . ' ' . $model->apellidos . ' (' . $model->rol . ')'; }
        );
    ?>

    <?= $form->field($model, 'creado_por')->dropDownList($internalUsers, ['prompt' => 'Seleccione Usuario...']) ?>

    <?= $form->field($model, 'fecha_creacion')->textInput([
        'type' => 'datetime-local',
        'value' => $model->fecha_creacion ? str_replace(' ', 'T', substr($model->fecha_creacion, 0, 16)) : '',
        'readonly' => !$model->isNewRecord
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
