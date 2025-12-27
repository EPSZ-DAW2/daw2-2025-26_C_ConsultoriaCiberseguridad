<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Diapositivas $model */

$this->title = 'Update Diapositivas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Diapositivas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="diapositivas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
