<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Incidencias;

/** @var yii\web\View $this */
/** @var common\models\Incidencias $model */

$this->title = 'Reportar Incidente de Seguridad';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidencias-create">

    <div class="alert alert-warning">
        <h4><i class="fas fa-exclamation-triangle"></i> Sistema de Reportes de Incidencias SOC</h4>
        <p>Use este formulario para reportar cualquier incidente de seguridad que haya detectado. Nuestro equipo de analistas SOC revisará su reporte y tomará las acciones necesarias.</p>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true, 'placeholder' => 'Ej: Correo sospechoso de phishing recibido']) ?>

            <?= $form->field($model, 'descripcion')->textarea([
                'rows' => 6,
                'placeholder' => 'Describa el incidente con el mayor detalle posible: qué observó, cuándo ocurrió, qué sistemas están afectados, etc.'
            ]) ?>

            <?= $form->field($model, 'severidad')->dropDownList(
                Incidencias::optsSeveridad(),
                ['prompt' => 'Seleccione la severidad...']
            )->hint('Crítica = Afecta operaciones críticas inmediatamente | Alta = Impacto significativo | Media = Problema moderado | Baja = Sin impacto inmediato') ?>

            <?= $form->field($model, 'categoria_incidencia')->textInput([
                'maxlength' => true,
                'placeholder' => 'Ej: Phishing, Malware, Acceso no autorizado, DDoS, etc.'
            ])->hint('Opcional: Indique el tipo de amenaza si la conoce') ?>

            <?= $form->field($model, 'ip_origen')->textInput([
                'maxlength' => true,
                'placeholder' => 'Ej: 192.168.1.100'
            ])->hint('Opcional: IP desde donde se detectó la amenaza') ?>

            <?= $form->field($model, 'sistema_afectado')->textInput([
                'maxlength' => true,
                'placeholder' => 'Ej: Servidor web principal, Estación de trabajo del departamento X'
            ])->hint('Opcional: Sistema o equipo afectado') ?>

            <div class="form-group">
                <?= Html::submitButton('<i class="fas fa-paper-plane"></i> Enviar Reporte', ['class' => 'btn btn-danger btn-lg']) ?>
                <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-secondary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="alert alert-info mt-3">
        <h5>¿Qué ocurre después de enviar el reporte?</h5>
        <ol>
            <li>Su incidencia será asignada a un analista SOC</li>
            <li>Recibirá una respuesta inicial según el SLA establecido</li>
            <li>Podrá consultar el estado de su incidencia en cualquier momento</li>
            <li>Se le notificará cuando la incidencia sea resuelta</li>
        </ol>
    </div>

</div>
