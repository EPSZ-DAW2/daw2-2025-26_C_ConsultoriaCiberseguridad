<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $events array */

$this->title = 'Calendario de Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventos-calendario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body">
            <?= \yii2fullcalendar\yii2fullcalendar::widget([
                'events' => $events,
                'options' => [
                    'lang' => 'es',
                ],
                'clientOptions' => [
                    'header' => [
                        'left' => 'prev,next today',
                        'center' => 'title',
                        'right' => 'month,agendaWeek,agendaDay'
                    ],
                    'editable' => false, // Read-only for frontend
                    'droppable' => false,
                ],
            ]); ?>
        </div>
    </div>

</div>
