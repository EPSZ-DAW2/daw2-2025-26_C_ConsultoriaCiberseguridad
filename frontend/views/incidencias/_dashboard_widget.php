<?php
/** @var common\models\Incidencias[] $incidencias */

// Cálculo del Estado de Salud
$score = 100;
$activeIncidents = 0;
foreach ($incidencias as $inc) {
    if (!in_array($inc->estado_incidencia, ['Resuelto', 'Cerrado', 'Falso Positivo'])) {
        $activeIncidents++;
        switch ($inc->severidad) {
            case 'Crítica': $score -= 30; break;
            case 'Alta': $score -= 15; break;
            case 'Media': $score -= 5; break;
            case 'Baja': $score -= 1; break;
        }
    }
}
$score = max(0, $score); // No bajar de 0

// Color del gráfico según score
$chartColor = '#4caf50'; // Green
if ($score < 80) $chartColor = '#ff9800'; // Orange
if ($score < 50) $chartColor = '#f44336'; // Red

?>

<div class="row mb-5">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 text-center py-4 bg-white rounded-3">
            <h5 class="text-muted mb-3">Estado de Seguridad</h5>
            <div class="position-relative d-inline-block">
                <!-- Simple CSS Circular Chart -->
                <svg viewBox="0 0 36 36" class="circular-chart" style="max-width: 150px;">
                    <path class="circle-bg"
                        d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                        fill="none" stroke="#eee" stroke-width="3.8"
                    />
                    <path class="circle"
                        stroke-dasharray="<?= $score ?>, 100"
                        d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                        fill="none" stroke="<?= $chartColor ?>" stroke-width="3.8" style="transition: stroke-dasharray 1s ease;"
                    />
                    <text x="18" y="20.35" class="percentage" text-anchor="middle" fill="#555" font-family="sans-serif" font-weight="bold" font-size="0.5em"><?= $score ?>%</text>
                </svg>
            </div>
            <div class="mt-3">
                <span class="badge bg-light text-dark border"><?= $activeIncidents ?> incidencias activas</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100 bg-white rounded-3 p-4">
            <h4 class="fw-bold text-primary mb-3">Centro de Ayuda y Soporte</h4>
            <p class="text-muted">Si detecta cualquier anomalía o necesita asistencia urgente, su equipo de seguridad está a un clic de distancia.</p>
            
            <div class="d-flex flex-wrap gap-3 mt-4">
                <?= \yii\helpers\Html::a('<i class="fas fa-life-ring me-2"></i>Solicitar Ayuda', ['create'], ['class' => 'btn btn-primary btn-lg px-4 rounded-pill shadow-sm']) ?>
                
                <?php if (Yii::$app->user->identity->rol === 'cliente_admin'): ?>
                    <?= \yii\helpers\Html::a('<i class="fas fa-users-cog me-2"></i>Administrar Usuarios', ['/site/usuarios'], ['class' => 'btn btn-outline-secondary btn-lg px-4 rounded-pill']) ?>
                <?php endif; ?>
            </div>
            
            <hr class="my-4">
            <div class="row text-center">
                <div class="col-4">
                    <h5 class="fw-bold mb-0 text-dark">24/7</h5>
                    <small class="text-muted">Monitorización</small>
                </div>
                <div class="col-4 border-start border-end">
                    <h5 class="fw-bold mb-0 text-dark">15m</h5>
                    <small class="text-muted">Tiempo Respuesta</small>
                </div>
                <div class="col-4">
                    <h5 class="fw-bold mb-0 text-dark">ISO</h5>
                    <small class="text-muted">Certificado 27001</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.circular-chart {
  display: block;
  margin: 10px auto;
  max-width: 80%;
  max-height: 250px;
}
.circle-bg {
  fill: none;
  stroke: #eee;
  stroke-width: 3.8;
}
.circle {
  fill: none;
  stroke-width: 2.8;
  stroke-linecap: round;
  animation: progress 1s ease-out forwards;
}
</style>
