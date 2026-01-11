<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $events array */

$this->title = 'Calendario de Auditoría';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventos-calendario-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
             'header' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => 'month,agendaWeek,agendaDay'
            ],
            'eventRender' => new \yii\web\JsExpression("
                function(event, element) {
                    var viewBaseUrl = '" . \yii\helpers\Url::to(['view']) . "';
                    var updateBaseUrl = '" . \yii\helpers\Url::to(['update']) . "';
                    var deleteBaseUrl = '" . \yii\helpers\Url::to(['delete']) . "';
                    
                    var separator = viewBaseUrl.indexOf('?') >= 0 ? '&' : '?';
                    
                    var viewUrl = viewBaseUrl + separator + 'id=' + event.id;
                    var updateUrl = updateBaseUrl + separator + 'id=' + event.id;
                    var deleteUrl = deleteBaseUrl + separator + 'id=' + event.id;
                    
                    var content = element.find('.fc-content');
                    if (content.length === 0) { content = element.find('.fc-title').parent(); }
                    if (content.length === 0) { content = element; }
                    
                    var iconHtml = '<span class=\"event-actions float-end\" style=\"margin-left:5px;\">';
                    
                    // View (Eye)
                    iconHtml += '<a href=\"' + viewUrl + '\" title=\"Ver\" style=\"color:white; margin-right:4px;\"><i class=\"fas fa-eye\"></i></a>';
                    
                    // Update (Pencil)
                    iconHtml += '<a href=\"' + updateUrl + '\" title=\"Editar\" style=\"color:white; margin-right:4px;\"><i class=\"fas fa-pencil-alt\"></i></a>';
                    
                    // Delete (Trash) - Uses Yii2 data attributes
                    iconHtml += '<a href=\"' + deleteUrl + '\" title=\"Borrar\" style=\"color:white;\" ' + 
                                'data-confirm=\"¿Estás seguro de que quieres eliminar este evento?\" ' + 
                                'data-method=\"post\"><i class=\"fas fa-trash\"></i></a>';
                    
                    iconHtml += '</span>';
                    
                    content.append(iconHtml);
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