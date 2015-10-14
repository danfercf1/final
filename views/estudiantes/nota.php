<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Cargar nota';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="estudiantes-form">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'gestion')->dropDownList($gestiones, ['prompt'=>'Seleccionar Gestion...']) ?>

    <?= $form->field($model, 'etapa')->dropDownList(array("e1"=>"Etapa 1", "e2"=>"Etapa 2", "e3"=>"Etapa 3", "e4"=>"Etapa 4",), ['prompt'=>'Seleccionar Etapa...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Cargar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>