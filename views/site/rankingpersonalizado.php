<?php

use yii\helpers\Html;
//use yii\grid\GridView;
//use yii\bootstrap\Tabs;
use kartik\grid\GridView;
use yii\web\View;
use kartik\widgets\Typeahead;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ranking general';
$this->params['breadcrumbs'][] = ['label' => 'Clasificacion', 'url' => ['personalizar']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="clasificacion">

    <?php
    $heading = 'Ranking general';
    ?>

    <?php

    echo GridView::widget([
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
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['#'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>"Refrescar tabla", 'id'=>'grid_reset'])
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