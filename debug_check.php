<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

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

// Buscar un admin (cliente_admin)
$user = \common\models\User::find()->where(['rol' => 'cliente_admin'])->one();

if (!$user) {
    echo "No se encontró ningún cliente_admin.\n";
    exit;
}

echo "Usuario Debug: " . $user->email . " (ID: " . $user->id . ", Empresa: " . $user->empresa . ")\n";

echo "\n--- PROYECTOS ---\n";
$proyectos = \common\models\Proyectos::find()
    ->where(['cliente_id' => $user->id]) // Solo directos de momento
    ->orWhere(['cliente_id' => \common\models\User::find()->select('id')->where(['empresa' => $user->empresa])])
    ->all();

if (empty($proyectos)) {
    echo "No tiene proyectos asignados.\n";
}

foreach ($proyectos as $p) {
    echo "ID: " . $p->id . " | Nombre: " . $p->nombre . " | Estado: " . $p->estado . "\n";
    if ($p->servicio) {
        echo "   Servicio: " . $p->servicio->nombre . " | Categoria: " . $p->servicio->categoria . "\n";
    } else {
        echo "   Servicio: NULL\n";
    }
}

echo "\n--- CHEQUEO DE PERMISOS ---\n";
$categorias = ['Defensa', 'Gobernanza', 'Auditoría', 'Formación'];
foreach ($categorias as $cat) {
    $has = $user->hasContratoActivo($cat);
    echo "Tiene $cat? " . ($has ? "SI" : "NO") . "\n";
}
