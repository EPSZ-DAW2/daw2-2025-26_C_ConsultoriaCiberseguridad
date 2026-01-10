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

echo "Revirtiendo cambios en categorias...\n";

// Revertir Defensa -> Ciberseguridad (que era el valor original detectado en debug)
$count = \common\models\Servicios::updateAll(['categoria' => 'Ciberseguridad'], ['categoria' => 'Defensa']);
echo "Revertidos $count registros de Defensa a Ciberseguridad.\n";

echo "Operación completada.\n";
