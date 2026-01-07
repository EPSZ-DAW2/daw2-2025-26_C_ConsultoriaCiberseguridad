<?php
use yii\helpers\Html;

$this->title = 'CRM - Clientes Potenciales';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="crm-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <strong>Módulo en desarrollo</strong><br>
        Este módulo permitirá gestionar leads, oportunidades comerciales y pipeline de ventas.
        <br><br>
        <strong>Acceso:</strong> Comercial y Admin
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Funcionalidades futuras:</h5>
            <ul>
                <li>Gestión de leads y oportunidades</li>
                <li>Pipeline de ventas</li>
                <li>Seguimiento de propuestas comerciales</li>
                <li>Métricas de conversión</li>
                <li>Historial de contactos con clientes potenciales</li>
            </ul>
        </div>
    </div>
</div>
