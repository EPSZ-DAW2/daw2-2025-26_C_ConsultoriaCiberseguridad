<?php
/** @var common\models\Servicios $servicio */
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Pago Seguro con Tarjeta';
?>
<div class="row justify-content-center mt-5">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0"><i class="fas fa-lock me-2"></i> Pago Seguro SSL</h4>
            </div>
            <div class="card-body p-4">
                
                <!-- Resumen del Pedido -->
                <div class="alert alert-light border mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1 text-primary"><?= Html::encode($servicio->nombre) ?></h5>
                            <small class="text-muted">Servicio de Ciberseguridad Profesional</small>
                        </div>
                        <h4 class="mb-0 text-success"><?= number_format($servicio->precio_base, 2) ?> €</h4>
                    </div>
                </div>

                <!-- Formulario Simulado -->
                <form action="<?= Url::to(['site/procesar-pago']) ?>" method="post" id="payment-form">
                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                    <input type="hidden" name="servicio_id" value="<?= $servicio->id ?>">

                    <div class="mb-3">
                        <label class="form-label text-muted small">Titular de la Tarjeta</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-user text-secondary"></i></span>
                            <input type="text" class="form-control" placeholder="Como aparece en la tarjeta" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small">Número de Tarjeta</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-credit-card text-secondary"></i></span>
                            <input type="text" class="form-control" placeholder="0000 0000 0000 0000" maxlength="19" required>
                            <span class="input-group-text bg-white">
                                <i class="fab fa-cc-visa text-primary mx-1"></i>
                                <i class="fab fa-cc-mastercard text-danger mx-1"></i>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label text-muted small">Expiración (MM/YY)</label>
                            <input type="text" class="form-control" placeholder="MM/YY" maxlength="5" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label text-muted small">CVV / CVC</label>
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="123" maxlength="3" required>
                                <span class="input-group-text bg-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Son los 3 dígitos de seguridad situados en la parte trasera de tu tarjeta.">
                                    <i class="fas fa-question-circle text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="terms" required checked>
                        <label class="form-check-label small text-muted" for="terms">
                            Acepto los <a href="<?= Url::to(['site/terminos']) ?>" target="_blank">términos y condiciones</a> del servicio.
                        </label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg shadow-sm">
                            <i class="fas fa-check-circle me-2"></i> Pagar <?= number_format($servicio->precio_base, 2) ?> €
                        </button>
                        <a href="<?= Url::to(['site/catalogo']) ?>" class="btn btn-outline-secondary btn-sm mt-2">Cancelar y Volver</a>
                    </div>
                </form>
                
                <div class="text-center mt-4">
                    <p class="small text-muted mb-0"><i class="fas fa-shield-alt text-success"></i> Transacción cifrada de extremo a extremo (PCI-DSS Compliant)</p>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
// Inicializar Tooltips de Bootstrap
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

// Script simple para formatear tarjeta
document.querySelector('input[placeholder="0000 0000 0000 0000"]').addEventListener('input', function (e) {
    var value = e.target.value.replace(/\D/g, '').substring(0, 16);
    var formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
    e.target.value = formattedValue;
});
</script>
