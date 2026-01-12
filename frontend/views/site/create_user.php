<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\SignupForm $model */

$this->title = 'Registrar Nuevo Empleado';
$this->params['breadcrumbs'][] = ['label' => 'Mis Empleados', 'url' => ['usuarios']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-create-user">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Rellene los sguientes campos para dar de alta un nuevo empleado en su organización:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Nombre Completo') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
