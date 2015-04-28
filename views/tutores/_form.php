<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tutor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tutor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOMBRE') ?>

    <?= $form->field($model, 'PATERNO') ?>

    <?= $form->field($model, 'MATERNO') ?>

    <?= $form->field($model, 'GENERO') ?>

    <?= $form->field($model, 'CI') ?>

    <?= $form->field($model, 'CORREO') ?>

    <?= $form->field($model, 'FONO') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
