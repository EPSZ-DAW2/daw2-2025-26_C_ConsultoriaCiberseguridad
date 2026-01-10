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

// Revert ISO 27001 (ID 1) back to Ciberseguridad
\common\models\Servicios::updateAll(['categoria' => 'Ciberseguridad'], ['id' => 1]);
echo "ISO 27001 (ID 1) revertido a categoría 'Ciberseguridad'.\n";
