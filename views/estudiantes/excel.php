<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

$this->title = 'Nuevo registro';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="upload-form">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'archivo')->fileInput()?>
    
    <?= $form->field($model, 'nombre')->textInput()->hint('Asignar nombre de olimpiada') ?>

    <?= $form->field($model, 'gestion')->dropDownList($gestiones, ['prompt'=>'Seleccionar Gestion...']) ?>

    <?= $form->field($model, 'etapas')->dropDownList(["1"=>"1", "2"=>"2", "3"=>"3", "4"=>"4", "5"=>"5"], ['prompt'=>'Seleccionar Cantidad de Etapas']) ?>

    <div class="form-group">
        <?= Html::submitButton('Cargar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>