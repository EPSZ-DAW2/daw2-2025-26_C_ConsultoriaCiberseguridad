<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EventosCalendario $model */

$this->title = 'Crear Evento';
$this->params['breadcrumbs'][] = ['label' => 'Eventos Calendarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventos-calendario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
