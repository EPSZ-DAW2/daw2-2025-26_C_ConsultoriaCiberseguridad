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
                    'themeSystem' => 'bootstrap5',
                    // 'height' => 'auto', // Removed to restore default aspect ratio
                    'eventLimit' => true, // Allow "more" link when too many events
                    'eventRender' => new \yii\web\JsExpression("
                        function(event, element) {
                            var viewUrl = '" . \yii\helpers\Url::to(['view']) . "&id=' + event.id;
                            
                            // Check if standard FullCalendar v3 structure
                            var content = element.find('.fc-content');
                            if (content.length === 0) {
                                content = element.find('.fc-title').parent(); 
                            }
                            if (content.length === 0) {
                                // Fallback for some themes or v5 if wrapped differently
                                content = element; 
                            }
                            
                            var iconHtml = '<span class=\"pull-right float-end\" style=\"margin-left:5px;\">' +
                                           '<a href=\"' + viewUrl + '\" title=\"Ver Detalle\" style=\"color:fff; z-index:999;\">' + 
                                           '<i class=\"fas fa-eye\"></i></a></span>';
                                           
                            // Prepend to content to stay top-right or inline
                            // element.find('.fc-title').append(iconHtml); 
                            // Better: Append to fc-content
                            content.append(iconHtml);
                        }
                    "),
                ],
            ]); ?>
        </div>
    </div>

</div>

<style>
    /* Forzar que el texto del evento se ajuste a varias líneas */
    .fc-event, .fc-event-dot {
        background-color: #3788d8 !important; /* Asegurar visibilidad de fondo */
    }
    
    /* FullCalendar v3 / Legacy */
    .fc-day-grid-event .fc-content {
        white-space: normal !important;
        overflow: visible !important; 
    }
    .fc-title {
        white-space: normal !important;
        font-weight: normal;
    }
    
    /* FullCalendar v5+ */
    .fc-event-main, .fc-event-title, .fc-event-title-container {
        white-space: normal !important;
        overflow: visible !important;
        text-overflow: clip !important;
    }
    
    /* Asegurar altura dinámica del evento */
    .fc-daygrid-event {
        white-space: normal !important;
        height: auto !important;
    }
</style>
