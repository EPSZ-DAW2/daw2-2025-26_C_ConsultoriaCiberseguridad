<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\IncidenciasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="incidencias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cliente_id') ?>

    <?= $form->field($model, 'analista_id') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'severidad') ?>

    <?php // echo $form->field($model, 'estado_incidencia') ?>

    <?php // echo $form->field($model, 'categoria_incidencia') ?>

    <?php // echo $form->field($model, 'fecha_reporte') ?>

    <?php // echo $form->field($model, 'fecha_asignacion') ?>

    <?php // echo $form->field($model, 'fecha_primera_respuesta') ?>

    <?php // echo $form->field($model, 'fecha_resolucion') ?>

    <?php // echo $form->field($model, 'tiempo_resolucion') ?>

    <?php // echo $form->field($model, 'sla_cumplido') ?>

    <?php // echo $form->field($model, 'ip_origen') ?>

    <?php // echo $form->field($model, 'sistema_afectado') ?>

    <?php // echo $form->field($model, 'acciones_tomadas') ?>

    <?php // echo $form->field($model, 'notas_internas') ?>

    <?php // echo $form->field($model, 'visible_cliente') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
