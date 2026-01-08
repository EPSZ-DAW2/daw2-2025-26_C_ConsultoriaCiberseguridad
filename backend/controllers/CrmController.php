<?php

namespace backend\controllers;

use Yii;
use common\models\SolicitudesPresupuesto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * CRM - Gestión de clientes potenciales y leads
 */
class CrmController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['gestionarCRM'], // Solo comercial y admin
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lista todas las solicitudes de presupuesto
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SolicitudesPresupuesto::find()
                ->with(['servicio', 'usuarioAsignado'])
                ->orderBy(['fecha_solicitud' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra el detalle de una solicitud
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Actualiza una solicitud existente
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Solicitud actualizada correctamente.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Encuentra el modelo basado en su ID
     */
    protected function findModel($id)
    {
        if (($model = SolicitudesPresupuesto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La solicitud no existe.');
    }
}
