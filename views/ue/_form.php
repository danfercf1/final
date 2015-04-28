<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOMBRE') ?>

    <?= $form->field($model, 'CODIGOSIE') ?>

    <?= $form->field($model, 'DEPENDENCIA') ?>

    <?= $form->field($model, 'AREA') ?>

    <?= $form->field($model, 'PROVINCIA') ?>

    <?= $form->field($model, 'LOCALIDAD') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
