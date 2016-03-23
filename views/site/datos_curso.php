<?php

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Curso';
$this->params['breadcrumbs'][] = ['label' => 'Conteo general', 'url' => ['estadisticad']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h2></h2>
<div class="clasificacion">

    <?php
        $heading = 'Participantes por Curso';
    ?>

    <?php

    echo GridView::widget([
        'dataProvider'=>$dataProvider,
        //'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        //'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            'id'=>'pajax-1',
        ],
        // set your toolbar
        'toolbar'=> [
            /*['content'=>
            //Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>"Add Book", 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['#'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>"Refrescar tabla", 'id'=>'grid_reset'])
            ],*/
            '{export}',
            //'{toggleData}',
        ],
        // set export properties
        'export'=>[
            'fontAwesome'=>true
        ],
        // parameters from the demo form
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        //'hover'=>true,
        'showPageSummary'=>true,
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
            'heading'=>$heading,
        ],
        'persistResize'=>true,
        //'exportConfig'=>$exportConfig,
    ]);


    $heading = 'Participantes Aprobados por Curso';

    echo GridView::widget([
        'dataProvider'=>$dataProviderCU,
        //'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        //'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
            'id'=>'pajax-1',
        ],
        // set your toolbar
        'toolbar'=> [
            /*['content'=>
            //Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>"Add Book", 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['#'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>"Refrescar tabla", 'id'=>'grid_reset'])
            ],*/
            '{export}',
            //'{toggleData}',
        ],
        // set export properties
        'export'=>[
            'fontAwesome'=>true
        ],
        // parameters from the demo form
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        //'hover'=>true,
        'showPageSummary'=>true,
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
            'heading'=>$heading,
        ],
        'persistResize'=>true,
        //'exportConfig'=>$exportConfig,
    ]);

    ?>
</div>