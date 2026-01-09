<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                [
                    'actions' => ['login', 'error'],
                    'allow' => true,
                ],
                [
                    'actions' => ['logout'],
                    'allow' => true,
                    'roles' => ['@'], 
                ],
                [
                    'actions' => ['index'],
                    'allow' => true,
                    'matchCallback' => function ($rule, $action) {
                        // Permitir acceso si tiene cualquier permiso backend
                        $user = Yii::$app->user;
                        return $user->can('verProyectos')
                            || $user->can('verCalendario')
                            || $user->can('verDocs')
                            || $user->can('gestionarFormacion')
                            || $user->can('gestionarCRM')
                            || $user->can('gestionarCatalogo')
                            || $user->can('verMonitorizacion')
                            || $user->can('gestionarTickets')
                            || $user->can('verRentabilidad');
                    },
                ],
            ],
        ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        // Redirigir siempre al login del frontend
        $frontendUrl = str_replace('/backend/web', '/frontend/web', Yii::$app->request->baseUrl);
        return $this->redirect($frontendUrl . '/index.php?r=site/login');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        $frontendUrl = str_replace('/backend/web', '/frontend/web', Yii::$app->request->baseUrl);
        return $this->redirect($frontendUrl . '/index.php?r=site/login');
    }
}
