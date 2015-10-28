<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOMBRE_UE') ?>

    <?= $form->field($model, 'COD_SIE') ?>

    <?= $form->field($model, 'DEPENDENCIA') ?>

    <?= $form->field($model, 'AREA') ?>

    <?= $form->field($model, 'PROVINCIA') ?>

    <?= $form->field($model, 'CANTON') ?>

    <?= $form->field($model, 'SECCION') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
