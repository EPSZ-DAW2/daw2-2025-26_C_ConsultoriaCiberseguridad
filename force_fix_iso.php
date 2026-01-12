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

// Force ID 1 to Consultoría
\common\models\Servicios::updateAll(['categoria' => 'Consultoría'], ['id' => 1]);
echo "ID 1 Corregido a Consultoría.\n";

// Check User 'prueba3' status
$username = 'prueba3';
$user = \common\models\User::find()
    ->where(['like', 'nombre', $username])
    ->orWhere(['like', 'email', $username])
    ->one();

if ($user) {
    echo "Permisos de {$user->nombre}:\n";
    echo " - Ciberseguridad/Incidencias: " . ($user->hasContratoActivo('Ciberseguridad') ? 'SI' : 'NO') . "\n";
    echo " - Consultoría (Calendario/Docs): " . ($user->hasContratoActivo('Consultoría') ? 'SI' : 'NO') . "\n";
    
    // Check why
    $proyectos = \common\models\Proyectos::find()
            ->alias('p')
            ->joinWith(['servicio' => function ($q) { $q->alias('s'); }])
            ->where(['p.cliente_id' => $user->id]) // personal
            ->andWhere(['NOT IN', 'p.estado', [\common\models\Proyectos::ESTADO_CANCELADO, \common\models\Proyectos::ESTADO_SUSPENDIDO]])
            ->all();
            
    foreach($proyectos as $p) {
        echo "   * Proy #{$p->id} ({$p->estado}) -> Servicio: {$p->servicio->nombre} -> Cat: {$p->servicio->categoria}\n"; 
    }
}
