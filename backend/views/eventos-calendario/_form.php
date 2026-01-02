<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EventosCalendario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="eventos-calendario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'proyecto_id')->textInput() ?>

    <?= $form->field($model, 'auditor_id')->textInput() ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'hora_inicio')->textInput() ?>

    <?= $form->field($model, 'hora_fin')->textInput() ?>

    <?= $form->field($model, 'tipo_evento')->dropDownList([ 'Auditoría Interna' => 'Auditoría Interna', 'Auditoría de Certificación' => 'Auditoría de Certificación', 'Auditoría de Seguimiento' => 'Auditoría de Seguimiento', 'Reunión Cliente' => 'Reunión Cliente', 'Revisión Documental' => 'Revisión Documental', 'Entrega Resultados' => 'Entrega Resultados', 'Otros' => 'Otros', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'ubicacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_evento')->dropDownList([ 'Programado' => 'Programado', 'Confirmado' => 'Confirmado', 'En curso' => 'En curso', 'Completado' => 'Completado', 'Pospuesto' => 'Pospuesto', 'Cancelado' => 'Cancelado', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'recordatorio_enviado')->textInput() ?>

    <?= $form->field($model, 'notas')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <?= $form->field($model, 'modificado_por')->textInput() ?>

    <?= $form->field($model, 'fecha_modificacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
