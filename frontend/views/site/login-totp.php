<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Verificación en dos pasos';
?>
<div class="site-login-totp d-flex flex-column align-items-center justify-content-center" style="min-height: 60vh;">
    <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <i class="fas fa-shield-alt text-primary" style="font-size: 48px;"></i>
            <h1 class="h3 mt-3 fw-normal"><?= Html::encode($this->title) ?></h1>
            <p class="text-muted small">
                Introduce el código de verificación de 6 dígitos generado por tu aplicación de autenticación.
            </p>
        </div>

        <?php $form = ActiveForm::begin(['id' => 'login-totp-form']); ?>

            <div class="mb-3">
                <input type="text" name="totp_code" class="form-control form-control-lg text-center" 
                       placeholder="000 000" maxlength="6" autofocus required 
                       style="letter-spacing: 0.5em; font-weight: bold; font-size: 24px;">
            </div>

            <div class="form-group d-grid gap-2">
                <?= Html::submitButton('Verificar', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>

        <div class="mt-4 text-center">
            <a href="<?= \yii\helpers\Url::to(['site/login']) ?>" class="small text-decoration-none text-muted">Volver al inicio de sesión</a>
        </div>
    </div>
</div>
