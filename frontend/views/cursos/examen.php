<?php

/** @var yii\web\View $this */
/** @var common\models\Cursos $curso */
/** @var common\models\PreguntasCuestionario[] $preguntas */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Examen Final: ' . $curso->nombre;
?>

<div class="curso-examen container mt-5">

    <div class="text-center text-white mb-5">
        <h1><i class="fas fa-file-signature text-warning"></i> Examen Final</h1>
        <p class="lead">Demuestra tu conocimiento. Necesitas un <?= $curso->nota_minima_aprobado ?> para aprobar.</p>
    </div>

    <div class="card bg-light shadow-lg">
        <div class="card-body p-5">
            
            <?php $form = ActiveForm::begin(['action' => ['calificar', 'id' => $curso->id], 'method' => 'post']); ?>

                <?php foreach ($preguntas as $index => $pregunta): ?>
                    <div class="mb-5 border-bottom pb-4">
                        <h4 class="mb-3 text-dark">
                            <span class="badge bg-dark me-2"><?= $index + 1 ?></span> 
                            <?= Html::encode($pregunta->enunciado_pregunta) ?>
                        </h4>

                        <div class="ms-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="Respuestas[<?= $pregunta->id ?>]" id="p<?= $pregunta->id ?>a" value="a" required>
                                <label class="form-check-label text-dark" for="p<?= $pregunta->id ?>a">
                                    <strong>a)</strong> <?= Html::encode($pregunta->opcion_a) ?>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="Respuestas[<?= $pregunta->id ?>]" id="p<?= $pregunta->id ?>b" value="b">
                                <label class="form-check-label text-dark" for="p<?= $pregunta->id ?>b">
                                    <strong>b)</strong> <?= Html::encode($pregunta->opcion_b) ?>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="Respuestas[<?= $pregunta->id ?>]" id="p<?= $pregunta->id ?>c" value="c">
                                <label class="form-check-label text-dark" for="p<?= $pregunta->id ?>c">
                                    <strong>c)</strong> <?= Html::encode($pregunta->opcion_c) ?>
                                </label>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg px-5 py-3 fw-bold" onclick="return confirm('¿Estás seguro de que quieres finalizar el examen? No podrás cambiar las respuestas.');">
                        <i class="fas fa-paper-plane"></i> ENVIAR RESPUESTAS
                    </button>
                </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>

<style>
    body { background-color: #2c3e50 !important; }
</style>
