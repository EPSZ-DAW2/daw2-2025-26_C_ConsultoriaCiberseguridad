<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/common/config/bootstrap.php';
require __DIR__ . '/frontend/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/common/config/main.php',
    require __DIR__ . '/common/config/main-local.php',
    require __DIR__ . '/frontend/config/main.php',
    require __DIR__ . '/frontend/config/main-local.php'
);

$app = new yii\web\Application($config);

use common\models\Proyectos;
use common\models\Incidencias;

echo "--- TESTING ACTION GET STATS LOGIC ---\n";

try {
    // 1. Ingresos
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
    echo "Ingresos: $totalIngresos\n";

    // 2. Beneficio
    $costePorIncidencia = 50;
    $totalIncidenciasMes = Incidencias::find()->where(['>=', 'fecha_reporte', date('Y-m-01')])->count();
    $beneficioNeto = $totalIngresos - ($totalIncidenciasMes * $costePorIncidencia);
    echo "Beneficio: $beneficioNeto\n";

    // 3. Churn
    $proyectosCancelados = Proyectos::find()->where(['estado' => \common\models\Proyectos::ESTADO_CANCELADO])->count();
    $proyectosTotales = Proyectos::find()->count();
    $churnRate = ($proyectosTotales > 0) ? ($proyectosCancelados / $proyectosTotales) * 100 : 0;
    echo "Churn: $churnRate %\n";

    // 4. MTTR
    $sqlMTTR = "SELECT AVG(TIMESTAMPDIFF(HOUR, fecha_reporte, fecha_resolucion)) FROM incidencias WHERE (estado_incidencia = 'Resuelto' OR estado_incidencia = 'Cerrado') AND fecha_resolucion IS NOT NULL";
    $mttr = Yii::$app->db->createCommand($sqlMTTR)->queryScalar();
    $mttr = $mttr ? round($mttr, 1) : 0;
    echo "MTTR: $mttr\n";

    // 5. Criticidad
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
    echo "Criticidad: OK (" . count($valuesCriticidad) . " items)\n";
    
    echo "\nJSON RESULT:\n";
    echo json_encode([
        'kpis' => [
            'totalIngresos' => number_format($totalIngresos, 0, ',', '.') . ' €',
        ]
    ]);
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
