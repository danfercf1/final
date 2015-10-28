<?php

use yii\helpers\Html;
/*use yii\grid\GridView;*/
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'personalizar';
$this->params['breadcrumbs'][] = ['label' => 'clasificacion', 'url' => ['clasificados']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiantes-form">

    <p class="lead">Personalizar ranking</p>
    
    
    <?php $form = ActiveForm::begin(['method' => 'get']); ?>
    
    <?= $form->field($model, 'cantidad')->textInput()->hint('Ingrese un numero entre 1 y 100')->label('Cantidad'); ?>

    <?= $form->field($model, 'atributo')->dropDownList(array("a1"=>"Distrito", "a2"=>"Curso", "a3"=>"Area", "a4"=>"Dependencia", "a5"=>"Genero", "a6"=>"Edad sub-15", "a7"=>"Edad sub-17",), ['prompt'=>'Seleccionar Variable...']) ?>

    <div class="form-group">
        <?= Html::submitButton('generar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>