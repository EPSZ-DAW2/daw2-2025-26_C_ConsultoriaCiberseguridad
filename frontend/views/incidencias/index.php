<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Incidencias[] $incidencias */

$this->title = 'Mis Incidencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidencias-index">

    <!-- Dashboard Widget -->
    <?= $this->render('_dashboard_widget', ['incidencias' => $incidencias]) ?>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-bottom-0 py-3">
            <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-list-ul me-2"></i>Historial de Incidencias</h5>
        </div>
        <div class="card-body p-0">
            <?php if (empty($incidencias)): ?>
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                    <p class="mb-0">Todo limpio. No hay incidencias registradas.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary">
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Título</th>
                                <th>Estado</th>
                                <th>Fecha Reporte</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($incidencias as $incidencia): ?>
                                <tr>
                                    <td class="ps-4 text-muted">#<?= $incidencia->id ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= Html::encode($incidencia->titulo) ?></div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-<?= $incidencia->estado_incidencia == 'Resuelto' ? 'success' : ($incidencia->estado_incidencia == 'Abierto' ? 'danger' : 'primary') ?> fw-normal px-3">
                                            <?= Html::encode($incidencia->estado_incidencia) ?>
                                        </span>
                                    </td>
                                    <td class="text-muted">
                                        <?= Yii::$app->formatter->asDate($incidencia->fecha_reporte, 'medium') ?>
                                    </td>
                                    <td>
                                        <?= Html::a('Ver Detalles', ['view', 'id' => $incidencia->id], ['class' => 'btn btn-sm btn-outline-primary rounded-pill px-3']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

<style>
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

/* animación de parpadeo para prioridad crítica */
@keyframes parpadeo {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
}

.prioridad-critica {
    animation: parpadeo 1.5s ease-in-out infinite;
    font-weight: bold;
}
</style>
