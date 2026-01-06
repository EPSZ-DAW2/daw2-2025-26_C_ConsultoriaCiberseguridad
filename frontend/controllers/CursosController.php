<?php

namespace frontend\controllers;

use Yii;
use common\models\Cursos;
use common\models\Proyectos;
use common\models\Servicios;
use common\models\Diapositivas;
use common\models\PreguntasCuestionario;
use common\models\ProgresoUsuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

/**
 * CursosController handles the access and display of courses.
 */
class CursosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'ver', 'contenido', 'examen', 'calificar'],
                'rules' => [
                    [
                        'actions' => ['index', 'ver', 'contenido', 'examen', 'calificar'],
                        'allow' => true,
                        'roles' => ['@'], // Only logged in users (Clients)
                    ],
                ],
            ],
        ];
    }

    /**
     * Checks if the current user has access to training courses.
     * Logic: Must have at least one active project with Service Category = 'Formación'.
     * @return bool
     */
    protected function hasAccess()
    {
        $userId = Yii::$app->user->id;

        $hasFormacion = Proyectos::find()
            ->alias('p')
            ->joinWith('servicio s')
            ->where(['p.cliente_id' => $userId])
            ->andWhere(['s.categoria' => Servicios::CATEGORIA_FORMACION])
            // Opcional: Filtrar por estado del proyecto (por ahora "si existe contrato")
            // ->andWhere(['IN', 'p.estado', [Proyectos::ESTADO_EN_CURSO, Proyectos::ESTADO_FINALIZADO]])
            ->exists();

        return $hasFormacion;
    }

    /**
     * Lists all Cursos or shows Restricted banner.
     * @return string
     */
    public function actionIndex()
    {
        if (!$this->hasAccess()) {
            return $this->render('restricted');
        }

        $cursos = Cursos::find()->where(['activo' => 1])->all();

        return $this->render('index', [
            'cursos' => $cursos,
        ]);
    }

    /**
     * Displays a single Cursos model (Video Player).
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionVer($id)
    {
        if (!$this->hasAccess()) {
            return $this->render('restricted');
        }

        $model = $this->findModel($id);

        return $this->render('ver', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Cursos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
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

    // --- VISOR DE DIAPOSITIVAS ---

    public function actionContenido($id, $slide = 1)
    {
        if (!$this->hasAccess()) return $this->render('restricted');

        $curso = $this->findModel($id);
        
        // Buscar la diapositiva por orden
        $diapositiva = Diapositivas::find()
            ->where(['curso_id' => $id, 'numero_orden' => $slide])
            ->one();

        if (!$diapositiva) {
            // Si piden slide 5 y hay 4, enviar al examen o volver al inicio
            // Ojo: Mejor comprobar si $slide > total
            $total = Diapositivas::find()->where(['curso_id' => $id])->count();
            if ($slide > $total) {
                return $this->redirect(['examen', 'id' => $id]);
            }
            throw new NotFoundHttpException('Diapositiva no encontrada.');
        }

        // --- TRACKING PROGRESO ---
        $progreso = ProgresoUsuario::findOne(['usuario_id' => Yii::$app->user->id, 'curso_id' => $id]);
        if (!$progreso) {
            $progreso = new ProgresoUsuario();
            $progreso->usuario_id = Yii::$app->user->id;
            $progreso->curso_id = $id;
            $progreso->fecha_inicio = date('Y-m-d H:i:s');
            $progreso->estado = ProgresoUsuario::ESTADO_EN_CURSO;
            $progreso->diapositiva_actual = 1;
        }

        // Actualizamos "diapositiva_actual" solo si estamos avanzando
        if ($slide > $progreso->diapositiva_actual) {
            $progreso->diapositiva_actual = $slide;
        }
        $progreso->save();

        // Datos para la vista
        $totalSlides = Diapositivas::find()->where(['curso_id' => $id])->count();

        return $this->render('contenido', [
            'curso' => $curso,
            'diapositiva' => $diapositiva,
            'currentSlide' => (int)$slide,
            'totalSlides' => (int)$totalSlides
        ]);
    }

    // --- EXAMEN ---

    public function actionExamen($id)
    {
        if (!$this->hasAccess()) return $this->render('restricted');

        $curso = $this->findModel($id);
        
        // SEGURIDAD: ¿Ha visto todas las slides?
        $totalSlides = Diapositivas::find()->where(['curso_id' => $id])->count();
        $progreso = ProgresoUsuario::findOne(['usuario_id' => Yii::$app->user->id, 'curso_id' => $id]);

        // Si no hay progreso o no ha llegado a la última (y no ha aprobado ya)...
        if (!$progreso || ($progreso->diapositiva_actual < $totalSlides && !$progreso->isEstadoAprobado())) {
            Yii::$app->session->setFlash('warning', '¡No corras! Debes ver todas las diapositivas antes del examen.');
            return $this->redirect(['contenido', 'id' => $id, 'slide' => $progreso->diapositiva_actual ?? 1]);
        }

        $preguntas = PreguntasCuestionario::find()->where(['curso_id' => $id])->all();

        return $this->render('examen', [
            'curso' => $curso,
            'preguntas' => $preguntas,
        ]);
    }

    public function actionCalificar($id)
    {
        if (!$this->hasAccess()) return $this->render('restricted');
        
        $request = Yii::$app->request;
        if (!$request->isPost) return $this->redirect(['examen', 'id' => $id]);

        $respuestasUsuario = $request->post('Respuestas', []); // Array [pregunta_id => opcion_elegida]
        $preguntas = PreguntasCuestionario::find()->where(['curso_id' => $id])->all();

        $totalPreguntas = count($preguntas);
        $aciertos = 0;

        foreach ($preguntas as $p) {
            if (isset($respuestasUsuario[$p->id]) && $respuestasUsuario[$p->id] == $p->opcion_correcta) {
                $aciertos++;
            }
        }

        // Calcular Nota (0-10)
        $nota = ($totalPreguntas > 0) ? ($aciertos / $totalPreguntas) * 10 : 0;
        $nota = round($nota, 2);

        // Guardar Progreso
        $curso = $this->findModel($id);
        $progreso = ProgresoUsuario::findOne(['usuario_id' => Yii::$app->user->id, 'curso_id' => $id]);
        
        if ($progreso) {
            $progreso->cuestionario_realizado = 1;
            $progreso->nota_obtenida = $nota;
            $progreso->fecha_fin = date('Y-m-d H:i:s');
            
            if ($nota >= $curso->nota_minima_aprobado) {
                $progreso->estado = ProgresoUsuario::ESTADO_APROBADO;
            } else {
                $progreso->estado = ProgresoUsuario::ESTADO_SUSPENSO;
            }
            $progreso->save();
        }

        return $this->render('resultado', [
            'curso' => $curso,
            'nota' => $nota,
            'aciertos' => $aciertos,
            'total' => $totalPreguntas,
            'estado' => $progreso->estado
        ]);
    }
}
