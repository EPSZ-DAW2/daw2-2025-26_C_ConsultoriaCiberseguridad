<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ProyectosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="proyectos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'cliente_id') ?>

    <?= $form->field($model, 'servicio_id') ?>

    <?php // echo $form->field($model, 'consultor_id') ?>

    <?php // echo $form->field($model, 'auditor_id') ?>

    <?php // echo $form->field($model, 'fecha_inicio') ?>

    <?php // echo $form->field($model, 'fecha_fin_prevista') ?>

    <?php // echo $form->field($model, 'fecha_fin_real') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'presupuesto') ?>

    <?php // echo $form->field($model, 'notas_internas') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'fecha_creacion') ?>

    <?php // echo $form->field($model, 'modificado_por') ?>

    <?php // echo $form->field($model, 'fecha_modificacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
