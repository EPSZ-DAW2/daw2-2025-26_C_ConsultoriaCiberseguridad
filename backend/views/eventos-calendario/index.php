<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $events array */

$this->title = 'Calendario de Auditoría';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventos-calendario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= \yii2fullcalendar\yii2fullcalendar::widget([
        'events' => $events,
        'options' => [
            'lang' => 'es',
        ],
    ]); ?>

</div>