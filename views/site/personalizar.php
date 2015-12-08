<?php

use yii\helpers\Html;
/*use yii\grid\GridView;*/
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personalizar';
$this->params['breadcrumbs'][] = ['label' => 'Clasificacion', 'url' => ['clasificados']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ranking-form">

    <p class="lead">Personalizar ranking</p>
    
    
    <?php $form = ActiveForm::begin(['method' => 'get']); ?>
    
    
    
    <?= $form->field($model, 'cantidad')->
    input('number', ['min'=>1, 'max'=> 100, 'placeholder'=>'Ingrese un numero entre 1-100...']) ->label('Cantidad'); ?>
    

    <?= $form->field($model, 'atributo')->dropDownList(array("a1"=>"Distrito", "a2"=>"Curso", "a3"=>"Area Regional", "a4"=>"Dependencia", "a5"=>"Genero", "a6"=>"Edad",), ['prompt'=>'Seleccionar Variable...']) ?>

    <div class="form-group">
        <?= Html::submitButton('generar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>