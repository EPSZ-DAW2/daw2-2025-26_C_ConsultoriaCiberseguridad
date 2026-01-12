<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Sobre Nosotros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Esta es la página "Sobre Nosotros" de CyberSec Manager. Aquí puede describir la misión y visión de la empresa.</p>

    <code><?= __FILE__ ?></code>
</div>
