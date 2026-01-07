<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Rentabilidad - Métricas financieras y KPIs
 */
class RentabilidadController extends Controller
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
                            'roles' => ['verRentabilidad'], // Solo manager y admin
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
