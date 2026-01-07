<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

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

    public function actionIndex()
    {
        return $this->render('index');
    }
}
