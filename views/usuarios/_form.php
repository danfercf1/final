<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellido') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'oldPassword')->hiddenInput(['value'=>$model->isNewRecord ? '' : $model->password])->label(false); ?>

    <?= $form->field($model, 'rol') ?>
    
    
    <?= $form->field($model, 'fecha_creacion')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Ingresar fecha...'],
                'pluginOptions' => [
                    'autoclose'=>true
                ]
        ]); 
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
