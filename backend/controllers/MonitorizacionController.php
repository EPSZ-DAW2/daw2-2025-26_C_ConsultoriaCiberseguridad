<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Monitorización SOC 24/7
 */
class MonitorizacionController extends Controller
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
                            'roles' => ['verMonitorizacion'], // Solo analista_soc y admin
                        ],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
