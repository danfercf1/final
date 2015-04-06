<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estudiantes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DISTRITO_EDUCATIVO') ?>

    <?= $form->field($model, 'MATERIA') ?>

    <?= $form->field($model, 'CURSO') ?>

    <?= $form->field($model, 'NOMBRE') ?>

    <?= $form->field($model, 'Ap_PATERNO') ?>

    <?= $form->field($model, 'Ap_MATERNO') ?>

    <?= $form->field($model, 'RUDE') ?>

    <?= $form->field($model, 'GENERO') ?>

    <?= $form->field($model, 'CI') ?>

    <?= $form->field($model, 'FECHA_NAC') ?>

    <?= $form->field($model, 'CORREO') ?>

    <?= $form->field($model, 'FONO') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
