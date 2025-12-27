<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PreguntasCuestionario $model */

$this->title = 'Create Preguntas Cuestionario';
$this->params['breadcrumbs'][] = ['label' => 'Preguntas Cuestionarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preguntas-cuestionario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
