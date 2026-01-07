<?php
use yii\helpers\Html;

$this->title = 'Monitorización SOC 24/7';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="monitorizacion-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-warning">
        <i class="fas fa-shield-alt"></i>
        <strong>Módulo en desarrollo</strong><br>
        Panel de monitorización en tiempo real para el Security Operations Center.
        <br><br>
        <strong>Acceso:</strong> Analista SOC y Admin
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Funcionalidades futuras:</h5>
                    <ul>
                        <li>Dashboard de eventos en tiempo real</li>
                        <li>Alertas de seguridad automatizadas</li>
                        <li>Métricas de SIEM (Security Information and Event Management)</li>
                        <li>Logs de auditoría y análisis de amenazas</li>
                        <li>Gráficas de tráfico y anomalías detectadas</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">Estado del sistema:</h5>
                    <p class="text-success"><i class="fas fa-check-circle"></i> Todos los sistemas operativos</p>
                    <hr>
                    <small class="text-muted">Última actualización: <?= date('d/m/Y H:i:s') ?></small>
                </div>
            </div>
        </div>
    </div>
</div>
