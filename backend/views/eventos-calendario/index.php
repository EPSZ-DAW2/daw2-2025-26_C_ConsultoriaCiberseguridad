<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $events array */

$this->title = 'Calendario de Auditoría';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventos-calendario-index">

    <h1>Calendario de Auditoría</h1>

    <?php if (Yii::$app->user->can('escribirCalendario')): ?>
    <p>
        <?= Html::a('Crear Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?= \yii2fullcalendar\yii2fullcalendar::widget([
        'events' => $events,
        'options' => [
            'lang' => 'es',
        ],
        'clientOptions' => [
            'themeSystem' => 'bootstrap5',
            'eventLimit' => true,
            'displayEventEnd' => true, 
            'timeFormat' => 'H:mm', // Correct format to avoid duplication (Auto-generates "9:00 - 11:00")
             'header' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => ''
            ],
            'height' => 'auto',
            'eventRender' => new \yii\web\JsExpression("
                function(event, element) {
                    var viewBaseUrl = '" . \yii\helpers\Url::to(['view']) . "';
                    var updateBaseUrl = '" . \yii\helpers\Url::to(['update']) . "';
                    var deleteBaseUrl = '" . \yii\helpers\Url::to(['delete']) . "';
                    
                    var separator = viewBaseUrl.indexOf('?') >= 0 ? '&' : '?';
                    
                    var viewUrl = viewBaseUrl + separator + 'id=' + event.id;
                    var updateUrl = updateBaseUrl + separator + 'id=' + event.id;
                    var deleteUrl = deleteBaseUrl + separator + 'id=' + event.id;
                    
                    var content = element.find('.fc-title').parent();
                    if (content.length === 0) { content = element; }
                    
                    // Format Title: Break line after [Project Name]
                    // Safe encoding of title first
                    var titleText = event.title; 
                    // Insert break after closing bracket of project name
                    var newTitle = titleText.replace('] ', '] <br/>');
                    element.find('.fc-title').html(newTitle);
                    
                    // Move icons to bottom right
                    var iconHtml = '<div class=\"event-actions\" style=\"text-align:right; margin-top:4px;\">';
                    
                    // View (Eye)
                    iconHtml += '<a href=\"' + viewUrl + '\" title=\"Ver\" style=\"color:black; margin-right:4px;\"><i class=\"fas fa-eye\"></i></a>';
                    
                    // Update (Pencil)
                    iconHtml += '<a href=\"' + updateUrl + '\" title=\"Editar\" style=\"color:black; margin-right:4px;\"><i class=\"fas fa-pencil-alt\"></i></a>';
                    
                    // Delete (Trash) - Uses Yii2 data attributes
                    iconHtml += '<a href=\"' + deleteUrl + '\" title=\"Borrar\" style=\"color:black;\" ' + 
                                'data-confirm=\"¿Estás seguro de que quieres eliminar este evento?\" ' + 
                                'data-method=\"post\"><i class=\"fas fa-trash\"></i></a>';
                    
                    iconHtml += '</div>';
                    
                    // Append icons INSIDE the title block to ensure they stay within the blue box flow
                    element.find('.fc-title').append(iconHtml);
                }
            "),
        ],
    ]); ?>

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
        /* Ensure it doesn't overlap if screen is small, though expected usage is desktop from screenshot */
        z-index: 1; 
    }
    .fc-toolbar {
        position: relative; /* Context for absolute positioning */
    }
</style>