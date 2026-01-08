<?php

namespace frontend\controllers;

use common\models\EventosCalendario;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * CalendarioController displays events in a calendar.
 */
class CalendarioController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'], // Only authenticated users
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays the calendar with events.
     *
     * @return string
     */
    public function actionIndex()
    {
        // 1. Fetch events from Database
        $eventosBD = EventosCalendario::find()->all();
        
        $eventosParaCalendario = [];

        // 2. Convert to FullCalendar format
        foreach ($eventosBD as $evento) {
            $eventoGrafico = new \yii2fullcalendar\models\Event();
            $eventoGrafico->id = $evento->id;
            $eventoGrafico->title = $evento->titulo;
            $eventoGrafico->start = $evento->fecha . 'T' . $evento->hora_inicio;
            if ($evento->hora_fin) {
                $eventoGrafico->end = $evento->fecha . 'T' . $evento->hora_fin;
            }
            // Optional: Customize color based on event type
            // $eventoGrafico->color = ... 
            
            $eventosParaCalendario[] = $eventoGrafico;
        }

        return $this->render('index', [
            'events' => $eventosParaCalendario,
        ]);
    }
}
