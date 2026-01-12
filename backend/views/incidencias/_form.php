<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Incidencias $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="incidencias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    <?php
    // Preparar listas de usuarios por rol (usando columna 'rol' para asegurar compatibilidad)
    $clientes = User::find()
        ->where(['activo' => 1])
        ->andWhere(['rol' => ['cliente_admin', 'cliente_user']])
        ->orderBy('nombre')
        ->all();
        
    $clientesLista = ArrayHelper::map($clientes, 'id', function($user) {
        return $user->nombre . ' ' . $user->apellidos . ' (' . ($user->empresa ?? '-') . ')';
    });

    $analistas = User::find()
        ->where(['activo' => 1])
        ->andWhere(['rol' => 'analista_soc'])
        ->orderBy('nombre')
        ->all();
        
    $analistasLista = ArrayHelper::map($analistas, 'id', function($user) {
        return $user->nombre . ' ' . $user->apellidos;
    });
    ?>

    <?= $form->field($model, 'cliente_id')->dropDownList($clientesLista, ['prompt' => 'Seleccione Cliente...']) ?>

    <?= $form->field($model, 'analista_id')->dropDownList($analistasLista, ['prompt' => 'Seleccione Analista...']) ?>

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
