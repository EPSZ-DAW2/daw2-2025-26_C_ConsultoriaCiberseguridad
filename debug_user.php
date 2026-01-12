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

$username = 'prueba3'; // User mentioned by the user
// Or maybe email contains prueba3? searching by username/email
$user = \common\models\User::find()
    ->where(['like', 'nombre', $username])
    ->orWhere(['like', 'email', $username])
    ->one();

if (!$user) {
    echo "Usuario '$username' no encontrado.\n";
    exit;
}

echo "Usuario: " . $user->email . " (ID: " . $user->id . ", Empresa: " . $user->empresa . ", ROL: " . $user->rol . ")\n";

echo "\n--- PROYECTOS ---\n";
$proyectos = \common\models\Proyectos::find()
    ->alias('p')
    ->joinWith(['servicio' => function ($q) { $q->alias('s'); }])
    ->where(['cliente_id' => $user->id]) 
    ->orWhere(['cliente_id' => \common\models\User::find()->select('id')->where(['empresa' => $user->empresa])])
    ->all();

if (empty($proyectos)) {
    echo "No tiene proyectos asignados.\n";
}

foreach ($proyectos as $p) {
    echo "ID: " . $p->id . " | Nombre: " . $p->nombre . " | Estado: " . $p->estado . "\n";
    echo "   Cliente ID: " . $p->cliente_id . "\n";
    if ($p->servicio) {
        echo "   Servicio: " . $p->servicio->nombre . " | Categoria: '" . $p->servicio->categoria . "'\n";
    } else {
        echo "   Servicio: NULL\n";
    }
}

echo "\n--- PERMISOS ---\n";
echo "Tiene Ciberseguridad? " . ($user->hasContratoActivo('Ciberseguridad') ? 'SI' : 'NO') . "\n";
echo "Tiene Consultoría? " . ($user->hasContratoActivo('Consultoría') ? 'SI' : 'NO') . "\n";
