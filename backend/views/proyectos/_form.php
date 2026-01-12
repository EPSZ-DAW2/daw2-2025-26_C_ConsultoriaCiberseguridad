<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use common\models\Servicios;
use common\models\Proyectos;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Proyectos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="proyectos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    // Preparar listas de usuarios por rol (usando columna 'rol' para asegurar compatibilidad)
    $clientes = User::find()
        ->where(['activo' => 1])
        ->andWhere(['rol' => ['cliente_admin', 'cliente_user']])
        ->all();
    $clientesLista = ArrayHelper::map($clientes, 'id', function($user) {
        return $user->nombre . ' ' . $user->apellidos . ' (' . $user->empresa . ')';
    });

    $consultores = User::byRole(
        User::find()->where(['activo' => 1]),
        'consultor'
    )->all();
    $consultoresLista = ArrayHelper::map($consultores, 'id', function($user) {
        return $user->nombre . ' ' . $user->apellidos;
    });

    $auditores = User::byRole(
        User::find()->where(['activo' => 1]),
        'auditor'
    )->all();
    $auditoresLista = ArrayHelper::map($auditores, 'id', function($user) {
        return $user->nombre . ' ' . $user->apellidos;
    });

    // Preparar lista de servicios
    $servicios = Servicios::find()
        ->where(['activo' => 1])
        ->all();
    $serviciosLista = ArrayHelper::map($servicios, 'id', 'nombre');
    ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cliente_id')->dropDownList($clientesLista, ['prompt' => 'Seleccionar cliente']) ?>

    <?= $form->field($model, 'servicio_id')->dropDownList($serviciosLista, ['prompt' => 'Seleccionar servicio']) ?>

    <?= $form->field($model, 'consultor_id')->dropDownList($consultoresLista, ['prompt' => 'Seleccionar consultor']) ?>

    <?= $form->field($model, 'auditor_id')->dropDownList($auditoresLista, ['prompt' => 'Seleccionar auditor']) ?>

    <?= $form->field($model, 'fecha_inicio')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'fecha_fin_prevista')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'fecha_fin_real')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'estado')->dropDownList(
        Proyectos::optsEstado(),
        ['prompt' => 'Seleccione Estado...']
    ) ?>

    <?= $form->field($model, 'presupuesto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notas_internas')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
