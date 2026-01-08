<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Solicitud #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'CRM', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="crm-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Volver al listado', ['index'], ['class' => 'btn btn-secondary']) ?>
    </p>

    <div class="row">
        <!-- Información General -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Información General</h5>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'fecha_solicitud',
                                'format' => ['date', 'php:d/m/Y H:i:s'],
                            ],
                            [
                                'attribute' => 'origen_solicitud',
                                'value' => $model->origen_solicitud,
                            ],
                            [
                                'attribute' => 'estado_solicitud',
                                'format' => 'raw',
                                'value' => '<span class="badge bg-info">' . Html::encode($model->estado_solicitud) . '</span>',
                            ],
                            [
                                'attribute' => 'prioridad',
                                'value' => function ($model) {
                                    $prioridades = [1 => 'Baja', 2 => 'Media', 3 => 'Alta', 4 => 'Urgente'];
                                    return $prioridades[$model->prioridad] ?? $model->prioridad;
                                },
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>

        <!-- Datos de Contacto -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Datos de Contacto</h5>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'nombre_contacto',
                            'email_contacto:email',
                            'telefono_contacto',
                            'empresa',
                            'nif_cif',
                            'num_empleados',
                            'sector_actividad',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Servicio Solicitado -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Servicio Solicitado</h5>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute' => 'servicio_id',
                                'value' => $model->servicio ? $model->servicio->nombre : 'Sin servicio específico',
                            ],
                            [
                                'attribute' => 'descripcion_necesidad',
                                'format' => 'ntext',
                            ],
                            [
                                'attribute' => 'alcance_solicitado',
                                'format' => 'ntext',
                            ],
                            [
                                'attribute' => 'presupuesto_estimado',
                                'format' => ['currency', 'EUR'],
                            ],
                            [
                                'attribute' => 'fecha_inicio_deseada',
                                'format' => ['date', 'php:d/m/Y'],
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>

        <!-- Gestión Comercial -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-briefcase"></i> Gestión Comercial</h5>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute' => 'usuario_asignado_id',
                                'value' => $model->usuarioAsignado ? $model->usuarioAsignado->nombre . ' ' . $model->usuarioAsignado->apellidos : 'Sin asignar',
                            ],
                            [
                                'attribute' => 'fecha_contacto',
                                'format' => ['date', 'php:d/m/Y H:i'],
                            ],
                            [
                                'attribute' => 'notas_comerciales',
                                'format' => 'ntext',
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
