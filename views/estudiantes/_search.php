<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstudiantesBusqueda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estudiantes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, '_id') ?>

    <?= $form->field($model, 'DISTRITO_EDUCATIVO') ?>

    <?= $form->field($model, 'MATERIA') ?>

    <?= $form->field($model, 'CURSO') ?>

    <?= $form->field($model, 'NOMBRE') ?>

    <?php // echo $form->field($model, 'Ap_PATERNO') ?>

    <?php // echo $form->field($model, 'Ap_MATERNO') ?>

    <?php // echo $form->field($model, 'RUDE') ?>

    <?php // echo $form->field($model, 'GENERO') ?>

    <?php // echo $form->field($model, 'CI') ?>

    <?php // echo $form->field($model, 'FECHA_NAC') ?>

    <?php // echo $form->field($model, 'CORREO') ?>

    <?php // echo $form->field($model, 'FONO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
