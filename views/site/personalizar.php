<?php

use yii\helpers\Html;
/*use yii\grid\GridView;*/
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use kartik\widgets\Select2;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personalizar';
$this->params['breadcrumbs'][] = ['label' => 'Clasificacion', 'url' => ['clasificados']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ranking-form">

    <p class="lead">Personalizar ranking</p>
    
    
    <?php $form = ActiveForm::begin(['method' => 'get']); ?>
    
    
     <?= $form->field($model, 'evento')->dropDownList($eventos->obtenerNombres(true), ['prompt'=>'Seleccionar evento...']) ?>
     <?= $form->field($model, 'gestion')->dropDownList($gestiones, ['prompt'=>'Seleccionar Gestion...']) ?>
     <?= $form->field($model, 'etapa')->dropDownList($eventos->obtenerEtapasEvento(true), ['prompt'=>'Seleccionar Etapa...']) ?>
    
    <?= $form->field($model, 'cantidad')->
    input('number', ['min'=>1, 'max'=> 100, 'placeholder'=>'Ingrese un numero entre 1-100...']) ->label('Cantidad'); ?>

    <?php 
        $data = [1 => "Distrito", 
        2 => "Curso", 
        3 => "Edad",
        4 => "Area", 
        5 => "Dependencia", 
        6 => "Genero",  
        ];
    ?>    

    <?php
        echo '<label class="control-label">Atributo</label>';
        
        echo Select2::widget([
            'name' => 'state_10',
            'size' => Select2::SMALL,
            'data' => $data,
            'options' => ['placeholder' => 'Seleccionar variables ...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]); ?>
    
    <div class="form-group">
        <?= Html::submitButton('generar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>