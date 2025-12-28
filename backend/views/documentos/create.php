<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Documentos $model */

$this->title = 'Create Documentos';
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
