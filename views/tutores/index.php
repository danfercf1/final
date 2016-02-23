<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TutoresBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tutores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutor-index">

    <?php $heading = 'Tutores'; ?>
    
    <?php
    
    $gridColumns = [
       'NOMBRE_T',
       'PATERNO_T',
       'MATERNO_T',
       'CI_T',
    ];
    
    array_push($gridColumns, [
            'class' => '\kartik\grid\ActionColumn',
            'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
        ]);
    
    
     echo GridView::widget([
            'id'=>'grid_datos',
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'columns'=>$gridColumns,
            'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
            'headerRowOptions'=>['class'=>'kartik-sheet-style'],
            //'filterRowOptions'=>['class'=>'kartik-sheet-style'],
            'pjax'=>true,
            'pjaxSettings'=>[
                'neverTimeout'=>true,
                'id'=>'pajax-1',
            ],
            // set your toolbar
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['title'=>'Crear nuevo tutor', 'class' => 'btn btn-success'])
                    //Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['#'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>"Refrescar Tabla", 'id'=>'grid_reset'])
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
            ],
            'persistResize'=>true,
            //'exportConfig'=>$exportConfig,
        ]);
    
    ?>

</div>
