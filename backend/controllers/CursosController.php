<?php

namespace backend\controllers;

use common\models\Cursos;
use common\models\Diapositivas;
use common\models\PreguntasCuestionario;
use backend\models\CursosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * CursosController implements the CRUD actions for Cursos model.
 */
class CursosController extends Controller
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
                            'allow' => true,
                            'roles' => ['gestionarFormacion'], // consultor, admin
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Cursos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CursosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cursos model.
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
     * Creates a new Cursos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cursos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cursos model.
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
     * Deletes an existing Cursos model.
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

    // wizard para crear curso completo con diapositivas y preguntas en 3 pasos
    public function actionCreateWizard($step = 1)
    {
        $session = Yii::$app->session;

        // paso 1: datos basicos del curso
        if ($step == 1) {
            $model = new Cursos();

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->validate()) {
                    // guardar datos del curso en sesion
                    $session->set('wizard_curso_data', $model->attributes);
                    return $this->redirect(['create-wizard', 'step' => 2]);
                }
            } else {
                $model->loadDefaultValues();
                // cargar desde sesion si existe
                if ($session->has('wizard_curso_data')) {
                    $model->attributes = $session->get('wizard_curso_data');
                }
            }

            return $this->render('wizard/step1', [
                'model' => $model,
            ]);
        }

        // paso 2: añadir diapositivas
        if ($step == 2) {
            // verificar que paso 1 esta completo
            if (!$session->has('wizard_curso_data')) {
                Yii::$app->session->setFlash('error', 'debes completar el paso 1 primero');
                return $this->redirect(['create-wizard', 'step' => 1]);
            }

            $cursoData = $session->get('wizard_curso_data');

            if ($this->request->isPost) {
                $diapositivas = $this->request->post('diapositivas', []);

                // validar que hay al menos 1 diapositiva
                if (empty($diapositivas)) {
                    Yii::$app->session->setFlash('error', 'debes añadir al menos 1 diapositiva');
                } else {
                    // validar cada diapositiva
                    $validas = true;
                    foreach ($diapositivas as $diapo) {
                        if (empty($diapo['titulo']) || empty($diapo['numero_orden'])) {
                            $validas = false;
                            break;
                        }
                    }

                    if ($validas) {
                        // guardar diapositivas en sesion
                        $session->set('wizard_diapositivas', $diapositivas);
                        return $this->redirect(['create-wizard', 'step' => 3]);
                    } else {
                        Yii::$app->session->setFlash('error', 'todas las diapositivas deben tener titulo y numero de orden');
                    }
                }
            }

            // cargar diapositivas desde sesion si existen
            $diapositivas = $session->get('wizard_diapositivas', []);

            return $this->render('wizard/step2', [
                'cursoData' => $cursoData,
                'diapositivas' => $diapositivas,
            ]);
        }

        // paso 3: añadir preguntas y guardar todo
        if ($step == 3) {
            // verificar que pasos anteriores estan completos
            if (!$session->has('wizard_curso_data') || !$session->has('wizard_diapositivas')) {
                Yii::$app->session->setFlash('error', 'debes completar los pasos anteriores primero');
                return $this->redirect(['create-wizard', 'step' => 1]);
            }

            $cursoData = $session->get('wizard_curso_data');
            $diapositivasData = $session->get('wizard_diapositivas');

            if ($this->request->isPost) {
                $preguntas = $this->request->post('preguntas', []);

                // validar que hay al menos 1 pregunta
                if (empty($preguntas)) {
                    Yii::$app->session->setFlash('error', 'debes añadir al menos 1 pregunta');
                } else {
                    // validar cada pregunta
                    $validas = true;
                    foreach ($preguntas as $preg) {
                        if (empty($preg['enunciado_pregunta']) || empty($preg['opcion_a']) ||
                            empty($preg['opcion_b']) || empty($preg['opcion_c']) ||
                            empty($preg['opcion_correcta'])) {
                            $validas = false;
                            break;
                        }
                    }

                    if ($validas) {
                        // guardar todo en transaccion
                        $transaction = Yii::$app->db->beginTransaction();
                        try {
                            // 1. crear curso
                            $curso = new Cursos();
                            $curso->attributes = $cursoData;
                            if (!$curso->save()) {
                                throw new \Exception('error al guardar el curso');
                            }

                            // 2. crear diapositivas
                            foreach ($diapositivasData as $diapoData) {
                                $diapositiva = new Diapositivas();
                                $diapositiva->attributes = $diapoData;
                                $diapositiva->curso_id = $curso->id;
                                if (!$diapositiva->save()) {
                                    throw new \Exception('error al guardar diapositiva');
                                }
                            }

                            // 3. crear preguntas
                            foreach ($preguntas as $pregData) {
                                $pregunta = new PreguntasCuestionario();
                                $pregunta->attributes = $pregData;
                                $pregunta->curso_id = $curso->id;
                                if (!$pregunta->save()) {
                                    throw new \Exception('error al guardar pregunta');
                                }
                            }

                            $transaction->commit();

                            // limpiar sesion
                            $session->remove('wizard_curso_data');
                            $session->remove('wizard_diapositivas');

                            Yii::$app->session->setFlash('success', 'curso creado exitosamente con todas sus diapositivas y preguntas');
                            return $this->redirect(['view', 'id' => $curso->id]);

                        } catch (\Exception $e) {
                            $transaction->rollBack();
                            Yii::$app->session->setFlash('error', 'error al guardar: ' . $e->getMessage());
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'todas las preguntas deben tener todos los campos completos');
                    }
                }
            }

            return $this->render('wizard/step3', [
                'cursoData' => $cursoData,
                'numDiapositivas' => count($diapositivasData),
            ]);
        }

        // paso invalido, redirigir a paso 1
        return $this->redirect(['create-wizard', 'step' => 1]);
    }

    // cancelar el wizard y limpiar sesion
    public function actionCancelWizard()
    {
        $session = Yii::$app->session;
        $session->remove('wizard_curso_data');
        $session->remove('wizard_diapositivas');
        Yii::$app->session->setFlash('info', 'wizard cancelado');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Cursos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cursos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cursos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
