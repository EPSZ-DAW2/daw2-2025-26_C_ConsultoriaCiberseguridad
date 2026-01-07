<?php
use yii\helpers\Html;

$this->title = 'Rentabilidad y Métricas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="rentabilidad-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-info">
        <i class="fas fa-chart-line"></i>
        <strong>Módulo en desarrollo</strong><br>
        Panel de análisis financiero y métricas de rentabilidad de la empresa.
        <br><br>
        <strong>Acceso:</strong> Manager y Admin
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Funcionalidades futuras:</h5>
                    <ul>
                        <li>Métricas financieras por proyecto</li>
                        <li>Análisis de rentabilidad y margen de beneficio</li>
                        <li>KPIs de negocio (ROI, tiempo medio de proyecto, etc.)</li>
                        <li>Reportes de facturación mensual/trimestral</li>
                        <li>Comparativas por cliente y tipo de servicio</li>
                        <li>Predicciones de ingresos y gastos</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">Resumen financiero:</h5>
                    <p class="text-muted"><i class="fas fa-info-circle"></i> No hay datos disponibles</p>
                    <hr>
                    <small class="text-muted">Última actualización: <?= date('d/m/Y H:i:s') ?></small>
                </div>
            </div>
        </div>
    </div>
</div>
