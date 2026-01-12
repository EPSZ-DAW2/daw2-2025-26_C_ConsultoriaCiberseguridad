<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PreguntasCuestionario $model */

$this->title = 'Actualizar Pregunta: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Preguntas Cuestionarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="preguntas-cuestionario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
