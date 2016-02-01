<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estudiantes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DISTRITO') ?>

    <?= $form->field($model, 'MATERIA') ?>

    <?= $form->field($model, 'CURSO') ?>
    
    <?= $form->field($model, 'RUDE') ?>

    <?= $form->field($model, 'NOMBRE') ?>

    <?= $form->field($model, 'PATERNO') ?>

    <?= $form->field($model, 'MATERNO') ?>

    <?= $form->field($model, 'GENERO') ?>

    <?= $form->field($model, 'FECHA_NACIMIENTO') ?>
    
    <?= $form->field($model, 'CI') ?>

    <?= $form->field($model, 'FONO') ?>
    
    <?= $form->field($model, 'CORREO') ?>
    
    <?= $form->field($model, 'TUTOR') ?>
    
    <?= $form->field($model, 'UNIDAD_EDUCATIVA') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
