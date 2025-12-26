<?php

namespace frontend\controllers;

use Yii;
use common\models\Proyectos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * proyectos controller implementa la vista de cliente para el modelo proyectos.
 */
class ProyectosController extends Controller
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
                    'only' => ['index', 'view'],
                    'rules' => [
                        [
                            'actions' => ['index', 'view'],
                            'allow' => true,
                            'roles' => ['@'], // solo usuarios autenticados
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
     * lista todos los proyectos del cliente actual.
     * where cliente_id = yii::$app->user->id
     *
     * @return string
     */
    public function actionIndex()
    {
        $proyectos = Proyectos::find()
            ->where(['cliente_id' => Yii::$app->user->id])
            ->orderBy(['fecha_creacion' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'proyectos' => $proyectos,
        ]);
    }

    /**
     * muestra un proyecto individual.
     * @param int $id id
     * @return string
     * @throws NotFoundHttpException si el modelo no se encuentra
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        // asegurar que el proyecto pertenece al usuario actual
        if ($model->cliente_id != Yii::$app->user->id) {
            throw new NotFoundHttpException('No tiene permiso para ver este proyecto.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * busca el modelo proyectos basado en su clave primaria.
     * si el modelo no se encuentra, se lanzará una excepción http 404.
     * @param int $id id
     * @return Proyectos el modelo cargado
     * @throws NotFoundHttpException si el modelo no se encuentra
     */
    protected function findModel($id)
    {
        if (($model = Proyectos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('El proyecto solicitado no existe.');
    }
}
