<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Olimpiada...';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes: Exploracion de datos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $evento_model->NOMBRE_EVENTO;

$this->registerJs("$('#grid_reset').click(function(e){
    e.preventDefault();
    $.pjax.reload({container:'#grid_datos'});
});", View::POS_END, 'grid_reset');

$this->registerJs(<<<JS
var checked, valor, etapa, token;
$('.check_ganador').click(function(e){
    checked = $(this).is(':checked');
    valor = $(this).val();
    etapa = $(this).attr('data_selecc').toString();
    token = $('#token_csrf').val();
    if(checked){
        $.post('/estudiantes/updateajax',{'id':valor, 'nro_etapa': etapa, etapa_selecc: 1, '_csrf': token},function(data){
            var respuesta = $.parseJSON(data);
            if(respuesta.response == 'true'){
                //$.pjax.reload({container:'#grid_datos'});
                location.reload();
            }
        });
    }else{
        $.post('/estudiantes/updateajax',{'id':valor, 'nro_etapa': etapa, 'etapa_selecc': 0, '_csrf': token},function(data){
            var respuesta = $.parseJSON(data);
            if(respuesta.response == 'true'){
                //$.pjax.reload({container:'#grid_datos'});
                location.reload();
            }
        });
    }
});
JS
    , View::POS_END, 'check_ganador')
?>

<div class="estudiantes-index">

    <?php 
        $heading = 'Datos Estudiantes';
        echo Html::hiddenInput('token', Yii::$app->request->getCsrfToken(), ['id'=>'token_csrf']);
    ?>

    <?php

    echo GridView::widget([
        'id'=>'grid_datos',
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>false,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            'id'=>'pajax-1',
        ],
        // set your toolbar
        'toolbar'=> [
            /*['content'=>
                //Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['title'=>'Insertar nuevo estudiante', 'class' => 'btn btn-success']). ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['#'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>"Refrescar Tabla", 'id'=>'grid_reset'])
            ],*/
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export'=>[
            'fontAwesome'=>true
        ],
        // parameters from the demo form
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>false,
        //'hover'=>true,
        'showPageSummary'=>false,
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
            'heading'=>$heading,
            //'heading'=>'Datos estudiantes',
        ],
        'persistResize'=>true,
        //'exportConfig'=>$exportConfig,
    ]);
    
    ?>

</div>


