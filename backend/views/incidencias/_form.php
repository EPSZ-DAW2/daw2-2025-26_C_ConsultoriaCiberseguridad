<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Incidencias $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="incidencias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        use common\models\Usuarios;
        use yii\helpers\ArrayHelper;
    ?>

    <?= $form->field($model, 'cliente_id')->dropDownList(
        ArrayHelper::map(Usuarios::find()->where(['rol' => Usuarios::ROL_CLIENTE_USER])->orderBy('nombre')->all(), 'id', function($model) {
            return $model->nombre . ' ' . $model->apellidos . ' (' . ($model->empresa ?? 'Sin Empresa') . ')';
        }),
        ['prompt' => 'Seleccione Cliente...']
    ) ?>

    <?= $form->field($model, 'analista_id')->dropDownList(
        ArrayHelper::map(Usuarios::find()->where(['rol' => 'analista_soc'])->orderBy('nombre')->all(), 'id', function($model) {
            return $model->nombre . ' ' . $model->apellidos;
        }),
        ['prompt' => 'Seleccione Analista...']
    ) ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'severidad')->dropDownList([ 'Crítica' => 'Crítica', 'Alta' => 'Alta', 'Media' => 'Media', 'Baja' => 'Baja', 'Informativa' => 'Informativa', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'estado_incidencia')->dropDownList([ 'Abierto' => 'Abierto', 'Asignado' => 'Asignado', 'En Análisis' => 'En Análisis', 'En Contención' => 'En Contención', 'En Remediación' => 'En Remediación', 'Resuelto' => 'Resuelto', 'Cerrado' => 'Cerrado', 'Falso Positivo' => 'Falso Positivo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'categoria_incidencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_reporte')->textInput(['type' => 'datetime-local']) ?>

    <?= $form->field($model, 'fecha_asignacion')->textInput(['type' => 'datetime-local']) ?>

    <?= $form->field($model, 'fecha_primera_respuesta')->textInput(['type' => 'datetime-local']) ?>

    <?= $form->field($model, 'fecha_resolucion')->textInput(['type' => 'datetime-local']) ?>

    <?= $form->field($model, 'tiempo_resolucion')->textInput() ?>

    <?= $form->field($model, 'sla_cumplido')->checkbox() ?>

    <?= $form->field($model, 'ip_origen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sistema_afectado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acciones_tomadas')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notas_internas')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'visible_cliente')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
