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

$this->title = 'Historial de reportes';
$this->params['breadcrumbs'][] = ['label' => 'Reportes', 'url' => ['reportes']];
$this->params['breadcrumbs'][] = ['label' => 'Historial reportes'];

?>

<div class="clasificacion">

    <h1><?=$eventos->NOMBRE_EVENTO. ' (Gestión: '.$eventos->GESTION;?>)</h1>

    <?php

    echo GridView::widget([
        'dataProvider'=>$dataProvider1S,
        //'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'toolbar'=> [
            '{export}',
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
        'showPageSummary'=>false,
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
            'heading'=>'1º Secundaria',
        ],
        'persistResize'=>true,
    ]);

    echo GridView::widget([
        'dataProvider'=>$dataProvider2S,
        //'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'toolbar'=> [
            '{export}',
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
            'heading'=>'2º Secundaria',
        ],
        'persistResize'=>true,
    ]);

    echo GridView::widget([
        'dataProvider'=>$dataProvider3S,
        //'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'toolbar'=> [
            '{export}',
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
            'heading'=>'3º Secundaria',
        ],
        'persistResize'=>true,
    ]);

    echo GridView::widget([
        'dataProvider'=>$dataProvider4S,
        //'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'toolbar'=> [
            '{export}',
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
            'heading'=>'4º Secundaria',
        ],
        'persistResize'=>true,
    ]);

    echo GridView::widget([
        'dataProvider'=>$dataProvider5S,
        //'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'toolbar'=> [
            '{export}',
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
            'heading'=>'5º Secundaria',
        ],
        'persistResize'=>true,
    ]);

    echo GridView::widget([
        'dataProvider'=>$dataProvider6S,
        //'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'toolbar'=> [
            '{export}',
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
            'heading'=>'6º Secundaria',
        ],
        'persistResize'=>true,
    ]);

    ?>
</div>