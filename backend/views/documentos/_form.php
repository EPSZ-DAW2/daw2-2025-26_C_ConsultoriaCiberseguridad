<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Proyectos;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Documentos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="documentos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'proyecto_id')->dropDownList(
        ArrayHelper::map(Proyectos::find()->all(), 'id', 'nombre'),
        ['prompt' => 'Selecciona un Proyecto...']
    ) ?>

    <?= $form->field($model, 'archivo_subido')->fileInput() ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tipo_documento')->dropDownList([
        'Política' => 'Política',
        'Procedimiento' => 'Procedimiento',
        'Informe de Auditoría' => 'Informe de Auditoría',
        'Informe SOC' => 'Informe SOC',
        'Plan de Acción' => 'Plan de Acción',
        'Certificado' => 'Certificado',
        'Documentación Técnica' => 'Documentación Técnica',
        'Otros' => 'Otros',
    ], ['prompt' => 'Selecciona Tipo...']) ?>

    <?= $form->field($model, 'version')->textInput(['maxlength' => true, 'value' => '1.0']) ?>
    
    <?= $form->field($model, 'notas')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Subir Documento', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>