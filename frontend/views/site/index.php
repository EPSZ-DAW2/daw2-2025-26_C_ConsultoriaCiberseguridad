<?php

/** @var yii\web\View $this */
use yii\helpers\Url;

$this->title = 'CyberSec Consulting - Seguridad para tu empresa';
?>
<div class="site-index">

    <!-- Hero Section -->
    <div class="p-5 mb-4 bg-dark text-white rounded-3 shadow" style="background: linear-gradient(135deg, #1f2937 0%, #111827 100%);">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-3 fw-bold">Protege tu negocio ahora</h1>
            <p class="fs-4 text-light opacity-75 mb-4">Soluciones integrales de ciberseguridad, auditoría y cumplimiento normativo.</p>
            <p>
                <a class="btn btn-primary btn-lg px-5 me-3" href="<?= Url::to(['site/catalogo']) ?>">Ver Servicios</a>
                <a class="btn btn-outline-light btn-lg px-5" href="<?= Url::to(['site/contact']) ?>">Contactar</a>
            </p>
        </div>
    </div>

    <div class="body-content">

        <div class="row text-center mt-5">
            <div class="col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="mb-3 text-primary"><i class="fas fa-shield-alt fa-3x"></i></div> <!-- Icono si FontAwesome está cargado -->
                        <h2 class="h4">Auditoría de Seguridad</h2>
                        <p class="text-muted">Evaluamos tus sistemas para identificar vulnerabilidades antes que los ciberdelincuentes.</p>
                        <p><a class="btn btn-link text-decoration-none" href="<?= Url::to(['site/catalogo']) ?>">Saber más &raquo;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                         <div class="mb-3 text-primary"><i class="fas fa-file-contract fa-3x"></i></div>
                        <h2 class="h4">Cumplimiento Normativo</h2>
                        <p class="text-muted">Te ayudamos a cumplir con GDPR, ENS, ISO 27001 y otras normativas esenciales.</p>
                        <p><a class="btn btn-link text-decoration-none" href="<?= Url::to(['site/catalogo']) ?>">Saber más &raquo;</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                         <div class="mb-3 text-primary"><i class="fas fa-user-shield fa-3x"></i></div>
                        <h2 class="h4">Consultoría Estratégica</h2>
                        <p class="text-muted">Diseñamos planes de seguridad a medida para garantizar la continuidad de tu negocio.</p>
                        <p><a class="btn btn-link text-decoration-none" href="<?= Url::to(['site/catalogo']) ?>">Consultar &raquo;</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 py-5 bg-light rounded">
            <div class="col-12 text-center">
                <h3 class="mb-4">¿Por qué elegirnos?</h3>
            </div>
            <div class="col-md-6 px-5">
                <h4>Experiencia Certificada</h4>
                <p>Nuestro equipo cuenta con las certificaciones más reconocidas del mercado (CISA, CISM, CISSP).</p>
            </div>
            <div class="col-md-6 px-5">
                <h4>Soporte 24/7</h4>
                <p>Monitorización continua y respuesta ante incidentes en cualquier momento.</p>
            </div>
        </div>

    </div>
</div>
