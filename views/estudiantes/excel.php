<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Cargar lista';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="estudiantes-form">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'gestion')->dropDownList($gestiones, ['prompt'=>'Seleccionar Gestion...']) ?>

    <?= $form->field($model, 'etapas')->dropDownList(["1"=>"1", "2"=>"2", "3"=>"3", "4"=>"4", "5"=>"5"], ['prompt'=>'Seleccionar Cantidad de Etapas']) ?>

    <div class="form-group">
        <?= Html::submitButton('Cargar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>