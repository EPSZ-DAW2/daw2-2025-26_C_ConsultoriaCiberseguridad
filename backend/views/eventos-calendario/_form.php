<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use common\models\Proyectos;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\EventosCalendario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="eventos-calendario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    // Preparar lista de proyectos activos
    $proyectos = Proyectos::find()->all();
    $proyectosLista = ArrayHelper::map($proyectos, 'id', 'nombre');

    // Preparar lista de auditores usando RBAC
    $auditores = User::byRole(
        User::find()->where(['activo' => 1]),
        'auditor'
    )->all();
    $auditoresLista = ArrayHelper::map($auditores, 'id', function($user) {
        return $user->nombre . ' ' . $user->apellidos;
    });
    ?>

    <?= $form->field($model, 'proyecto_id')->dropDownList($proyectosLista, ['prompt' => 'Seleccionar proyecto']) ?>

    <?= $form->field($model, 'auditor_id')->dropDownList($auditoresLista, ['prompt' => 'Seleccionar auditor']) ?>

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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
