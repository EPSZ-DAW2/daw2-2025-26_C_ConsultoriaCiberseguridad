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
        // 1. BUSINESS METRICS
        // ---------------------------------------------------------

        // A. Ingresos por Servicio (Proyectos Activos)
        // Agrupar presupuesto por Nombre de Servicio
        $ingresosData = Proyectos::find()
            ->alias('p')
            ->select(['s.nombre', 'SUM(p.presupuesto) as total'])
            ->joinWith('servicio s')
            ->where(['NOT IN', 'p.estado', [\common\models\Proyectos::ESTADO_CANCELADO, \common\models\Proyectos::ESTADO_SUSPENDIDO]])
            ->groupBy('s.nombre')
            ->asArray()
            ->all();

        // Preparar arrays para Chart.js
        $labelsIngresos = array_column($ingresosData, 'nombre');
        $valuesIngresos = array_column($ingresosData, 'total');
        $totalIngresos = array_sum($valuesIngresos);

        // B. Coste Operativo Estimado
        // Hipótesis: Coste Analista = 50€/incidencia
        $costePorIncidencia = 50;
        $totalIncidenciasMes = Incidencias::find()
            ->where(['>=', 'fecha_reporte', date('Y-m-01')]) // Este mes
            ->count();
        
        $costeOperativoEstimado = $totalIncidenciasMes * $costePorIncidencia;
        $beneficioNeto = $totalIngresos - $costeOperativoEstimado;

        // C. Churn Rate (Tasa de Cancelación)
        // Cancelados / (Activos + Cancelados)
        $proyectosCancelados = Proyectos::find()->where(['estado' => \common\models\Proyectos::ESTADO_CANCELADO])->count();
        $proyectosTotales = Proyectos::find()->count();
        $churnRate = ($proyectosTotales > 0) ? ($proyectosCancelados / $proyectosTotales) * 100 : 0;


        // ---------------------------------------------------------
        // 2. OPERATIONS METRICS (SOC)
        // ---------------------------------------------------------

        // D. MTTR (Mean Time To Respond)
        // Tiempo medio entre fecha_reporte y fecha_resolucion (en horas)
        // Solo incidencias resueltas o cerradas
        $sqlMTTR = "SELECT AVG(TIMESTAMPDIFF(HOUR, fecha_reporte, fecha_resolucion)) FROM incidencias WHERE (estado_incidencia = 'Resuelto' OR estado_incidencia = 'Cerrado') AND fecha_resolucion IS NOT NULL";
        $mttr = Yii::$app->db->createCommand($sqlMTTR)->queryScalar();
        $mttr = $mttr ? round($mttr, 1) : 0; // Horas

        // E. Distribución por Criticidad (Severidad)
        $criticidadData = Incidencias::find()
            ->select(['severidad', 'COUNT(*) as count'])
            ->groupBy('severidad')
            ->asArray()
            ->all();

        // Mapear para Chart.js (preservando colores si posible en vista)
        $labelsCriticidad = [];
        $valuesCriticidad = [];
        foreach ($criticidadData as $item) {
            $labelsCriticidad[] = $item['severidad'];
            $valuesCriticidad[] = $item['count'];
        }

        return $this->render('dashboard', [
            'labelsIngresos' => $labelsIngresos,
            'valuesIngresos' => $valuesIngresos,
            'totalIngresos' => $totalIngresos,
            'costeOperativoEstimado' => $costeOperativoEstimado,
            'beneficioNeto' => $beneficioNeto,
            'churnRate' => round($churnRate, 1),
            'mttr' => $mttr,
            'labelsCriticidad' => $labelsCriticidad,
            'valuesCriticidad' => $valuesCriticidad,
        ]);
    }

    /**
     * AJAX Endpoint
     */
    public function actionGetStats()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $ingresosData = Proyectos::find()
            ->alias('p')
            ->select(['s.nombre', 'SUM(p.presupuesto) as total'])
            ->joinWith('servicio s')
            ->where(['NOT IN', 'p.estado', [\common\models\Proyectos::ESTADO_CANCELADO, \common\models\Proyectos::ESTADO_SUSPENDIDO]])
            ->groupBy('s.nombre')
            ->asArray()
            ->all();

        $labelsIngresos = array_column($ingresosData, 'nombre');
        $valuesIngresos = array_column($ingresosData, 'total');
        $totalIngresos = array_sum($valuesIngresos);

        $costePorIncidencia = 50;
        $totalIncidenciasMes = Incidencias::find()->where(['>=', 'fecha_reporte', date('Y-m-01')])->count();
        $beneficioNeto = $totalIngresos - ($totalIncidenciasMes * $costePorIncidencia);

        $proyectosCancelados = Proyectos::find()->where(['estado' => \common\models\Proyectos::ESTADO_CANCELADO])->count();
        $proyectosTotales = Proyectos::find()->count();
        $churnRate = ($proyectosTotales > 0) ? ($proyectosCancelados / $proyectosTotales) * 100 : 0;

        $sqlMTTR = "SELECT AVG(TIMESTAMPDIFF(HOUR, fecha_reporte, fecha_resolucion)) FROM incidencias WHERE (estado_incidencia = 'Resuelto' OR estado_incidencia = 'Cerrado') AND fecha_resolucion IS NOT NULL";
        $mttr = Yii::$app->db->createCommand($sqlMTTR)->queryScalar();
        $mttr = $mttr ? round($mttr, 1) : 0;

        $criticidadData = Incidencias::find()
            ->select(['severidad', 'COUNT(*) as count'])
            ->groupBy('severidad')
            ->asArray()
            ->all();

        $labelsCriticidad = [];
        $valuesCriticidad = [];
        foreach ($criticidadData as $item) {
            if ($item['severidad']) {
                $labelsCriticidad[] = $item['severidad'];
                $valuesCriticidad[] = $item['count'];
            }
        }

        return [
            'kpis' => [
                'totalIngresos' => number_format($totalIngresos, 0, ',', '.') . ' €',
                'beneficioNeto' => number_format($beneficioNeto, 0, ',', '.') . ' €',
                'mttr' => $mttr . ' h',
                'churnRate' => round($churnRate, 1) . '%'
            ],
            'charts' => [
                'ingresos' => [
                    'labels' => $labelsIngresos,
                    'data' => $valuesIngresos
                ],
                'criticidad' => [
                    'labels' => $labelsCriticidad,
                    'data' => $valuesCriticidad
                ]
            ]
        ];
    }
}
