<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Diapositivas $model */

$this->title = 'Crear Diapositiva';
$this->params['breadcrumbs'][] = ['label' => 'Diapositivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diapositivas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
