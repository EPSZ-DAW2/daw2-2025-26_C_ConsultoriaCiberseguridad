<?php

namespace backend\controllers;

use Yii;
use common\models\Documentos;
use backend\models\DocumentosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * DocumentosController implements the CRUD actions for Documentos model.
 */
class DocumentosController extends Controller
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
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'descargar'],
                            'allow' => true,
                            'roles' => ['verDocs'], // consultor, auditor, manager, admin
                        ],
                        [
                            'actions' => ['create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['subirDocs'], // solo consultor y admin
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => \yii\filters\VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Documentos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DocumentosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documentos model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Documentos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Documentos();
        
        // Valores por defecto
        $model->fecha_subida = date('Y-m-d H:i:s');
        $model->subido_por = Yii::$app->user->id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                
                // 1. Instanciar el archivo
                $model->archivo_subido = UploadedFile::getInstance($model, 'archivo_subido');

                // DEBUG: Si no hay archivo, paramos y avisamos
                if (!$model->archivo_subido) {
                    echo "<h1>ERROR: No se ha recibido ningún archivo.</h1>";
                    echo "<p>Verifica que el archivo no supere los 2MB (límite de PHP) y que el form tenga enctype.</p>";
                    die();
                }

                if ($model->archivo_subido) {
                    // 2. Ruta segura
                    $nombreUnico = time() . '_' . $model->archivo_subido->baseName . '.' . $model->archivo_subido->extension;
                    $rutaCarpeta = Yii::getAlias('@backend') . '/../uploads/documentos/';
                    
                    // Crear carpeta si no existe
                    if (!is_dir($rutaCarpeta)) {
                        mkdir($rutaCarpeta, 0777, true);
                    }
                    
                    $rutaCompleta = $rutaCarpeta . $nombreUnico;

                    // 3. Asignar datos automáticos
                    $model->nombre_archivo = $model->archivo_subido->name;
                    $model->ruta_archivo = $rutaCompleta;
                    $model->tamaño_bytes = $model->archivo_subido->size;
                    $model->subido_por = 1;

                    // 4. Guardar
                    if ($model->save()) {
                        $model->archivo_subido->saveAs($rutaCompleta);
                        // Hash opcional
                        $model->hash_verificacion = hash_file('sha256', $rutaCompleta);
                        $model->save(false);

                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        // DEBUG: Si falla al guardar en BD, muestra por qué
                        echo "<pre>";
                        var_dump($model->getErrors());
                        echo "</pre>";
                        die();
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Documentos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Documentos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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

    /**
     * Descarga el archivo de forma segura.
     * @param int $id ID del documento
     * @return mixed
     * @throws NotFoundHttpException si el archivo no existe
     */
    public function actionDescargar($id)
    {
        $model = $this->findModel($id);
        $rutaArchivo = $model->ruta_archivo;

        if (file_exists($rutaArchivo)) {
            // Yii2 tiene un helper maravilloso para esto: sendFile
            // Esto oculta la ruta real al usuario y fuerza la descarga
            return Yii::$app->response->sendFile($rutaArchivo, $model->nombre_archivo);
        }

        throw new NotFoundHttpException('El archivo físico no existe en el servidor.');
    }

}
