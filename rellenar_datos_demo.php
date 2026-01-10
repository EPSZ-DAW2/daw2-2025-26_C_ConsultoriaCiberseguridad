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

echo "--- GENERANDO DATOS DE PRUEBA (DEMO) ---\n";

// 1. Obtener un cliente aleatorio (o el primero que pille)
$cliente = \common\models\User::find()->where(['rol' => 'cliente_user'])->orWhere(['rol' => 'cliente_admin'])->one();
if (!$cliente) {
    echo "Error: Necesitas al menos un usuario cliente en la BD.\n";
    exit;
}
echo "Cliente ID seleccionado: " . $cliente->id . "\n";

// 2. Crear Proyectos (para Ingresos y Churn Rate)
$servicios = \common\models\Servicios::find()->all();
if (!$servicios) {
    echo "Error: No hay servicios en la BD.\n";
    exit;
}

echo "Generando 5 Proyectos...\n";
for ($i = 0; $i < 5; $i++) {
    $servicio = $servicios[array_rand($servicios)];
    $p = new \common\models\Proyectos();
    $p->nombre = "Proyecto Demo " . ($i+1) . " - " . $servicio->nombre;
    $p->descripcion = "Generado automáticamente para testing";
    $p->cliente_id = $cliente->id;
    $p->servicio_id = $servicio->id;
    $p->fecha_inicio = date('Y-m-d');
    $p->fecha_fin_prevista = date('Y-m-d', strtotime('+1 year'));
    // Presupuesto random entre 1000 y 15000
    $p->presupuesto = rand(10, 150) * 100; 
    
    // Estado aleatorio (mayoria activos, alguno cancelado)
    $rand = rand(1, 10);
    if ($rand > 8) $p->estado = \common\models\Proyectos::ESTADO_CANCELADO;
    else $p->estado = \common\models\Proyectos::ESTADO_EN_CURSO;
    
    $p->save();
}

// 3. Crear Incidencias (para Criticidad y MTTR)
echo "Generando 10 Incidencias...\n";
$severidades = ['Baja', 'Media', 'Alta', 'Crítica', 'Informativa'];

for ($i = 0; $i < 10; $i++) {
    $inc = new \common\models\Incidencias();
    $inc->titulo = "Incidencia Demo " . uniqid();
    $inc->descripcion = "Prueba de dashboard";
    $inc->cliente_id = $cliente->id;
    $inc->severidad = $severidades[array_rand($severidades)];
    $inc->origen = 'Simulacion';
    
    // Fechas para MTTR
    // Reporte hace entre 1 y 10 dias
    $diasAtras = rand(1, 10);
    $inc->fecha_reporte = date('Y-m-d H:i:s', strtotime("-$diasAtras days"));
    
    // Resolucion: entre 1 y 48 horas despues del reporte
    $horasResolucion = rand(1, 48);
    $inc->fecha_resolucion = date('Y-m-d H:i:s', strtotime($inc->fecha_reporte . " +$horasResolucion hours"));
    
    // Marcar como resuelta
    $inc->estado_incidencia = 'Resuelto';
    $inc->visible_cliente = 1;
    
    if (!$inc->save()) {
        print_r($inc->errors);
    }
}

echo "--- DATOS GENERADOS CORRECTAMENTE ---\n";
echo "Ahora refresca el Dashboard para ver los gráficos.\n";
