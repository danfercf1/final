<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UeBusqueda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ue-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, '_id') ?>

    <?= $form->field($model, 'NOMBRE') ?>

    <?= $form->field($model, 'CODIGOSIE') ?>

    <?= $form->field($model, 'DEPENDENCIA') ?>

    <?= $form->field($model, 'AREA') ?>

    <?php // echo $form->field($model, 'PROVINCIA') ?>

    <?php // echo $form->field($model, 'LOCALIDAD') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
