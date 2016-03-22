<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */

$this->title = 'Editar: ' . ' ' . $model->nombreCompleto();
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes: Exploracion de datos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombreCompleto(), 'url'=>['view', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = 'Editar...';

?>
<div class="estudiantes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
