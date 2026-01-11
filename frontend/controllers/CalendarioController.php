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
        // 1. Fetch events from Database based on Role
        $currentUser = \Yii::$app->user->identity;
        $query = EventosCalendario::find();

        if ($currentUser->rol === \common\models\Usuarios::ROL_CLIENTE_USER) {
            // Clients only see events for their assigned projects
            $query->joinWith('proyecto')->where(['proyectos.cliente_id' => $currentUser->id]);
        } 
        // Other roles (admin, manager, auditor, consultor, etc.) see ALL events
        
        $eventosBD = $query->all();
        
        $eventosParaCalendario = [];

        // 2. Convert to FullCalendar format
        foreach ($eventosBD as $evento) {
            $eventoGrafico = new \yii2fullcalendar\models\Event();
            $eventoGrafico->id = $evento->id;
            $eventoGrafico->title = '[' . $evento->proyecto->nombre . '] ' . $evento->titulo;
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
    /**
     * Displays a single EventosCalendario model.
     * @param int $id ID
     * @return string
     * @throws \yii\web\NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the EventosCalendario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return EventosCalendario the loaded model
     * @throws \yii\web\NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventosCalendario::findOne(['id' => $id])) !== null) {
            // Check visibility permission
            $currentUser = \Yii::$app->user->identity;
            if ($currentUser->rol === \common\models\Usuarios::ROL_CLIENTE_USER) {
                // Ensure the event belongs to a project the client owns
                if ($model->proyecto->cliente_id !== $currentUser->id) {
                     throw new \yii\web\NotFoundHttpException('No tienes permiso para ver este evento.');
                }
            }
            return $model;
        }

        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }
}
