<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tutor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tutor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOMBRE_T') ?>

    <?= $form->field($model, 'PATERNO_T') ?>

    <?= $form->field($model, 'MATERNO_T') ?>

    <?= $form->field($model, 'GENERO_T') ?>

    <?= $form->field($model, 'CI_T') ?>

    <?= $form->field($model, 'CORREO_T') ?>

    <?= $form->field($model, 'FONO_T') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
