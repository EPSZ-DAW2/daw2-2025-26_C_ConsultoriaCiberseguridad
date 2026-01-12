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

echo "Rellenando categorias vacias con nombres legacy...\n";

// Ciberseguridad/Defensa (IDs 3, 4, 7)
$count = \common\models\Servicios::updateAll(['categoria' => 'Ciberseguridad'], ['id' => [3, 4, 7]]);
echo "Asignado 'Ciberseguridad' a $count servicios (SOC, Vuln).\n";

// Consultoría/Gobernanza (IDs 1, 2)
// ID 2 ya era 'Consultoría', ID 1 estaba vacio.
$count = \common\models\Servicios::updateAll(['categoria' => 'Consultoría'], ['id' => [1, 2]]);
echo "Asignado 'Consultoría' a $count servicios (ISO, ENS).\n";

echo "Completado.\n";
