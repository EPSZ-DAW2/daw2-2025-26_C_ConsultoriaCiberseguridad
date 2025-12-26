<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Proyectos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="proyectos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cliente_id')->textInput() ?>

    <?= $form->field($model, 'servicio_id')->textInput() ?>

    <?= $form->field($model, 'consultor_id')->textInput() ?>

    <?= $form->field($model, 'auditor_id')->textInput() ?>

    <?= $form->field($model, 'fecha_inicio')->textInput() ?>

    <?= $form->field($model, 'fecha_fin_prevista')->textInput() ?>

    <?= $form->field($model, 'fecha_fin_real')->textInput() ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'Planificación' => 'Planificación', 'En curso' => 'En curso', 'En revisión' => 'En revisión', 'Finalizado' => 'Finalizado', 'Cancelado' => 'Cancelado', 'Suspendido' => 'Suspendido', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'presupuesto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notas_internas')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <?= $form->field($model, 'modificado_por')->textInput() ?>

    <?= $form->field($model, 'fecha_modificacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
