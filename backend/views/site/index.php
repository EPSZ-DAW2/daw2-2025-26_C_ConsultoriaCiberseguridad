<?php

/** @var yii\web\View $this */

$this->title = 'Panel de Administración';
?>
<div class="site-index">
    <div class="admin-panel-header">
        <div class="container text-center py-5">
            <i class="fas fa-shield-alt fa-4x mb-4 text-primary"></i>
            <h1 class="display-4 mb-3">Panel de Administración</h1>
            <p class="lead text-muted">Consultora de Ciberseguridad</p>
        </div>
    </div>
</div>

<style>
.admin-panel-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 10px;
    margin: 50px auto;
    max-width: 800px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.admin-panel-header h1 {
    font-weight: 700;
    color: #2c3e50;
}

.admin-panel-header i {
    opacity: 0.8;
}
</style>
