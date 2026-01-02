<?php

namespace backend\controllers;

use common\models\EventosCalendario;
use backend\models\EventosCalendarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventosCalendarioController implements the CRUD actions for EventosCalendario model.
 */
class EventosCalendarioController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all EventosCalendario models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // 1. Buscamos tus eventos en la Base de Datos
        $eventosBD = \common\models\EventosCalendario::find()->all();
        
        $eventosParaCalendario = [];

        // 2. Los convertimos al formato que pide FullCalendar
        foreach ($eventosBD as $evento) {
            $eventoGrafico = new \yii2fullcalendar\models\Event();
            $eventoGrafico->id = $evento->id;
            $eventoGrafico->title = $evento->titulo; // Asegúrate que tu columna se llama 'titulo'
            $eventoGrafico->start = $evento->fecha_evento; // Asegúrate que tu columna se llama 'fecha_evento'
            // $eventoGrafico->end = $evento->fecha_fin; // Descomenta si tienes fecha fin
            
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
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EventosCalendario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new EventosCalendario();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EventosCalendario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EventosCalendario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EventosCalendario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return EventosCalendario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventosCalendario::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
