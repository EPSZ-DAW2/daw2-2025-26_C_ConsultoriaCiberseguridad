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
                            'actions' => ['index', 'view', 'update', 'delete', 'cambiar-estado', 'generar-pdf-pago'],
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
     * Cambia el estado de una solicitud
     */

    public function actionCambiarEstado($id, $estado)
    {
        $model = $this->findModel($id);
        $estadosPermitidos = [
            SolicitudesPresupuesto::ESTADO_SOLICITUD_PENDIENTE,
            SolicitudesPresupuesto::ESTADO_SOLICITUD_CONTACTADO,
            SolicitudesPresupuesto::ESTADO_SOLICITUD_EN_REVISION,
            SolicitudesPresupuesto::ESTADO_SOLICITUD_PRESUPUESTO_ENVIADO,
            SolicitudesPresupuesto::ESTADO_SOLICITUD_NEGOCIACION,
            SolicitudesPresupuesto::ESTADO_SOLICITUD_CONTRATADO,
            SolicitudesPresupuesto::ESTADO_SOLICITUD_RECHAZADO,
        ];

        if (!in_array($estado, $estadosPermitidos)) {
            Yii::$app->session->setFlash('error', 'Estado no válido.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $model->estado_solicitud = $estado;
        if ($model->save(false)) {
            Yii::$app->session->setFlash('success', 'Estado actualizado a: ' . $estado);

            // LOGICA AUTOMATIZACIÓN PROYECTO
            if ($estado == SolicitudesPresupuesto::ESTADO_SOLICITUD_CONTRATADO) {
                // 1. Buscar si existe usuario cliente con ese email
                $cliente = \common\models\User::findOne(['email' => $model->email_contacto]);
                
                if (!$cliente) {
                    Yii::$app->session->addFlash('warning', 'No se ha encontrado un usuario registrado con el email de contacto. El proyecto se creará sin cliente asignado (o asigna manualmente).');
                }

                // 2. Crear Proyecto
                $proyecto = new \common\models\Proyectos();
                $proyecto->nombre = "Implantación: " . ($model->servicio ? $model->servicio->nombre : 'Servicio Personalizado');
                $proyecto->descripcion = "Generado automáticamente desde solicitud #" . $model->id . "\n\n" . $model->descripcion_necesidad;
                $proyecto->cliente_id = $cliente ? $cliente->id : null; // Asignar si existe
                $proyecto->servicio_id = $model->servicio_id;
                $proyecto->fecha_inicio = date('Y-m-d');
                $proyecto->estado = \common\models\Proyectos::ESTADO_PLANIFICACION;
                $proyecto->creado_por = Yii::$app->user->id; 

                if ($proyecto->save()) {
                     Yii::$app->session->addFlash('success', 'Proyecto #' . $proyecto->id . ' creado automáticamente.');
                } else {
                     Yii::$app->session->addFlash('error', 'Error al crear proyecto automático: ' . json_encode($proyecto->errors));
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'Error al actualizar el estado.');
        }

        return $this->redirect(['view', 'id' => $model->id]);
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
    /**
     * Genera y descarga el PDF de instrucciones de pago (Opción B)
     */
    public function actionGenerarPdfPago($id)
    {
        $model = $this->findModel($id);
        
        // Aseguramos estado Pendiente
        if ($model->estado_solicitud !== SolicitudesPresupuesto::ESTADO_SOLICITUD_PENDIENTE) {
             $model->estado_solicitud = SolicitudesPresupuesto::ESTADO_SOLICITUD_PENDIENTE;
             $model->save(false);
        }

        // Renderizar vista
        $content = $this->renderPartial('_pdf_pago', [
            'model' => $model,
        ]);

        // Generar PDF
        $pdf = new \Mpdf\Mpdf();
        $pdf->WriteHTML($content);
        
        $filename = 'Instrucciones_Pago_' . str_pad($model->id, 5, '0', STR_PAD_LEFT) . '.pdf';
        
        return $pdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
    }
}
