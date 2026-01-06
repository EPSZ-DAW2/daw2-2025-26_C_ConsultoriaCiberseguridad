<?php

/** @var yii\web\View $this */
/** @var common\models\Cursos $curso */
/** @var float $nota */
/** @var int $aciertos */
/** @var int $total */
/** @var string $estado */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Resultados del Examen';
$isAprobado = ($estado == 'Aprobado');
?>

<div class="curso-resultado container mt-5 text-center">

    <div class="card shadow-lg border-0" style="max-width: 600px; margin: 0 auto; overflow: hidden;">
        
        <div class="card-header py-4 <?= $isAprobado ? 'bg-success' : 'bg-danger' ?> text-white">
            <h1 class="display-1 mb-0"><i class="fas <?= $isAprobado ? 'fa-check-circle' : 'fa-times-circle' ?>"></i></h1>
            <h2 class="mt-2"><?= $isAprobado ? '¡ENHORABUENA!' : '¡VAYA FAENA!' ?></h2>
        </div>

        <div class="card-body p-5">
            <h3 class="text-secondary mb-4"><?= $curso->nombre ?></h3>
            
            <div class="row mb-4">
                <div class="col-6 border-end">
                    <small class="text-muted text-uppercase">Nota Final</small>
                    <div class="display-4 fw-bold <?= $isAprobado ? 'text-success' : 'text-danger' ?>">
                        <?= $nota ?>
                        <span class="fs-4 text-muted">/ 10</span>
                    </div>
                </div>
                <div class="col-6">
                    <small class="text-muted text-uppercase">Aciertos</small>
                    <div class="display-4 fw-bold text-dark">
                        <?= $aciertos ?>
                        <span class="fs-4 text-muted">/ <?= $total ?></span>
                    </div>
                </div>
            </div>

            <p class="lead mb-4">
                <?php if ($isAprobado): ?>
                    Has superado el curso con éxito. Tu progreso ha sido registrado y tu certificado ya está en camino.
                <?php else: ?>
                    No has alcanzado la nota mínima de <strong><?= $curso->nota_minima_aprobado ?></strong>. No te preocupes, puedes volver a repasar el contenido y intentarlo de nuevo.
                <?php endif; ?>
            </p>

            <div class="d-grid gap-2">
                <a href="<?= Url::to(['index']) ?>" class="btn btn-outline-dark btn-lg">
                    <i class="fas fa-th"></i> Volver al Campus
                </a>
                
                <?php if (!$isAprobado): ?>
                    <a href="<?= Url::to(['contenido', 'id' => $curso->id, 'slide' => 1]) ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-sync"></i> Reintentar Curso
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>

</div>

<style>
    body { background-color: #e9ecef !important; color: #333; }
</style>
