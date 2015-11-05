<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Editar usuario: ' . ' ' . $model->nombreCompleto();
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombreCompleto(), 'url' => ['view', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = 'Editar...';
?>
<div class="usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
