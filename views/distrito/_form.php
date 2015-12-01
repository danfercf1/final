<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Distrito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distrito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOMBRE') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
