<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TutoresBusqueda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tutor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, '_id') ?>

    <?= $form->field($model, 'NOMBRE') ?>

    <?= $form->field($model, 'PATERNO') ?>

    <?= $form->field($model, 'MATERNO') ?>

    <?= $form->field($model, 'GENERO') ?>

    <?php // echo $form->field($model, 'CI') ?>

    <?php // echo $form->field($model, 'CORREO') ?>

    <?php // echo $form->field($model, 'FONO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
