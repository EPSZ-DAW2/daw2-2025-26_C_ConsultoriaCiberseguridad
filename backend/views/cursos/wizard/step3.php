<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $cursoData */
/** @var int $numDiapositivas */

$this->title = 'Wizard de Creación de Curso - Paso 3';
?>
<div class="cursos-wizard-step3">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- indicador de progreso -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h5><i class="fas fa-check-circle"></i> Paso 1: Datos Básicos</h5>
                    <small>Completado</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h5><i class="fas fa-check-circle"></i> Paso 2: Diapositivas</h5>
                    <small>Completado</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5><i class="fas fa-check-circle"></i> Paso 3: Preguntas</h5>
                    <small>Activo</small>
                </div>
            </div>
        </div>
    </div>

    <!-- resumen pasos anteriores -->
    <div class="alert alert-success">
        <h5><i class="fas fa-check-double"></i> Resumen del Curso</h5>
        <p><strong>Nombre:</strong> <?= Html::encode($cursoData['nombre']) ?></p>
        <p class="mb-0"><strong>Diapositivas creadas:</strong> <?= $numDiapositivas ?></p>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Preguntas del Cuestionario Final</h4>
                <button type="button" class="btn btn-success" onclick="addPregunta()">
                    <i class="fas fa-plus"></i> Añadir Pregunta
                </button>
            </div>

            <p class="text-muted">Total de preguntas: <span id="contador-preguntas">0</span></p>

            <form method="post" action="<?= Url::to(['create-wizard', 'step' => 3]) ?>" id="form-preguntas">
                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

                <div id="preguntas-container">
                    <!-- las preguntas se añaden aqui dinamicamente -->
                </div>

                <div class="form-group mt-4">
                    <?= Html::a('<i class="fas fa-arrow-left"></i> Volver al Paso 2', ['create-wizard', 'step' => 2], [
                        'class' => 'btn btn-secondary'
                    ]) ?>

                    <?= Html::a('Cancelar', ['cancel-wizard'], [
                        'class' => 'btn btn-outline-secondary',
                        'data-confirm' => '¿seguro que quieres cancelar el wizard? se perderan todos los datos'
                    ]) ?>

                    <?= Html::submitButton('<i class="fas fa-check"></i> Finalizar y Crear Curso', [
                        'class' => 'btn btn-success btn-lg float-end',
                        'data-confirm' => '¿crear el curso con todas las diapositivas y preguntas?'
                    ]) ?>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
let contadorPreguntas = 0;

function addPregunta(enunciado = '', opcion_a = '', opcion_b = '', opcion_c = '', opcion_correcta = '') {
    const id = contadorPreguntas;
    const container = document.getElementById('preguntas-container');

    const card = document.createElement('div');
    card.className = 'card mb-3 pregunta-card';
    card.id = 'pregunta-' + id;
    card.innerHTML = `
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <span><i class="fas fa-question-circle"></i> Pregunta #${id + 1}</span>
            <button type="button" class="btn btn-sm btn-danger" onclick="removePregunta(${id})">
                <i class="fas fa-trash"></i> Eliminar
            </button>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Enunciado de la Pregunta*</label>
                <textarea name="preguntas[${id}][enunciado_pregunta]" class="form-control" rows="2" required>${enunciado}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Opción A*</label>
                        <input type="text" name="preguntas[${id}][opcion_a]" class="form-control"
                               value="${opcion_a}" required maxlength="255">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Opción B*</label>
                        <input type="text" name="preguntas[${id}][opcion_b]" class="form-control"
                               value="${opcion_b}" required maxlength="255">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Opción C*</label>
                        <input type="text" name="preguntas[${id}][opcion_c]" class="form-control"
                               value="${opcion_c}" required maxlength="255">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Respuesta Correcta*</label>
                <select name="preguntas[${id}][opcion_correcta]" class="form-control" required>
                    <option value="">Selecciona la opción correcta...</option>
                    <option value="a" ${opcion_correcta === 'a' ? 'selected' : ''}>A</option>
                    <option value="b" ${opcion_correcta === 'b' ? 'selected' : ''}>B</option>
                    <option value="c" ${opcion_correcta === 'c' ? 'selected' : ''}>C</option>
                </select>
            </div>
        </div>
    `;

    container.appendChild(card);
    contadorPreguntas++;
    actualizarContador();
}

function removePregunta(id) {
    const card = document.getElementById('pregunta-' + id);
    if (card && confirm('¿eliminar esta pregunta?')) {
        card.remove();
        actualizarContador();
    }
}

function actualizarContador() {
    const total = document.querySelectorAll('.pregunta-card').length;
    document.getElementById('contador-preguntas').textContent = total;
}

// añadir una pregunta inicial si no hay ninguna
if (contadorPreguntas === 0) {
    addPregunta();
}
</script>

<style>
.pregunta-card {
    border-left: 4px solid #28a745;
}
</style>
