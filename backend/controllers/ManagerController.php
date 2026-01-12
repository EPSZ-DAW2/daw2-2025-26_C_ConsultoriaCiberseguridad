<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Proyectos;
use common\models\Incidencias;
use common\models\Servicios;
use yii\db\Expression;

/**
 * ManagerController KPI Dashboard.
 */
class ManagerController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['dashboard', 'get-stats'],
                        'allow' => true,
                        'roles' => ['manager', 'admin'], // Permitir a Manager y Admin
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the Business & Operations Dashboard.
     *
     * @return string
     */
    public function actionDashboard()
    {
        // ---------------------------------------------------------
        // 1. FINANCIAL METRICS (RENTABILIDAD)
        // ---------------------------------------------------------

        // A. Ingresos Brutos Reales (Solo Contratados y Pagados)
        $solicitudesContratadas = \common\models\SolicitudesPresupuesto::find()
            ->where(['estado_solicitud' => \common\models\SolicitudesPresupuesto::ESTADO_SOLICITUD_CONTRATADO])
            ->joinWith('servicio')
            ->all();
        
        $ingresosReales = 0;
        $ingresosTarjeta = 0;
        $ingresosTransferencia = 0;
        $countTarjeta = 0;
        $countTransferencia = 0;

        foreach ($solicitudesContratadas as $sol) {
            // Cruce de Precios: Usar precio_base si presupuesto_estimado es null
            $valor = $sol->presupuesto_estimado ?: ($sol->servicio ? $sol->servicio->precio_base : 0);
            $ingresosReales += $valor;

            // Identificación Canal de Pago
            if (stripos($sol->origen_solicitud, 'Tarjeta') !== false) {
                $ingresosTarjeta += $valor;
                $countTarjeta++;
            } else {
                $ingresosTransferencia += $valor;
                $countTransferencia++;
            }
        }

        // B. Pipeline (Previsión de Ingresos)
        // Suma de servicios en Pendiente, Revisión o Enviado
        $solicitudesPipeline = \common\models\SolicitudesPresupuesto::find()
            ->where(['estado_solicitud' => [
                \common\models\SolicitudesPresupuesto::ESTADO_SOLICITUD_PENDIENTE,
                \common\models\SolicitudesPresupuesto::ESTADO_SOLICITUD_EN_REVISION,
                \common\models\SolicitudesPresupuesto::ESTADO_SOLICITUD_PRESUPUESTO_ENVIADO
            ]])
            ->joinWith('servicio')
            ->all();
        
        $pipelineValue = 0;
        foreach ($solicitudesPipeline as $sol) {
             $valor = $sol->presupuesto_estimado ?: ($sol->servicio ? $sol->servicio->precio_base : 0);
             $pipelineValue += $valor;
        }

        // C. Valor Medio de Contrato (Ticket Medio)
        $totalContratos = count($solicitudesContratadas);
        $valorMedioContrato = $totalContratos > 0 ? ($ingresosReales / $totalContratos) : 0;


        // ---------------------------------------------------------
        // 2. OPERATIONS METRICS (SOC & ACTIVACIÓN)
        // ---------------------------------------------------------

        // D. Tasa de Activación Instantánea (Tarjeta)
        $tasaActivacion = $totalContratos > 0 ? ($countTarjeta / $totalContratos) * 100 : 0;

        // E. MTTR (SLA)
        $sqlMTTR = "SELECT AVG(TIMESTAMPDIFF(HOUR, fecha_reporte, fecha_resolucion)) FROM incidencias WHERE (estado_incidencia = 'Resuelto' OR estado_incidencia = 'Cerrado') AND fecha_resolucion IS NOT NULL";
        $mttr = Yii::$app->db->createCommand($sqlMTTR)->queryScalar();
        $mttr = $mttr ? round($mttr, 1) : 0; 

        // F. Volumen de Incidencias por Cliente
        $topClientesData = Incidencias::find()
            ->select(['cliente_id', 'COUNT(*) as count'])
            ->groupBy('cliente_id')
            ->orderBy(['count' => SORT_DESC])
            ->limit(5)
            ->with('cliente')
            ->asArray()
            ->all();

        $labelsTopClientes = [];
        $valuesTopClientes = [];
        foreach ($topClientesData as $item) {
             $user = \common\models\User::findOne($item['cliente_id']);
             $labelsTopClientes[] = $user ? $user->nombre : 'Desconocido';
             $valuesTopClientes[] = $item['count'];
        }

        // G. Analítica Específica Online (Tarjeta)
        $ticketMedioOnline = $countTarjeta > 0 ? ($ingresosTarjeta / $countTarjeta) : 0;
        
        // Ahorro de Costes Operativos: 30 mins * 30€/h = 15€ de ahorro por venta automática
        $ahorroCostes = $countTarjeta * 15;

        // Top Productos Online (Impulso)
        $topProductosOnlineData = \common\models\SolicitudesPresupuesto::find()
            ->select(['servicio_id', 'COUNT(*) as count'])
            ->where(['estado_solicitud' => \common\models\SolicitudesPresupuesto::ESTADO_SOLICITUD_CONTRATADO])
            ->andWhere(['LIKE', 'origen_solicitud', 'Tarjeta'])
            ->groupBy('servicio_id')
            ->orderBy(['count' => SORT_DESC])
            ->limit(5)
            ->with('servicio')
            ->asArray()
            ->all();

        $labelsTopOnline = [];
        $valuesTopOnline = [];
        foreach ($topProductosOnlineData as $item) {
             $serv = \common\models\Servicios::findOne($item['servicio_id']);
             $labelsTopOnline[] = $serv ? $serv->nombre : 'Desconocido';
             $valuesTopOnline[] = $item['count'];
        }

        // Ventas por Franja Horaria (Tarjeta)
        $sqlHoras = "SELECT HOUR(fecha_solicitud) as hora, COUNT(*) as count FROM solicitudes_presupuesto WHERE estado_solicitud = 'Contratado' AND origen_solicitud LIKE '%Tarjeta%' GROUP BY hora ORDER BY hora ASC";
        $ventasPorHoraData = Yii::$app->db->createCommand($sqlHoras)->queryAll();
        
        $labelsHoras = []; // 0..23
        $valuesHoras = array_fill(0, 24, 0);

        foreach ($ventasPorHoraData as $row) {
            $valuesHoras[(int)$row['hora']] = (int)$row['count'];
        }
        for ($i=0; $i<24; $i++) $labelsHoras[] = $i . ":00";


        // Datos para Gráfico de Canales
        $labelsCanales = ['Tarjeta (Online)', 'Transferencia (Banco)'];
        $valuesCanales = [$ingresosTarjeta, $ingresosTransferencia];

        return $this->render('dashboard', [
            'ingresosReales' => $ingresosReales,
            'pipelineValue' => $pipelineValue,
            'valorMedioContrato' => $valorMedioContrato,
            'tasaActivacion' => round($tasaActivacion, 1),
            'mttr' => $mttr,
            
            // Nuevas variables
            'ingresosTarjeta' => $ingresosTarjeta,
            'ticketMedioOnline' => $ticketMedioOnline,
            'ahorroCostes' => $ahorroCostes,
            
            'labelsTopClientes' => $labelsTopClientes,
            'valuesTopClientes' => $valuesTopClientes,
            'labelsCanales' => $labelsCanales,
            'valuesCanales' => $valuesCanales,
            'labelsTopOnline' => $labelsTopOnline,
            'valuesTopOnline' => $valuesTopOnline,
            'labelsHoras' => $labelsHoras,
            'valuesHoras' => $valuesHoras,
        ]);
    }

    /**
     * AJAX Endpoint
     */
    public function actionGetStats()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // 1. Ingresos y Canales
        $solicitudesContratadas = \common\models\SolicitudesPresupuesto::find()
            ->where(['estado_solicitud' => \common\models\SolicitudesPresupuesto::ESTADO_SOLICITUD_CONTRATADO])
            ->joinWith('servicio')
            ->all();
        
        $ingresosReales = 0;
        $ingresosTarjeta = 0;
        $ingresosTransferencia = 0;
        $countTarjeta = 0;

        foreach ($solicitudesContratadas as $sol) {
            $valor = $sol->presupuesto_estimado ?: ($sol->servicio ? $sol->servicio->precio_base : 0);
            $ingresosReales += $valor;

            if (stripos($sol->origen_solicitud, 'Tarjeta') !== false) {
                $ingresosTarjeta += $valor;
                $countTarjeta++;
            } else {
                $ingresosTransferencia += $valor;
            }
        }

        $totalContratos = count($solicitudesContratadas);
        $valorMedioContrato = $totalContratos > 0 ? ($ingresosReales / $totalContratos) : 0;
        $tasaActivacion = $totalContratos > 0 ? ($countTarjeta / $totalContratos) * 100 : 0;

        // 2. Pipeline
        $solicitudesPipeline = \common\models\SolicitudesPresupuesto::find()
            ->where(['estado_solicitud' => [
                \common\models\SolicitudesPresupuesto::ESTADO_SOLICITUD_PENDIENTE,
                \common\models\SolicitudesPresupuesto::ESTADO_SOLICITUD_EN_REVISION,
                \common\models\SolicitudesPresupuesto::ESTADO_SOLICITUD_PRESUPUESTO_ENVIADO
            ]])
            ->joinWith('servicio')
            ->all();
        
        $pipelineValue = 0;
        foreach ($solicitudesPipeline as $sol) {
             $valor = $sol->presupuesto_estimado ?: ($sol->servicio ? $sol->servicio->precio_base : 0);
             $pipelineValue += $valor;
        }

        // 3. MTTR
        $sqlMTTR = "SELECT AVG(TIMESTAMPDIFF(HOUR, fecha_reporte, fecha_resolucion)) FROM incidencias WHERE (estado_incidencia = 'Resuelto' OR estado_incidencia = 'Cerrado') AND fecha_resolucion IS NOT NULL";
        $mttr = Yii::$app->db->createCommand($sqlMTTR)->queryScalar();
        $mttr = $mttr ? round($mttr, 1) : 0;

        // 4. Top Clientes
        $topClientesData = Incidencias::find()
            ->select(['cliente_id', 'COUNT(*) as count'])
            ->groupBy('cliente_id')
            ->orderBy(['count' => SORT_DESC])
            ->limit(5)
            ->with('cliente')
            ->asArray()
            ->all();

        $labelsTopClientes = [];
        $valuesTopClientes = [];
        foreach ($topClientesData as $item) {
             $user = \common\models\User::findOne($item['cliente_id']);
             $labelsTopClientes[] = $user ? $user->nombre : 'Desconocido';
             $valuesTopClientes[] = $item['count'];
        }

        // 5. Analytics Online
        $ticketMedioOnline = $countTarjeta > 0 ? ($ingresosTarjeta / $countTarjeta) : 0;
        $ahorroCostes = $countTarjeta * 15;

        // Top Online
        $topProductosOnlineData = \common\models\SolicitudesPresupuesto::find()
            ->select(['servicio_id', 'COUNT(*) as count'])
            ->where(['estado_solicitud' => \common\models\SolicitudesPresupuesto::ESTADO_SOLICITUD_CONTRATADO])
            ->andWhere(['LIKE', 'origen_solicitud', 'Tarjeta'])
            ->groupBy('servicio_id')
            ->orderBy(['count' => SORT_DESC])
            ->limit(5)
            ->with('servicio')
            ->asArray()
            ->all();

        $labelsTopOnline = [];
        $valuesTopOnline = [];
        foreach ($topProductosOnlineData as $item) {
             $serv = \common\models\Servicios::findOne($item['servicio_id']);
             $labelsTopOnline[] = $serv ? $serv->nombre : 'Desconocido';
             $valuesTopOnline[] = $item['count'];
        }

        // Ventas Hora
        $sqlHoras = "SELECT HOUR(fecha_solicitud) as hora, COUNT(*) as count FROM solicitudes_presupuesto WHERE estado_solicitud = 'Contratado' AND origen_solicitud LIKE '%Tarjeta%' GROUP BY hora ORDER BY hora ASC";
        $ventasPorHoraData = Yii::$app->db->createCommand($sqlHoras)->queryAll();
        $valuesHoras = array_fill(0, 24, 0);
        foreach ($ventasPorHoraData as $row) {
            $valuesHoras[(int)$row['hora']] = (int)$row['count'];
        }

        $labelsHoras = []; 
        for ($i=0; $i<24; $i++) $labelsHoras[] = $i . ":00";

        return [
            'kpis' => [
                'ingresosReales' => number_format($ingresosReales, 0, ',', '.') . ' €',
                'pipelineValue' => number_format($pipelineValue, 0, ',', '.') . ' €',
                'valorMedio' => number_format($valorMedioContrato, 0, ',', '.') . ' €',
                'tasaActivacion' => round($tasaActivacion, 1) . '%',
                'mttr' => $mttr . ' h',
                
                // Nuevos KPIs JSON
                'ingresosTarjeta' => number_format($ingresosTarjeta, 0, ',', '.') . ' €',
                'ticketMedioOnline' => number_format($ticketMedioOnline, 0, ',', '.') . ' €',
                'ahorroCostes' => number_format($ahorroCostes, 0, ',', '.') . ' €',
            ],
            'charts' => [
                'canales' => [
                    'labels' => ['Tarjeta (Online)', 'Transferencia (Banco)'],
                    'data' => [$ingresosTarjeta, $ingresosTransferencia]
                ],
                'clientes' => [
                    'labels' => $labelsTopClientes,
                    'data' => $valuesTopClientes
                ],
                 'topOnline' => [
                    'labels' => $labelsTopOnline,
                    'data' => $valuesTopOnline
                ],
                'porHora' => [
                    'labels' => $labelsHoras,
                    'data' => $valuesHoras
                ]
            ]
        ];
    }
}
