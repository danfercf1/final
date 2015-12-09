<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Exploracion de Datos';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("$('#grid_reset').click(function(e){
    e.preventDefault();
    $.pjax.reload({container:'#grid_datos'});
});", View::POS_END, 'grid_reset');
?>

<div class="estudiantes-index">

    <?php 
        $heading = 'Datos Estudiantes';
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
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            'id'=>'pajax-1',
        ],
        // set your toolbar
        'toolbar'=> [
            ['content'=>
                //Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>"Add Book", 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['#'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>"Refrescar Tabla", 'id'=>'grid_reset'])
            ],
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
        'showPageSummary'=>true,
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


