<?php

namespace frontend\controllers;

use Yii;
use common\models\Documentos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * DocumentosController handles document viewing/downloading for clients.
 */
class DocumentosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'descargar'],
                        'allow' => true,
                        'roles' => ['@'],

                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Documentos models for the current user's projects.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        
        // Find projects where the user is the client (or belongs to the company if admin)
        // We reuse logic similar to Incidents/Proyectos but simplified here
        $userIds = [$user->id];
        if ($user->hasRole(\common\models\User::ROL_CLIENTE_ADMIN) && !empty($user->empresa)) {
             $userIds = \common\models\User::find()->select('id')->where(['empresa' => $user->empresa])->column();
        }

        $projectIds = \common\models\Proyectos::find()
            ->select('id')
            ->where(['cliente_id' => $userIds])
            ->andWhere(['NOT IN', 'estado', [\common\models\Proyectos::ESTADO_CANCELADO, \common\models\Proyectos::ESTADO_SUSPENDIDO]])
            ->column();

        $query = Documentos::find()
            ->where(['proyecto_id' => $projectIds])
            ->andWhere(['visible_cliente' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'fecha_subida' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Downloads a file.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDescargar($id)
    {
        $model = $this->findModel($id);
        
        // Extra check: Ensure the user has access to this project
        $user = Yii::$app->user->identity;
        $project = $model->proyecto;
        
        // Simple check: Is the project assigned to me or my company?
        // (Reusing simple check for demonstration, ideally encapsulated in a service)
        $isMyProject = ($project->cliente_id == $user->id);

        if (!$isMyProject && $user->hasRole(\common\models\User::ROL_CLIENTE_ADMIN) && !empty($user->empresa)) {
            // Check if project client is in my company
            $isMyProject = ($project->cliente->empresa === $user->empresa);
        }

        if (!$isMyProject || !$model->visible_cliente) {
             throw new \yii\web\ForbiddenHttpException('No tienes permiso para descargar este documento.');
        }

        $rutaArchivo = $model->ruta_archivo;

        if (file_exists($rutaArchivo)) {
            return Yii::$app->response->sendFile($rutaArchivo, $model->nombre_archivo);
        }

        throw new NotFoundHttpException('El archivo físico no existe.');
    }

    /**
     * Finds the Documentos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Documentos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documentos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
