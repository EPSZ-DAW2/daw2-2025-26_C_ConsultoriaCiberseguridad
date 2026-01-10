<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Monitorización SOC 24/7
 */
class MonitorizacionController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['verMonitorizacion'], // Solo analista_soc y admin
                        ],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        // Simular datos si la tabla está vacía
        if (\common\models\LogDefender::find()->count() == 0) {
            $this->simularLogs();
        }

        // Obtener logs pendientes de revisar
        $logs = \common\models\LogDefender::find()
            ->where(['estado' => 'Pendiente'])
            ->orderBy(['fecha' => SORT_DESC])
            ->all();

        // Obtener vulnerabilidades (Mockup)
        $vulnerabilidadesRaw = [
            ['servidor' => 'SRV-DB-01', 'cve' => 'CVE-2024-2311', 'riesgo' => 'Crítico', 'parche' => 'Pendiente'],
            ['servidor' => 'SRV-WEB-02', 'cve' => 'CVE-2023-4589', 'riesgo' => 'Alto', 'parche' => 'Instalando'],
            ['servidor' => 'PC-GERENCIA', 'cve' => 'CVE-2024-0001', 'riesgo' => 'Medio', 'parche' => 'Pendiente'],
        ];

        $vulnerabilidades = [];
        foreach ($vulnerabilidadesRaw as $vuln) {
            // Verificar si ya existe una incidencia abierta para este CVE
            $existeAviso = \common\models\Incidencias::find()
                ->where(['like', 'titulo', $vuln['cve']])
                ->exists();
            
            $vuln['notificado'] = $existeAviso;
            $vulnerabilidades[] = $vuln;
        }

        return $this->render('index', [
            'logs' => $logs,
            'vulnerabilidades' => $vulnerabilidades
        ]);
    }

    /**
     * Convierte una alerta de log en una incidencia real para el cliente
     */
    public function actionConvertirIncidencia($id)
    {
        $log = \common\models\LogDefender::findOne($id);
        if (!$log) {
            throw new \yii\web\NotFoundHttpException('Log no encontrado');
        }

        // Intentamos asignar al cliente del log, si no hay, asignamos al primer cliente disponible (Demo)
        $clienteId = $log->cliente_afectado_id;
        if (!$clienteId) {
            // Buscar un usuario con rol cliente_admin de prueba
            $cliente = \common\models\User::find()->where(['rol' => 'cliente_admin'])->one();
            $clienteId = $cliente ? $cliente->id : \Yii::$app->user->id; 
        }

        // Crear incidencia
        $incidencia = new \common\models\Incidencias();
        $incidencia->cliente_id = $clienteId;
        $incidencia->analista_id = \Yii::$app->user->id;
        $incidencia->titulo = "Alerta de Seguridad: " . $log->evento;
        $incidencia->descripcion = "Se ha detectado una actividad sospechosa en el sistema {$log->sistema}.\n\nDetalles:\n{$log->detalles_tecnicos}\n\nFuente: {$log->fuente}";
        $incidencia->severidad = $log->gravedad;
        $incidencia->estado_incidencia = \common\models\Incidencias::ESTADO_INCIDENCIA_ASIGNADO;
        $incidencia->fecha_reporte = date('Y-m-d H:i:s');
        $incidencia->origen = 'Monitorización SOC';
        
        if ($incidencia->save()) {
            // Marcar log como procesado
            $log->estado = 'Procesado';
            $log->save();
            \Yii::$app->session->setFlash('success', 'Alerta convertida en incidencia #' . $incidencia->id);
        } else {
            \Yii::$app->session->setFlash('error', 'Error al crear incidencia: ' . json_encode($incidencia->errors));
        }

        return $this->redirect(['index']);
    }

    /**
     * Función auxiliar para poblar datos de prueba
     */
    protected function simularLogs()
    {
        $fakerLogs = [
            ['Intento de fuerza bruta RDP', 'Firewall Perimetral', 'Alta', 'SRV-AD-01', 'Múltiples intentos fallidos desde IP 45.23.12.99'],
            ['Malware detectado: Trojan.Win32', 'Microsoft Defender', 'Crítica', 'PC-RECEPCION', 'El antivirus bloqueó la ejecución de invoice.exe'],
            ['Escaneo de puertos detectado', 'IPS', 'Media', 'Gateway', 'Escaneo rápido TCP desde IP interna desconocida'],
            ['Cambio de privilegios sospechoso', 'Active Directory', 'Alta', 'SRV-FILE-01', 'El usuario user_guest fue añadido al grupo Administradores'],
        ];

        // Buscar un cliente para asignar
        $cliente = \common\models\User::find()->where(['rol' => 'cliente_admin'])->one();
        $clienteId = $cliente ? $cliente->id : null;

        foreach ($fakerLogs as $logData) {
            $log = new \common\models\LogDefender();
            $log->evento = $logData[0];
            $log->fuente = $logData[1];
            $log->gravedad = $logData[2];
            $log->sistema = $logData[3];
            $log->detalles_tecnicos = $logData[4];
            $log->cliente_afectado_id = $clienteId;
            $log->fecha = date('Y-m-d H:i:s', strtotime('-' . rand(0, 24) . ' hours'));
            $log->save();
        }
    }

    /**
     * Notifica al cliente sobre una vulnerabilidad creando una incidencia
     */
    public function actionNotificarVulnerabilidad($servidor, $cve, $riesgo, $parche)
    {
        // Buscar cliente (Demo: asignamos al primer admin o al usuario actual)
        $cliente = \common\models\User::find()->where(['rol' => 'cliente_admin'])->one();
        $clienteId = $cliente ? $cliente->id : \Yii::$app->user->id;

        $incidencia = new \common\models\Incidencias();
        $incidencia->cliente_id = $clienteId;
        $incidencia->analista_id = \Yii::$app->user->id;
        $incidencia->titulo = "Aviso de Seguridad: Vulnerabilidad en $servidor ($cve)";
        $incidencia->descripcion = "Detectada vulnerabilidad crítica o importante en el activo $servidor.\n\n" . 
                                   "CVE: $cve\nRiesgo: $riesgo\nEstado del Parche: $parche\n\n" . 
                                   "Se requiere su autorización para proceder con la ventana de mantenimiento de emergencia.";
        
        // Mapear riesgo a severidad
        $incidencia->severidad = ($riesgo == 'Crítico') ? 'Crítica' : (($riesgo == 'Alto') ? 'Alta' : 'Media');
        $incidencia->estado_incidencia = \common\models\Incidencias::ESTADO_INCIDENCIA_ASIGNADO;
        $incidencia->fecha_reporte = date('Y-m-d H:i:s');
        $incidencia->origen = 'Gestión de Vulnerabilidades';

        if ($incidencia->save()) {
            \Yii::$app->session->setFlash('success', "Cliente notificado sobre $cve. Incidencia #{$incidencia->id} generada.");
        } else {
            \Yii::$app->session->setFlash('error', 'Error al notificar: ' . json_encode($incidencia->errors));
        }

        return $this->redirect(['index']);
    }
}
