<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $cursoData */
/** @var array $diapositivas */
/** @var bool $isUpdate */
/** @var int $cursoId */

$isUpdate = isset($isUpdate) && $isUpdate;
$cursoId = isset($cursoId) ? $cursoId : null;
$this->title = $isUpdate ? 'Wizard de Edición de Curso - Paso 2' : 'Wizard de Creación de Curso - Paso 2';
?>
<div class="cursos-wizard-step2">

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
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5><i class="fas fa-check-circle"></i> Paso 2: Diapositivas</h5>
                    <small>Activo</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary text-white">
                <div class="card-body text-center">
                    <h5><i class="fas fa-circle"></i> Paso 3: Preguntas</h5>
                    <small>Pendiente</small>
                </div>
            </div>
        </div>
    </div>

    <!-- resumen paso 1 -->
    <div class="alert alert-info">
        <h5><i class="fas fa-info-circle"></i> Resumen del Curso</h5>
        <p><strong>Nombre:</strong> <?= Html::encode($cursoData['nombre']) ?></p>
        <p class="mb-0"><strong>Descripción:</strong> <?= Html::encode($cursoData['descripcion']) ?></p>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Diapositivas del Curso</h4>
                <button type="button" class="btn btn-success" onclick="addDiapositiva()">
                    <i class="fas fa-plus"></i> Añadir Diapositiva
                </button>
            </div>

            <p class="text-muted">Total de diapositivas: <span id="contador-diapositivas">0</span></p>

            <?php
            if ($isUpdate) {
                $formAction = Url::to(['update-wizard', 'id' => $cursoId, 'step' => 2]);
                $backUrl = ['update-wizard', 'id' => $cursoId, 'step' => 1];
            } else {
                $formAction = Url::to(['create-wizard', 'step' => 2]);
                $backUrl = ['create-wizard', 'step' => 1];
            }
            ?>

            <form method="post" action="<?= $formAction ?>" id="form-diapositivas">
                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

                <div id="diapositivas-container">
                    <!-- las diapositivas se añaden aqui dinamicamente -->
                </div>

                <div class="form-group mt-4">
                    <?= Html::a('<i class="fas fa-arrow-left"></i> Volver al Paso 1', $backUrl, [
                        'class' => 'btn btn-secondary'
                    ]) ?>

                    <?= Html::a('Cancelar', ['cancel-wizard'], [
                        'class' => 'btn btn-outline-secondary',
                        'data-confirm' => '¿seguro que quieres cancelar el wizard? se perderan todos los datos'
                    ]) ?>

                    <?= Html::submitButton('Siguiente: Añadir Preguntas <i class="fas fa-arrow-right"></i>', [
                        'class' => 'btn btn-primary float-end'
                    ]) ?>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
let contadorDiapositivas = 0;

// cargar diapositivas existentes desde php
<?php if (!empty($diapositivas)): ?>
    <?php foreach ($diapositivas as $index => $diapo): ?>
        addDiapositiva(
            <?= json_encode($diapo['numero_orden'] ?? '') ?>,
            <?= json_encode($diapo['titulo'] ?? '') ?>,
            <?= json_encode($diapo['contenido_html'] ?? '') ?>,
            <?= json_encode($diapo['imagen_url'] ?? '') ?>,
            <?= json_encode($diapo['video_url'] ?? '') ?>
        );
    <?php endforeach; ?>
<?php endif; ?>

function addDiapositiva(numero_orden = '', titulo = '', contenido_html = '', imagen_url = '', video_url = '') {
    const id = contadorDiapositivas;
    const container = document.getElementById('diapositivas-container');

    // si no se pasa numero_orden, autocalcular
    if (numero_orden === '') {
        numero_orden = contadorDiapositivas + 1;
    }

    const card = document.createElement('div');
    card.className = 'card mb-3 diapositiva-card';
    card.id = 'diapositiva-' + id;
    card.innerHTML = `
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <span><i class="fas fa-file-powerpoint"></i> Diapositiva #${id + 1}</span>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeDiapositiva(${id})">
                <i class="fas fa-trash"></i> Eliminar
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Número de Orden*</label>
                        <input type="number" name="diapositivas[${id}][numero_orden]" class="form-control"
                               value="${numero_orden}" required min="1">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Título*</label>
                        <input type="text" name="diapositivas[${id}][titulo]" class="form-control"
                               value="${titulo}" required maxlength="200">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Contenido HTML</label>
                <textarea name="diapositivas[${id}][contenido_html]" class="form-control" rows="4">${contenido_html}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>URL de Imagen</label>
                        <input type="text" name="diapositivas[${id}][imagen_url]" class="form-control"
                               value="${imagen_url}" maxlength="255" placeholder="https://...">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>URL de Video</label>
                        <input type="text" name="diapositivas[${id}][video_url]" class="form-control"
                               value="${video_url}" maxlength="255" placeholder="https://...">
                    </div>
                </div>
            </div>
        </div>
    `;

    container.appendChild(card);
    contadorDiapositivas++;
    actualizarContador();
}

function removeDiapositiva(id) {
    const card = document.getElementById('diapositiva-' + id);
    if (card && confirm('¿eliminar esta diapositiva?')) {
        card.remove();
        actualizarContador();
    }
}

function actualizarContador() {
    const total = document.querySelectorAll('.diapositiva-card').length;
    document.getElementById('contador-diapositivas').textContent = total;
}

// añadir una diapositiva inicial si no hay ninguna
if (contadorDiapositivas === 0) {
    addDiapositiva();
}
</script>

<style>
.diapositiva-card {
    border-left: 4px solid #007bff;
}
</style>
