<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\SolicitudesPresupuesto;
use common\models\User;
use yii\helpers\ArrayHelper;

$this->title = 'Editar Solicitud #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'CRM', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Solicitud #' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>

<div class="crm-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col-md-6">
                    <h5 class="text-primary mb-3"><i class="fas fa-tasks"></i> Estado y Gestión</h5>

                    <?= $form->field($model, 'estado_solicitud')->dropDownList(
                        SolicitudesPresupuesto::optsEstadoSolicitud(),
                        ['prompt' => 'Seleccionar estado']
                    ) ?>

                    <?= $form->field($model, 'prioridad')->dropDownList([
                        1 => 'Baja',
                        2 => 'Media',
                        3 => 'Alta',
                        4 => 'Urgente',
                    ], ['prompt' => 'Seleccionar prioridad']) ?>

                    <?php
                    // Obtener usuarios comerciales y admins usando RBAC
                    $usuarios = User::byRole(
                        User::find()->where(['activo' => 1]),
                        ['comercial', 'admin', 'manager']
                    )->all();
                    $usuariosLista = ArrayHelper::map($usuarios, 'id', function($user) {
                        return $user->nombre . ' ' . $user->apellidos . ' (' . $user->getRoleName() . ')';
                    });
                    ?>

                    <?= $form->field($model, 'usuario_asignado_id')->dropDownList(
                        $usuariosLista,
                        ['prompt' => 'Sin asignar']
                    ) ?>

                    <?= $form->field($model, 'fecha_contacto')->input('datetime-local', [
                        'value' => $model->fecha_contacto ? date('Y-m-d\TH:i', strtotime($model->fecha_contacto)) : '',
                    ]) ?>
                </div>

                <!-- Columna Derecha -->
                <div class="col-md-6">
                    <h5 class="text-success mb-3"><i class="fas fa-user-tie"></i> Datos del Cliente</h5>

                    <?= $form->field($model, 'nombre_contacto')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'email_contacto')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'telefono_contacto')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'empresa')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'num_empleados')->input('number') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h5 class="text-warning mb-3"><i class="fas fa-comment-dots"></i> Información Adicional</h5>

                    <?= $form->field($model, 'descripcion_necesidad')->textarea(['rows' => 4]) ?>

                    <?= $form->field($model, 'alcance_solicitado')->textarea(['rows' => 3]) ?>

                    <?= $form->field($model, 'presupuesto_estimado')->input('number', ['step' => '0.01']) ?>

                    <?= $form->field($model, 'fecha_inicio_deseada')->input('date') ?>

                    <?= $form->field($model, 'notas_comerciales')->textarea(['rows' => 4, 'placeholder' => 'Añade notas internas sobre el seguimiento comercial...']) ?>
                </div>
            </div>

            <div class="form-group mt-4">
                <?= Html::submitButton('<i class="fas fa-save"></i> Guardar Cambios', ['class' => 'btn btn-success btn-lg']) ?>
                <?= Html::a('Cancelar', ['view', 'id' => $model->id], ['class' => 'btn btn-secondary btn-lg']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
