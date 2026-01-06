<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Incidencias $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="incidencias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cliente_id')->textInput() ?>

    <?= $form->field($model, 'analista_id')->textInput() ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'severidad')->dropDownList([ 'Crítica' => 'Crítica', 'Alta' => 'Alta', 'Media' => 'Media', 'Baja' => 'Baja', 'Informativa' => 'Informativa', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'estado_incidencia')->dropDownList([ 'Abierto' => 'Abierto', 'Asignado' => 'Asignado', 'En Análisis' => 'En Análisis', 'En Contención' => 'En Contención', 'En Remediación' => 'En Remediación', 'Resuelto' => 'Resuelto', 'Cerrado' => 'Cerrado', 'Falso Positivo' => 'Falso Positivo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'categoria_incidencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_reporte')->textInput() ?>

    <?= $form->field($model, 'fecha_asignacion')->textInput() ?>

    <?= $form->field($model, 'fecha_primera_respuesta')->textInput() ?>

    <?= $form->field($model, 'fecha_resolucion')->textInput() ?>

    <?= $form->field($model, 'tiempo_resolucion')->textInput() ?>

    <?= $form->field($model, 'sla_cumplido')->textInput() ?>

    <?= $form->field($model, 'ip_origen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sistema_afectado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acciones_tomadas')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notas_internas')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'visible_cliente')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
