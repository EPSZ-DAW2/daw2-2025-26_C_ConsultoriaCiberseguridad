<?php

use common\models\ProgresoUsuario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Progreso de Alumnos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="progreso-usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-info">
        Aquí puedes ver las notas y el estado de los alumnos en los cursos de formación.
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'curso_id',
                'value' => 'curso.nombre',
                'label' => 'Curso',
            ],
            [
                'attribute' => 'usuario_id',
                'value' => 'usuario.nombre', // Asumiendo que User tiene 'nombre' o 'username'
                'label' => 'Alumno',
            ],
            [
                'attribute' => 'estado',
                'format' => 'raw',
                'value' => function($model) {
                    $color = match($model->estado) {
                        'Aprobado' => 'success',
                        'Suspenso' => 'danger',
                        default => 'warning'
                    };
                    return "<span class='badge bg-$color'>{$model->estado}</span>";
                }
            ],
            [
                'attribute' => 'nota_obtenida',
                'value' => function($model) {
                    return $model->nota_obtenida !== null ? $model->nota_obtenida . ' / 10' : '-';
                }
            ],
            'diapositiva_actual',
            'fecha_fin:datetime',

            [
                'class' => ActionColumn::className(),
                'template' => '{view} {delete}', // Limitamos acciones
                'urlCreator' => function ($action, ProgresoUsuario $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
