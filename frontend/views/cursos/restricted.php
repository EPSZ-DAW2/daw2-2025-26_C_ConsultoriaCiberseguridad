<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Campus de Formación';
?>
<div class="cursos-restricted text-center mt-5">
    
    <div class="alert alert-secondary py-5">
        <h1 class="display-4"><i class="fas fa-lock"></i> Contenido Exclusivo</h1>
        <p class="lead mt-3">
            Nuestro <strong>Campus de Ciberseguridad</strong> está reservado para clientes con contratos de formación activos.
        </p>
        <hr class="my-4">
        <p>
            ¿Quieres acceder a decenas de cursos especializados, laboratorios y certificaciones?
        </p>
        <p>
            <?= Html::a('Solicitar Presupuesto', ['/site/contact'], ['class' => 'btn btn-primary btn-lg']) ?>
            <?= Html::a('Ver Catálogo de Servicios', ['/site/catalogo'], ['class' => 'btn btn-outline-dark btn-lg']) ?>
        </p>
    </div>
    
    <div class="row mt-5 opacity-50" style="filter: blur(4px); pointer-events: none;">
        <!-- FALSO CONTENIDO DE FONDO PARA EFECTO "BLUR" -->
        <?php for($i=0; $i<3; $i++): ?>
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="https://via.placeholder.com/300x150?text=Curso+Bloqueado" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Curso Avanzado de Pentesting</p>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>

</div>
