<?php

$this->title = 'Cuadro de Mando Ejecutivo';
$this->params['breadcrumbs'][] = $this->title;

// Convertir datos PHP a JSON para JS
$jsonLabelsCanales = json_encode($labelsCanales);
$jsonValuesCanales = json_encode($valuesCanales);
$jsonLabelsClientes = json_encode($labelsTopClientes);
$jsonValuesClientes = json_encode($valuesTopClientes);
$jsonLabelsOnline = json_encode($labelsTopOnline);
$jsonValuesOnline = json_encode($valuesTopOnline);
$jsonLabelsHoras = json_encode($labelsHoras);
$jsonValuesHoras = json_encode($valuesHoras);
?>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="manager-dashboard">
    <h1 class="mb-4"><i class="fas fa-chart-line"></i> Panel de Negocio y Operaciones</h1>

    <!-- ROW 1: FINANCIAL METRICS -->
    <h5 class="mb-3 text-muted border-bottom pb-2">Métricas Financieras Globales</h5>
    <div class="row mb-4">
        <!-- Ingresos Reales -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Ingresos Brutos Reales</h5>
                    <h2 class="display-6" id="kpi-ingresos"><?= number_format($ingresosReales, 0, ',', '.') ?> €</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <small>Facturado (Total)</small>
                </div>
            </div>
        </div>

        <!-- Pipeline -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Pipeline (Previsión)</h5>
                    <h2 class="display-6" id="kpi-pipeline"><?= number_format($pipelineValue, 0, ',', '.') ?> €</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <small>Pendiente de Pago / En Revisión</small>
                </div>
            </div>
        </div>

        <!-- Valor Medio -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Valor Medio Contrato</h5>
                    <h2 class="display-6" id="kpi-ticket"><?= number_format($valorMedioContrato, 0, ',', '.') ?> €</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <small>Promedio Global</small>
                </div>
            </div>
        </div>
    </div>

    <!-- ROW 2: ONLINE ANALYTICS (TARJETA) -->
    <h5 class="mb-3 text-muted border-bottom pb-2">Analítica Agilidad Online (Tarjeta)</h5>
    <div class="row mb-4">
        <!-- Liquidez Inmediata -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Disponibilidad de Caja</h5>
                    <h2 class="display-6" id="kpi-liquidez"><?= number_format($ingresosTarjeta, 0, ',', '.') ?> €</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <small class="text-white"><i class="fas fa-check-circle"></i> Liquidez Inmediata (Cobrado)</small>
                </div>
            </div>
        </div>

        <!-- Ahorro Costes -->
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success bg-opacity-75 text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Ahorro Costes Operativos</h5>
                    <h2 class="display-6" id="kpi-ahorro"><?= number_format($ahorroCostes, 0, ',', '.') ?> €</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <small>Ahorrado en gestión manual (Estimado)</small>
                </div>
            </div>
        </div>

         <!-- Ticket Medio Online -->
         <div class="col-xl-4 col-md-6">
            <div class="card bg-primary bg-opacity-75 text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Ticket Medio Online</h5>
                    <h2 class="display-6" id="kpi-ticket-online"><?= number_format($ticketMedioOnline, 0, ',', '.') ?> €</h2>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <small>Gasto promedio por impulso</small>
                </div>
            </div>
        </div>
    </div>

    <!-- ROW 3: CHARTS GLOBAL -->
    <div class="row">
         <!-- RENDIMIENTO POR CANAL -->
         <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-wallet me-1"></i>
                    Rendimiento por Canal de Pago
                </div>
                <div class="card-body">
                    <canvas id="chartCanales" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        
        <!-- VENTAS POR HORA -->
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-clock me-1"></i>
                    Ventas Online por Franja Horaria
                </div>
                <div class="card-body">
                    <canvas id="chartHoras" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>

     <!-- ROW 4: CHARTS TOP -->
     <div class="row">
         <!-- TOP PRODUCTOS ONLINE -->
         <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-shopping-cart me-1"></i>
                    Efectividad Producto (Venta Impulso)
                </div>
                <div class="card-body">
                    <canvas id="chartTopOnline" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>

        <!-- VOLUMEN INCIDENCIAS POR CLIENTE -->
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-users-cog me-1"></i>
                    Top Clientes x Volumen de Incidencias
                    <span class="badge bg-secondary float-end" id="last-updated">Actualizado: Ahora</span>
                </div>
                <div class="card-body">
                    <canvas id="chartClientes" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Configuración Común
    Chart.defaults.font.family = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.color = '#292b2c';

    // 1. Chart Canales (Pie/Doughnut)
    var ctxCanales = document.getElementById("chartCanales");
    var chartCanales = new Chart(ctxCanales, {
        type: 'doughnut',
        data: {
            labels: <?= $jsonLabelsCanales ?>,
            datasets: [{
                data: <?= $jsonValuesCanales ?>,
                backgroundColor: ['#007bff', '#28a745'], // Azul (Tarjeta), Verde (Transferencia)
            }],
        },
    });

    // 2. Chart Clientes (Bar Horizontal)
    var ctxClientes = document.getElementById("chartClientes");
    var chartClientes = new Chart(ctxClientes, {
        type: 'bar',
        data: {
            labels: <?= $jsonLabelsClientes ?>,
            datasets: [{
                label: "Incidencias Reportadas",
                backgroundColor: "rgba(220,53,69,0.8)",
                borderColor: "rgba(220,53,69,1)",
                data: <?= $jsonValuesClientes ?>,
            }],
        },
        options: {
            indexAxis: 'y',
            scales: { x: { ticks: { beginAtZero: true } } },
            plugins: { legend: { display: false } }
        }
    });

    // 3. Chart Horas (Line)
    var ctxHoras = document.getElementById("chartHoras");
    var chartHoras = new Chart(ctxHoras, {
        type: 'line',
        data: {
            labels: <?= $jsonLabelsHoras ?>,
            datasets: [{
                label: "Ventas Online",
                backgroundColor: "rgba(255,193,7,0.2)",
                borderColor: "rgba(255,193,7,1)",
                data: <?= $jsonValuesHoras ?>,
                fill: true,
                tension: 0.4
            }],
        },
        options: {
            scales: { y: { ticks: { beginAtZero: true, stepSize: 1 } } },
            plugins: { legend: { display: false } }
        }
    });

    // 4. Chart Top Online (Bar Vertical)
    var ctxTopOnline = document.getElementById("chartTopOnline");
    var chartTopOnline = new Chart(ctxTopOnline, {
        type: 'bar',
        data: {
            labels: <?= $jsonLabelsOnline ?>,
            datasets: [{
                label: "Unidades Vendidas",
                backgroundColor: "rgba(23,162,184,0.8)",
                borderColor: "rgba(23,162,184,1)",
                data: <?= $jsonValuesOnline ?>,
            }],
        },
        options: {
            scales: { y: { ticks: { beginAtZero: true, stepSize: 1 } } },
            plugins: { legend: { display: false } }
        }
    });

    // --- AUTO ALIVE UPDATE ---
    const updateDashboard = async () => {
        try {
            const response = await fetch('<?= \yii\helpers\Url::to(['manager/get-stats'], true) ?>');
            
            if (!response.ok) {
                console.error("HTTP error " + response.status);
                return;
            }
            
            const data = await response.json();

            // 1. Update KPIs
            document.getElementById('kpi-ingresos').innerText = data.kpis.ingresosReales;
            document.getElementById('kpi-pipeline').innerText = data.kpis.pipelineValue;
            document.getElementById('kpi-ticket').innerText = data.kpis.valorMedio;
            
            if(document.getElementById('kpi-liquidez')) document.getElementById('kpi-liquidez').innerText = data.kpis.ingresosTarjeta;
            if(document.getElementById('kpi-ahorro')) document.getElementById('kpi-ahorro').innerText = data.kpis.ahorroCostes;
            if(document.getElementById('kpi-ticket-online')) document.getElementById('kpi-ticket-online').innerText = data.kpis.ticketMedioOnline;

            
            // 2. Update Charts
            chartCanales.data.labels = data.charts.canales.labels;
            chartCanales.data.datasets[0].data = data.charts.canales.data;
            chartCanales.update();

            chartClientes.data.labels = data.charts.clientes.labels;
            chartClientes.data.datasets[0].data = data.charts.clientes.data;
            chartClientes.update();

            chartHoras.data.labels = data.charts.porHora.labels;
            chartHoras.data.datasets[0].data = data.charts.porHora.data;
            chartHoras.update();

            chartTopOnline.data.labels = data.charts.topOnline.labels;
            chartTopOnline.data.datasets[0].data = data.charts.topOnline.data;
            chartTopOnline.update();

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
