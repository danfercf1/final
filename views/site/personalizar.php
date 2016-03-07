<?php

use yii\helpers\Html;
/*use yii\grid\GridView;*/
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use kartik\widgets\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clasificacion: Personalizar ranking';
//$this->params['breadcrumbs'][] = ['label' => 'Clasificacion', 'url' => ['personalizar']];
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
<div class="ranking-form">

    <p class="lead">Personalizar ranking</p>
    
    
    <?php $form = ActiveForm::begin(['method' => 'get', 'action'=>'/site/rankingpersonalizado', 'id'=>'form_personalizado']); ?>
    
    
    <?= $form->field($model, 'NOMBRE_EVENTO')->dropDownList($eventos->obtenerNombres(true), ['prompt'=>'Seleccionar evento...', 'id'=>'evento']) ?>

    <?php
        echo $form->field($model, 'GESTION')->widget(DepDrop::classname(), [
            'options' => ['id'=>'id_gestion'],
            'pluginOptions'=>[
                'depends'=>['evento'],
                'placeholder' => 'Seleccionar Gestion...',
                'url' => Url::to(['/estudiantes/gestion'])
            ]
        ]);
    ?>

    <?php
        echo $form->field($model, 'NRO_ETAPA')->widget(DepDrop::classname(), [
            'options' => ['id'=>'id_etapa'],
            'pluginOptions'=>[
                'depends'=>['evento'],
                'placeholder' => 'Seleccionar Etapa...',
                'url' => Url::to(['/estudiantes/etapa'])
            ]
        ]);
    ?>

    <?= $form->field($model, 'cantidad')->
        input('number', ['min'=>1, 'max'=> 100, 'placeholder'=>'Ingrese un numero entre 1-100...', 'value'=>100])->hint('El valor seleccionado mostrara esa cantidad de mejores notas.') ?>

    <?php 
        $data = [
            'DISTRITO' => "Distrito",
            'CURSO' => "Curso",
            'EDAD' => "Edad",
            'AREA' => "Area",
            'DEPENDENCIA' => "Dependencia",
            'GENERO' => "Genero",
        ];
    ?>    

    <?php
        echo '<label class="control-label">Atributo</label>';
        
        echo Select2::widget([
            'name' => 'EstudiantesBusqueda[ATRIBUTO]',
            'size' => Select2::SMALL,
            'data' => $data,
            'options' => ['placeholder' => 'Seleccionar variables ...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]); ?>

    <?php echo "<div id='cont_seleccion'></div>";?>
    
    <div class="form-group">
        <?= Html::submitButton('generar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>