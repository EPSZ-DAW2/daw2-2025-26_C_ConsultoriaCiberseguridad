<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Presupuesto</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { width: 100%; border-bottom: 2px solid #ddd; padding-bottom: 20px; margin-bottom: 20px; }
        .company-info { text-align: right; }
        .company-name { font-size: 24px; font-weight: bold; color: #1a73e8; }
        .invoice-title { font-size: 32px; color: #555; margin-bottom: 5px; }
        .validity { font-size: 12px; color: #777; margin-top: 5px; }
        .details-table { width: 100%; margin-top: 30px; border-collapse: collapse; }
        .details-table th, .details-table td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        .details-table th { background-color: #f9f9f9; color: #555; }
        .total-row td { border-top: 2px solid #333; font-weight: bold; font-size: 18px; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 12px; color: #999; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <table width="100%">
            <tr>
                <td valign="top">
                    <div class="invoice-title">PRESUPUESTO</div>
                    <div><strong>Nº Presupuesto:</strong> P-<?= date('Y') ?>-<?= str_pad($solicitud->id, 5, '0', STR_PAD_LEFT) ?></div>
                    <div><strong>Fecha Emisión:</strong> <?= date('d/m/Y') ?></div>
                    <div class="validity">Válido hasta: <?= date('d/m/Y', strtotime('+30 days')) ?></div>
                </td>
                <td valign="top" class="company-info">
                    <div class="company-name">CyberSec Manager</div>
                    <div>C/ Falsa 123, Madrid, España</div>
                    <div>NIF: B-12345678</div>
                    <div>presupuestos@cybersec.com</div>
                </td>
            </tr>
        </table>
    </div>

    <div style="margin-bottom: 40px;">
        <h3>Datos del Cliente</h3>
        <div><strong>Nombre:</strong> <?= htmlspecialchars($model->nombre_contacto) ?></div>
        <div><strong>Empresa:</strong> <?= htmlspecialchars($model->empresa) ?></div>
        <div><strong>Email:</strong> <?= htmlspecialchars($model->email_contacto) ?></div>
        <?php if($model->nif_cif): ?>
        <div><strong>NIF/CIF:</strong> <?= htmlspecialchars($model->nif_cif) ?></div>
        <?php endif; ?>
    </div>

    <table class="details-table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Detalle</th>
                <th style="text-align: right;">Importe Estimado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($model->servicio ? $model->servicio->nombre : 'Servicio Personalizado') ?></td>
                <td>
                    <em><?= htmlspecialchars($model->descripcion_necesidad) ?></em><br>
                    <?php if($model->alcance_solicitado): ?>
                        <small>Alcance: <?= htmlspecialchars($model->alcance_solicitado) ?></small>
                    <?php endif; ?>
                </td>
                <td style="text-align: right;">
                    <?php 
                        $precio = $model->presupuesto_estimado ?? ($model->servicio ? $model->servicio->precio_base : 0);
                        echo number_format($precio, 2, ',', '.') . ' €';
                    ?>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: right; padding-right: 20px;">Subtotal</td>
                <td style="text-align: right;"><?= number_format($precio, 2, ',', '.') ?> €</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right; padding-right: 20px;">IVA (21%)</td>
                <td style="text-align: right;"><?= number_format($precio * 0.21, 2, ',', '.') ?> €</td>
            </tr>
            <tr class="total-row">
                <td colspan="2" style="text-align: right; padding-right: 20px;">TOTAL</td>
                <td style="text-align: right; color: #1a73e8;"><?= number_format($precio * 1.21, 2, ',', '.') ?> €</td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top: 50px; font-size: 14px; color: #666;">
        <p><strong>Términos y condiciones:</strong></p>
        <ul>
            <li>Este presupuesto tiene una validez de 30 días.</li>
            <li>Para aceptar este presupuesto, por favor firme y envíe una copia a nuestro correo electrónico.</li>
            <li>El inicio del proyecto está sujeto a disponibilidad de recursos.</li>
        </ul>
    </div>

    <div class="footer">
        CyberSec Manager S.L. - Presupuesto sin compromiso contractual hasta su aceptación
    </div>

</body>
</html>
