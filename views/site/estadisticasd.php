<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use kartik\widgets\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Conteo general';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(<<<JS
    $("#id_etapa").change(function(){
        var val = $( "#id_etapa option:selected" ).val();
        if(typeof  val != 'undefined'){
            $('#cont_seleccion').html("<input type='hidden' name='EstudiantesBusqueda[SELECC_ETAPA"+val+"]' value='1'/> <input type='hidden' name='sort' value='-NOTA_ETAPA"+val+"'/>");
        }
    });
JS
    , View::POS_READY, 'etapa');
?>

<div class="estadisticas-form">

    <p class="lead">Recuento de Estudiantes</p>
    
    <?php $form = ActiveForm::begin([
        'id' => 'estadisticas-form',
        'method' => 'get', 'action'=>'/site/datos'
    ]); ?>
    
     <?= $form->field($model, 'evento')->dropDownList($eventos->obtenerNombres(true), ['prompt'=>'Seleccionar evento...', 'id'=>'evento']) ?>
     
     <?php 
        echo $form->field($model, 'gestion')->widget(DepDrop::classname(), [
            'options' => ['id'=>'id_gestion'],
            'pluginOptions'=>[
                'depends'=>['evento'],
                'placeholder' => 'Seleccionar Gestion...',
                'url' => Url::to(['/estudiantes/gestion'])
            ]
        ]);
     ?>
     
     <?php
         echo $form->field($model, 'etapa')->widget(DepDrop::classname(), [
                'options' => ['id'=>'id_etapa'],
                'pluginOptions'=>[
                    'depends'=>['evento'],
                    'placeholder' => 'Seleccionar Etapa...',
                    'url' => Url::to(['/estudiantes/etapa'])
                ]
            ]);
     ?>
     <?= $form->field($model, 'atributo')->dropDownList(array("distrito"=>"Distrito", "curso"=>"Curso", "edad"=>"Edad", "area"=>"Area", "dependencia"=>"Dependencia", "genero"=>"Genero"), ['prompt'=>'Seleccionar atributo...']) ?>

    <div class="form-group">
        <?= Html::submitButton('generar', ['class' => 'btn btn-success', 'name' => 'estadisticas-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
