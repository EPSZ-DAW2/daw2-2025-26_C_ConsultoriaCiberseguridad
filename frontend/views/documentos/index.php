<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Gestor Documental';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> Aquí encontrará los informes, procedimientos y documentación técnica compartida por nuestros consultores.
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Mostrando <b>{begin}-{end}</b> de <b>{totalCount}</b> documentos',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'nombre_archivo',
                'label' => 'Archivo',
                'format' => 'raw',
                'value' => function ($model) {
                    $icon = '<i class="fas fa-file-pdf text-danger"></i> '; // Asumimos PDF mayormente
                    return $icon . Html::encode($model->nombre_archivo);
                }
            ],
            [
                'attribute' => 'tipo_documento',
                'label' => 'Tipo',
                'value' => function ($model) {
                    return $model->displayTipoDocumento();
                }
            ],
            [
                'attribute' => 'fecha_subida',
                'label' => 'Fecha de Publicación',
                'format' => ['date', 'php:d/m/Y H:i'],
            ],
            [
                'attribute' => 'proyecto.nombre',
                'label' => 'Proyecto Relacionado',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{descargar}',
                'buttons' => [
                    'descargar' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-download"></i> Descargar', 
                            ['descargar', 'id' => $model->id], 
                            ['class' => 'btn btn-sm btn-primary', 'title' => 'Descargar Documento', 'data-pjax' => '0']
                        );
                    },
                ],
            ],
        ],
    ]); ?>

</div>
