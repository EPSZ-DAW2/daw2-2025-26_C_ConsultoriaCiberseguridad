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
        $user = Yii::$app->user->identity;
        $query = Proyectos::find();

        if (!empty($user->empresa)) {
            // Si tiene empresa, ve TODOS los proyectos de esa empresa (Admin y Empleados)
            $userIds = \common\models\User::find()->select('id')->where(['empresa' => $user->empresa])->column();
            $query->where(['cliente_id' => $userIds]);
        } else {
            // Usuario particular (sin empresa): solo suyos
            $query->where(['cliente_id' => $user->id]);
        }

        $proyectos = $query->orderBy(['fecha_creacion' => SORT_DESC])->all();

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
        $user = Yii::$app->user->identity;

        // Comprobar permiso
        $canView = false;
        if ($model->cliente_id == $user->id) {
            $canView = true;
        } elseif (!empty($user->empresa) && $model->cliente->empresa === $user->empresa) {
            // Permitir si es de la misma empresa (para empleados también)
            $canView = true;
        }

        if (!$canView) {
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


    /**
     * Descarga segura para clientes.
     * Verifica que el proyecto sea SUYO antes de entregar el archivo.
     */
    public function actionDescargar($id)
    {
        // 1. Buscamos el documento
        $documento = \common\models\Documentos::findOne($id);

        if (!$documento) {
            throw new NotFoundHttpException('El documento no existe.');
        }

        // 2. SEGURIDAD CRÍTICA
        // Comprobamos si el proyecto de este documento pertenece al usuario conectado
        // O si pertenece a su empresa (Lógica de equipo)
        $isOwner = $documento->proyecto->cliente_id == Yii::$app->user->id;
        $isCompanyTeam = !empty(Yii::$app->user->identity->empresa) && 
                         ($documento->proyecto->cliente->empresa === Yii::$app->user->identity->empresa);

        if (!$isOwner && !$isCompanyTeam) {
            throw new \yii\web\ForbiddenHttpException('¡Alto ahí! No tienes permiso para descargar archivos de otros clientes.');
        }

        // 3. Si pasa el control, se lo entregamos
        $rutaArchivo = $documento->ruta_archivo;
        
        if (file_exists($rutaArchivo)) {
            return Yii::$app->response->sendFile($rutaArchivo, $documento->nombre_archivo);
        }

        throw new NotFoundHttpException('El archivo físico no se encuentra en el servidor.');
    }

}
