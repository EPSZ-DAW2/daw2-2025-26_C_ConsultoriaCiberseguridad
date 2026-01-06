<?php

namespace frontend\controllers;

use Yii;
use common\models\Incidencias;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * IncidenciasController handles client-side incident reporting and viewing.
 */
class IncidenciasController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['create', 'index', 'view'],
                    'rules' => [
                        [
                            'actions' => ['create', 'index', 'view'],
                            'allow' => true,
                            'roles' => ['@'], // solo clientes autenticados
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Incidencias models for the current client.
     * @return string
     */
    public function actionIndex()
    {
        $incidencias = Incidencias::find()
            ->where(['cliente_id' => Yii::$app->user->id, 'visible_cliente' => 1])
            ->orderBy(['fecha_reporte' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'incidencias' => $incidencias,
        ]);
    }

    /**
     * Displays a single Incidencias model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        // asegurar que la incidencia pertenece al usuario actual
        if ($model->cliente_id != Yii::$app->user->id) {
            throw new NotFoundHttpException('No tiene permiso para ver esta incidencia.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Incidencias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Incidencias();

        // asignar automáticamente el usuario actual como cliente_id
        $model->cliente_id = Yii::$app->user->id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Incidencia reportada correctamente. Nuestro equipo SOC la revisará pronto.');
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
     * Finds the Incidencias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Incidencias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Incidencias::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La incidencia solicitada no existe.');
    }
}
