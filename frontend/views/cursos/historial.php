<?php

/** @var yii\web\View $this */
/** @var common\models\ProgresoUsuario[] $historial */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Mi Historial de Cursos';
?>
<div class="cursos-historial container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-white">
            <i class="fas fa-history text-info"></i> Mi Historial de Cursos
        </h1>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Volver a Cursos', ['index'], ['class' => 'btn btn-outline-light']) ?>
    </div>

    <?php if (empty($historial)): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            Aún no has completado ningún curso
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Servicio</th>
                        <th>Estado</th>
                        <th>Nota</th>
                        <th>Fecha Finalización</th>
                        <th>Acceso Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historial as $progreso): ?>
                        <tr>
                            <td>
                                <strong><?= Html::encode($progreso->curso->nombre) ?></strong>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    <?= Html::encode($progreso->curso->servicio->nombre ?? 'N/A') ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($progreso->isEstadoAprobado()): ?>
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle"></i> Aprobado
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-warning">
                                        <i class="fas fa-times-circle"></i> Suspenso
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= $progreso->nota_obtenida !== null ? number_format($progreso->nota_obtenida, 2) . '/10' : 'N/A' ?></strong>
                            </td>
                            <td>
                                <?= $progreso->fecha_fin ? Yii::$app->formatter->asDatetime($progreso->fecha_fin) : 'N/A' ?>
                            </td>
                            <td>
                                <?php if ($progreso->tieneAccesoActivo()): ?>
                                    <span class="badge bg-success">
                                        <i class="fas fa-unlock"></i> Activo
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger">
                                        <i class="fas fa-lock"></i> Expirado
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($progreso->tieneAccesoActivo()): ?>
                                    <?= Html::a('<i class="fas fa-eye"></i> Ver', ['ver', 'id' => $progreso->curso_id], ['class' => 'btn btn-sm btn-primary']) ?>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-secondary" disabled title="proyecto finalizado">
                                        <i class="fas fa-lock"></i> Bloqueado
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>

<style>
    body {
        background-color: #141414 !important;
        color: #fff;
    }
    .table-dark {
        --bs-table-bg: #1e1e1e;
        --bs-table-hover-bg: #2a2a2a;
    }
</style>
