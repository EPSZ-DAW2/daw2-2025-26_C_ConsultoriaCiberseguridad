<?php
/** @var common\models\SolicitudesPresupuesto $model */

use yii\helpers\Html;
?>
<div style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
    <table width="100%" style="border-bottom: 2px solid #555; padding-bottom: 20px;">
        <tr>
            <td width="60%">
                <h1 style="color: #003366;">CyberSec Manager</h1>
                <p>C/ Seguridad Informática, 12<br>28000 Madrid, España<br>CIF: B-12345678</p>
            </td>
            <td width="40%" style="text-align: right;">
                <h3>SOLICITUD DE TRANSFERENCIA</h3>
                <p><strong>Referencia:</strong> #<?= str_pad($model->id, 5, '0', STR_PAD_LEFT) ?></p>
                <p><strong>Fecha:</strong> <?= date('d/m/Y') ?></p>
            </td>
        </tr>
    </table>

    <br><br>

    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 5px;">
        <h3>Datos del Cliente</h3>
        <p><strong>Nombre:</strong> <?= Html::encode($model->nombre_contacto) ?></p>
        <p><strong>Email:</strong> <?= Html::encode($model->email_contacto) ?></p>
        <p><strong>Empresa:</strong> <?= Html::encode($model->empresa) ?></p>
    </div>

    <br><br>

    <h3>Detalle del Servicio</h3>
    <table width="100%" cellpadding="10" cellspacing="0" style="border: 1px solid #ddd;">
        <thead>
            <tr style="background-color: #eee;">
                <th align="left">Concepto</th>
                <th align="right">Precio Estimado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong><?= Html::encode($model->servicio ? $model->servicio->nombre : 'Consultoría Personalizada') ?></strong>
                    <br>
                    <small><?= Html::encode($model->descripcion_necesidad) ?></small>
                </td>
                <td align="right">
                   <?= $model->servicio ? number_format($model->servicio->precio_base, 2) . ' €' : 'A consultar' ?>
                </td>
            </tr>
        </tbody>
    </table>

    <br><br><br>

    <div style="border: 2px solid #003366; padding: 20px; text-align: center; background-color: #eef4f9;">
        <h2 style="color: #003366; margin-top: 0;">Instrucciones de Pago</h2>
        <p>Por favor, realice una transferencia bancaria a la siguiente cuenta:</p>
        
        <h3>IBAN: ES91 0049 1234 5678 9012 3456</h3>
        <p><strong>Beneficiario:</strong> CyberSec Manager S.L.</p>
        <p><strong>Concepto:</strong> Pago Ref #<?= str_pad($model->id, 5, '0', STR_PAD_LEFT) ?></p>
        
        <br>
        <p style="font-size: 12px; color: #666;">
            Una vez realizada la transferencia, envíe el justificante a <strong>comercial@cybersec.com</strong> o espere la validación de nuestro departamento financiero.
            <br>
            Su servicio se activará automáticamente tras la confirmación.
        </p>
    </div>
</div>
