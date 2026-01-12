<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $events array */

$this->title = 'Calendario de Auditorías';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-calendario">

    <h1>Calendario de Auditorías</h1>

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
                        'right' => ''
                    ],
                    'height' => 'auto',
                    'editable' => false, // Read-only for frontend
                    'droppable' => false,
                    'themeSystem' => 'bootstrap5',
                    'displayEventEnd' => true, // Ensure end time is considered
                    'timeFormat' => 'H:mm', // Correct format to avoid duplication (Auto-generates "9:00 - 11:00")
                    // 'height' => 'auto', // Removed to restore default aspect ratio
                    'eventLimit' => true, // Allow "more" link when too many events
                    'eventRender' => new \yii\web\JsExpression("
                        function(event, element) {
                            var viewUrl = '" . \yii\helpers\Url::to(['view']) . "&id=' + event.id;
                            
                            // Check if standard FullCalendar v3 structure
                            
                            var content = element.find('.fc-title').parent();
                            if (content.length === 0) {
                                // Fallback for some themes or v5 if wrapped differently
                                content = element; 
                            }
                            
                            // Format Title: Break line after [Project Name]
                            var titleText = event.title; 
                            var newTitle = titleText.replace('] ', '] <br/>');
                            element.find('.fc-title').html(newTitle);
                            
                            // Move icons to bottom right
                            var iconHtml = '<div class=\"event-actions\" style=\"text-align:right; margin-top:4px;\">' +
                                           '<a href=\"' + viewUrl + '\" title=\"Ver Detalle\" style=\"color:black; z-index:999;\">' + 
                                           '<i class=\"fas fa-eye\"></i></a></div>';
                                           
                            // Append icons INSIDE the title block
                            element.find('.fc-title').append(iconHtml);
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
    
    /* Time on its own line */
    .fc-time {
        display: block !important;
        font-weight: bold;
        margin-bottom: 2px;
        white-space: nowrap !important;
    }
    
    /* FullCalendar v3 / Legacy */
    .fc-day-grid-event .fc-content {
        white-space: normal !important;
        overflow-y: auto !important;
        max-height: 170px !important; /* Fit within the 180px row */
        display: block !important;
    }
    .fc-title {
        white-space: normal !important;
        font-weight: normal;
        display: block !important; /* Ensure block display for breaks */
    }
    
    /* FullCalendar v5+ */
    .fc-event-main, .fc-event-title, .fc-event-title-container {
        white-space: normal !important;
        overflow-y: auto !important;
        max-height: 170px !important;
        text-overflow: clip !important;
        display: block !important;
    }
    
    /* Asegurar altura dinámica del evento */
    /* Asegurar altura dinámica del evento */
    .fc-daygrid-event, .fc-event {
        white-space: normal !important;
        height: auto !important;
    }
    
    /* Ensure row has minimum height */
    .fc-basic-view .fc-body .fc-row {
        min-height: 180px !important;
        height: auto !important;
    }

    /* Force cell content to expand */
    .fc-scroller {
        height: auto !important;
        overflow-y: visible !important;
    }

    /* Capitalize Month Name and Center it */
    .fc-toolbar h2, .fc-header-title h2 {
        text-transform: capitalize !important;
        text-align: center !important;
        width: 100%;
    }
    
    /* Absolute centering for the title container */
    .fc-toolbar .fc-center {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
    }
    .fc-toolbar {
        position: relative; /* Context for absolute positioning */
    }
</style>
