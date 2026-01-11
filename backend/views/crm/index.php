<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\SolicitudesPresupuesto;

$this->title = 'CRM - Solicitudes de Presupuesto';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="crm-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-muted">
        Gestión de solicitudes comerciales y oportunidades de venta
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped table-bordered'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'fecha_solicitud',
                'format' => ['date', 'php:d/m/Y H:i'],
                'label' => 'Fecha',
            ],
            'nombre_contacto',
            'email_contacto:email',
            'empresa',
            [
                'attribute' => 'servicio_id',
                'value' => function ($model) {
                    return $model->servicio ? $model->servicio->nombre : 'Sin servicio';
                },
                'label' => 'Servicio',
            ],
            [
                'attribute' => 'estado_solicitud',
                'value' => function ($model) {
                    $badges = [
                        SolicitudesPresupuesto::ESTADO_SOLICITUD_PENDIENTE => 'secondary',
                        SolicitudesPresupuesto::ESTADO_SOLICITUD_EN_REVISION => 'info',
                        SolicitudesPresupuesto::ESTADO_SOLICITUD_CONTACTADO => 'primary',
                        SolicitudesPresupuesto::ESTADO_SOLICITUD_PRESUPUESTO_ENVIADO => 'warning',
                        SolicitudesPresupuesto::ESTADO_SOLICITUD_NEGOCIACION => 'warning',
                        SolicitudesPresupuesto::ESTADO_SOLICITUD_CONTRATADO => 'success',
                        SolicitudesPresupuesto::ESTADO_SOLICITUD_RECHAZADO => 'danger',
                        SolicitudesPresupuesto::ESTADO_SOLICITUD_CANCELADO => 'dark',
                    ];
                    $badge = $badges[$model->estado_solicitud] ?? 'secondary';
                    return '<span class="badge bg-' . $badge . '">' . Html::encode($model->estado_solicitud) . '</span>';
                },
                'format' => 'raw',
                'label' => 'Estado',
            ],
            [
                'attribute' => 'prioridad',
                'value' => function ($model) {
                    $prioridades = [
                        1 => '<span class="badge bg-secondary">Baja</span>',
                        2 => '<span class="badge bg-info">Media</span>',
                        3 => '<span class="badge bg-warning">Alta</span>',
                        4 => '<span class="badge bg-danger">Urgente</span>',
                    ];
                    return $prioridades[$model->prioridad] ?? $model->prioridad;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'usuario_asignado_id',
                'value' => function ($model) {
                    return $model->usuarioAsignado ? $model->usuarioAsignado->nombre : '<em class="text-muted">Sin asignar</em>';
                },
                'format' => 'raw',
                'label' => 'Asignado a',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-eye"></i> Ver', $url, [
                            'title' => 'Ver detalles',
                            'class' => 'btn btn-sm btn-primary',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
