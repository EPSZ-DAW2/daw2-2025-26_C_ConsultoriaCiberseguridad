<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $logs common\models\LogDefender[] */
/* @var $vulnerabilidades array */

$this->title = 'Monitorización SOC - Vista de Radar';
?>

<style>
    /* Dark Mode Simulation for this specific view */
    .soc-console {
        background-color: #1a1a1a;
        color: #e0e0e0;
        font-family: 'Consolas', 'Courier New', monospace;
        padding: 20px;
        border-radius: 5px;
        min-height: 80vh;
    }
    .soc-header {
        border-bottom: 2px solid #00ff00;
        margin-bottom: 20px;
        padding-bottom: 10px;
    }
    .text-neon {
        color: #00ff00;
        text-shadow: 0 0 5px #00ff00;
    }
    .panel-dark {
        background-color: #2d2d2d;
        border: 1px solid #444;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    .table-dark-custom {
        width: 100%;
        color: #e0e0e0;
    }
    .table-dark-custom th {
        border-bottom: 1px solid #555;
        padding: 10px;
        color: #888;
    }
    .table-dark-custom td {
        border-bottom: 1px solid #333;
        padding: 10px;
    }
    .severity-Critica { color: #ff3333; font-weight: bold; }
    .severity-Alta { color: #ff9933; }
    .severity-Media { color: #ffcc00; }
    .severity-Baja { color: #33cc33; }
    
    .btn-convert {
        background-color: #005500;
        color: #00ff00;
        border: 1px solid #00ff00;
        padding: 5px 10px;
        text-decoration: none;
        font-size: 12px;
        transition: all 0.3s;
    }
    .btn-convert:hover {
        background-color: #00ff00;
        color: #000;
    }
    .radar-pulse {
        width: 10px;
        height: 10px;
        background-color: #00ff00;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 0 rgba(0, 255, 0, 1);
        animation: pulse-green 2s infinite;
        margin-right: 10px;
    }
    @keyframes pulse-green {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(0, 255, 0, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(0, 255, 0, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(0, 255, 0, 0); }
    }
</style>

<div class="soc-console">
    <div class="soc-header d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-neon"><span class="radar-pulse"></span>CENTRO DE OPERACIONES DE SEGURIDAD (SOC)</h1>
        <div>
            <span class="badge bg-danger">DEFCON 3</span>
            <span class="badge bg-secondary"><?= date('H:i:s') ?> UTC</span>
        </div>
    </div>

    <div class="row">
        <!-- Feed de Eventos -->
        <div class="col-md-8">
            <div class="panel-dark">
                <h4 class="text-white border-bottom border-secondary pb-2 mb-3"><i class="fas fa-shield-alt"></i> Feed de Alertas Defender</h4>
                
                <?php if (count($logs) > 0): ?>
                    <table class="table-dark-custom">
                        <thead>
                            <tr>
                                <th>Hora</th>
                                <th>Severidad</th>
                                <th>Evento</th>
                                <th>Origen</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($logs as $log): ?>
                                <tr>
                                    <td><?= Yii::$app->formatter->asTime($log->fecha) ?></td>
                                    <td class="severity-<?= $log->gravedad ?>"><?= $log->gravedad ?></td>
                                    <td>
                                        <div><?= Html::encode($log->evento) ?></div>
                                        <small class="text-muted"><?= Html::encode($log->sistema) ?></small>
                                    </td>
                                    <td><?= Html::encode($log->fuente) ?></td>
                                    <td>
                                        <?= Html::a('<i class="fas fa-exclamation-circle"></i> Convertir en Incidencia', 
                                            ['convertir-incidencia', 'id' => $log->id], 
                                            [
                                                'class' => 'btn-convert',
                                                'data' => [
                                                    'confirm' => '¿Estás seguro de escalar esta alerta a una Incidencia para el cliente?',
                                                    'method' => 'post',
                                                ],
                                            ]
                                        ) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted text-center py-5">No hay alertas activas en este momento.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Vulnerabilidades y Estado -->
        <div class="col-md-4">
            <div class="panel-dark mb-4">
                <h5 class="text-white border-bottom border-secondary pb-2 mb-3"><i class="fas fa-server"></i> Gestión de Vulnerabilidades</h5>
                <ul class="list-unstyled">
                    <?php foreach ($vulnerabilidades as $vuln): ?>
                        <li class="mb-3 border-bottom border-dark pb-2">
                            <div class="d-flex justify-content-between">
                                <strong class="text-white"><?= $vuln['servidor'] ?></strong>
                                <span class="badge bg-<?= $vuln['riesgo'] == 'Crítico' ? 'danger' : ($vuln['riesgo'] == 'Alto' ? 'warning' : 'info') ?>"><?= $vuln['riesgo'] ?></span>
                            </div>
                            <div class="small" style="color: #bbb;"><?= $vuln['cve'] ?> - Parche: <span class="text-warning"><?= $vuln['parche'] ?></span></div>
                            <?php if ($vuln['notificado']): ?>
                                <div class="mt-1 text-success small">
                                    <i class="fas fa-check-circle"></i> Cliente Notificado (Incidencia creada)
                                </div>
                            <?php elseif(in_array($vuln['parche'], ['Pendiente', 'Instalando'])): ?>
                                <?= Html::a('<i class="fas fa-bell"></i> Notificar Cliente', 
                                    ['notificar-vulnerabilidad', 
                                        'servidor' => $vuln['servidor'], 
                                        'cve' => $vuln['cve'],
                                        'riesgo' => $vuln['riesgo'],
                                        'parche' => $vuln['parche']
                                    ], 
                                    [
                                        'class' => 'btn btn-sm btn-outline-warning mt-1', 
                                        'style' => 'font-size: 0.7rem;',
                                        'data' => [
                                            'confirm' => '¿Crear incidencia de seguridad automáticamente para este servidor?',
                                            'method' => 'post',
                                        ],
                                    ]
                                ) ?>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="panel-dark">
                <h5 class="text-white border-bottom border-secondary pb-2 mb-3"><i class="fas fa-chart-line"></i> Métricas del Turno</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Eventos Procesados:</span>
                    <strong class="text-success">1,245</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Amenazas Bloqueadas:</span>
                    <strong class="text-info">42</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Tiempo Medio Respuesta:</span>
                    <strong class="text-warning">4m 12s</strong>
                </div>
            </div>
        </div>
    </div>
</div>
