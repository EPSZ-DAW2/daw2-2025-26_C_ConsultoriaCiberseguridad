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

echo "Corrigiendo categorias de servicios...\n";

// 1. Corrección DEFENSA
$count = \common\models\Servicios::updateAll(['categoria' => 'Defensa'], ['like', 'nombre', 'vulnerabilidades']);
$count += \common\models\Servicios::updateAll(['categoria' => 'Defensa'], ['like', 'nombre', 'ciberseguridad']);
$count += \common\models\Servicios::updateAll(['categoria' => 'Defensa'], ['like', 'categoria', 'Ciberseguridad']);
echo "Actualizados a Defensa: $count\n";

// 2. Corrección GOBERNANZA
$count = \common\models\Servicios::updateAll(['categoria' => 'Gobernanza'], ['like', 'nombre', 'ISO']);
$count += \common\models\Servicios::updateAll(['categoria' => 'Gobernanza'], ['like', 'nombre', 'ENS']);
echo "Actualizados a Gobernanza: $count\n";

// 3. Corrección FORMACIÓN
$count = \common\models\Servicios::updateAll(['categoria' => 'Formación'], ['like', 'nombre', 'Curso']);
$count += \common\models\Servicios::updateAll(['categoria' => 'Formación'], ['like', 'nombre', 'Hacking']);
echo "Actualizados a Formación: $count\n";

echo "Finalizado.\n";
