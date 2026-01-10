<?php

$this->title = 'Cuadro de Mando Ejecutivo';
$this->params['breadcrumbs'][] = $this->title;

// Convertir datos PHP a JSON para JS
$jsonLabelsIngresos = json_encode($labelsIngresos);
$jsonValuesIngresos = json_encode($valuesIngresos);
$jsonLabelsCriticidad = json_encode($labelsCriticidad);
$jsonValuesCriticidad = json_encode($valuesCriticidad);

?>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="manager-dashboard">
    <h1 class="mb-4"><i class="fas fa-chart-line"></i> Panel de Negocio y Operaciones</h1>

    <!-- ROW 1: KPI CARDS -->
    <div class="row mb-4">
        <!-- Ingresos Totales -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Ingresos Activos</h5>
                    <h2 class="display-6" id="kpi-ingresos"><?= number_format($totalIngresos, 0, ',', '.') ?> €</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <small>Total presupuestado</small>
                </div>
            </div>
        </div>

        <!-- Beneficio Neto -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Margen Neto (Est.)</h5>
                    <h2 class="display-6" id="kpi-beneficio"><?= number_format($beneficioNeto, 0, ',', '.') ?> €</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <small>Ingresos - Costes Operativos</small>
                </div>
            </div>
        </div>

        <!-- MTTR -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-dark mb-4">
                <div class="card-body">
                    <h5 class="card-title">MTTR (Respuesta)</h5>
                    <h2 class="display-6" id="kpi-mttr"><?= $mttr ?> h</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <small>Tiempo medio de resolución</small>
                </div>
            </div>
        </div>

        <!-- Churn Rate -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Churn Rate</h5>
                    <h2 class="display-6" id="kpi-churn"><?= $churnRate ?>%</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <small>% Proyectos Cancelados</small>
                </div>
            </div>
        </div>
    </div>

    <!-- ROW 2: CHARTS -->
    <div class="row">
        <!-- INGRESOS POR SERVICIO -->
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Ingresos por Producto
                    <span class="badge bg-secondary float-end" id="last-updated">Actualizado: Ahora</span>
                </div>
                <div class="card-body">
                    <canvas id="chartIngresos" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>

        <!-- DISTRIBUCIÓN CRITICIDAD -->
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Distribución de Amenazas (SOC)
                </div>
                <div class="card-body">
                    <canvas id="chartCriticidad" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Configuración Común
    Chart.defaults.font.family = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.color = '#292b2c';

    // 1. Chart Ingresos (Bar)
    var ctxIngresos = document.getElementById("chartIngresos");
    var chartIngresos = new Chart(ctxIngresos, {
        type: 'bar',
        data: {
            labels: <?= $jsonLabelsIngresos ?>,
            datasets: [{
                label: "Ingresos (€)",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: <?= $jsonValuesIngresos ?>,
            }],
        },
        options: {
            scales: {
                x: { grid: { display: false } },
                y: { ticks: { beginAtZero: true } }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

    // 2. Chart Criticidad (Pie)
    var ctxCriticidad = document.getElementById("chartCriticidad");
    var chartCriticidad = new Chart(ctxCriticidad, {
        type: 'doughnut',
        data: {
            labels: <?= $jsonLabelsCriticidad ?>,
            datasets: [{
                data: <?= $jsonValuesCriticidad ?>,
                backgroundColor: ['#dc3545', '#ffc107', '#28a745', '#17a2b8'], // Rojo, Amarillo, Verde, Azul
            }],
        },
    });

    // --- AUTO ALIVE UPDATE ---
    const updateDashboard = async () => {
        try {
            // Usamos URL absoluta para evitar errores de ruta relativa
            const response = await fetch('<?= \yii\helpers\Url::to(['manager/get-stats'], true) ?>');
            
            if (!response.ok) {
                console.error("HTTP error " + response.status);
                return;
            }
            
            const data = await response.json();

            // 1. Update KPIs
            document.getElementById('kpi-ingresos').innerText = data.kpis.totalIngresos;
            document.getElementById('kpi-beneficio').innerText = data.kpis.beneficioNeto;
            document.getElementById('kpi-mttr').innerText = data.kpis.mttr;
            document.getElementById('kpi-churn').innerText = data.kpis.churnRate;

            // 2. Update Charts
            // Ingresos
            chartIngresos.data.labels = data.charts.ingresos.labels;
            chartIngresos.data.datasets[0].data = data.charts.ingresos.data;
            chartIngresos.update();

            // Criticidad
            chartCriticidad.data.labels = data.charts.criticidad.labels;
            chartCriticidad.data.datasets[0].data = data.charts.criticidad.data;
            chartCriticidad.update();

            // Badge
            const now = new Date();
            document.getElementById('last-updated').innerText = 'Actualizado: ' + now.toLocaleTimeString();

        } catch (error) {
            console.error('Error fetching dashboard stats:', error);
        }
    };

    // Update every 5 seconds
    setInterval(updateDashboard, 5000);
</script>
