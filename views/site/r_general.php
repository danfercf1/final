<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\bootstrap\Tabs;
use kartik\grid\GridView;
use kartik\widgets\Typeahead;

//use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ranking general';
$this->params['breadcrumbs'][] = ['label' => 'Clasificacion', 'url' => ['clasificados']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion">

    <p class="lead">Ranking general de mejores notas</p>

    
<?php 

//var_dump($urbano);

/*$distrito = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'DISTRITO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',      
                            ],     
                        ]);
                 
                        
$curso1 = GridView::widget([
                            'dataProvider' => $dataProvider1S,
                            'filterModel' => $searchModel1s,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],   
                        ]);
                        
$curso2 = GridView::widget([
                            'dataProvider' => $dataProvider2S,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],   
                        ]);

$curso3 = GridView::widget([
                            'dataProvider' => $dataProvider3S,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],   
                        ]);

$curso4 = GridView::widget([
                            'dataProvider' => $dataProvider4S,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],   
                        ]);
                        
$curso5 = GridView::widget([
                            'dataProvider' => $dataProvider5S,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],   
                        ]);

$curso6 = GridView::widget([
                            'dataProvider' => $dataProvider6S,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],   
                        ]);
                        
                       
$rural = GridView::widget([
                            'dataProvider' => $dataProviderR,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],                    
                                
                                //'_id',
                                'AREA',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],   
                        ]);
                                     
$urbano = GridView::widget([
                            'dataProvider' => $dataProviderU,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],                    
                                
                                //'_id',
                                'AREA',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],    
                        ]);
                    
                    
$convenio = GridView::widget([
                            'dataProvider' => $dataProviderC,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'DEPENDENCIA',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],      
                        ]);

$fiscal = GridView::widget([
                            'dataProvider' => $dataProviderF,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'DEPENDENCIA',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],    
                        ]);
                        
$privado = GridView::widget([
                            'dataProvider' => $dataProviderP,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'DEPENDENCIA',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],     
                        ]);


$femenino = GridView::widget([
                            'dataProvider' => $dataProviderGF,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'GENERO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],    
                        ]);

$masculino = GridView::widget([
                            'dataProvider' => $dataProviderGM,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'GENERO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                                'AREA',
                            ],  
                        ]);


$sub15 = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'EDAD',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],    
                        ]);

$sub17 = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'EDAD',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],   
                        ]);*/
                        
$distrito = GridView::widget([
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumnsDistrito,
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
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>"Add Book", 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>"Reset Grid"])
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
            //'heading'=>$heading,
        ],
        'persistResize'=>true,
        //'exportConfig'=>$exportConfig,
    ]);


$curso = GridView::widget([
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumnsCurso,
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
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>"Add Book", 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>"Reset Grid"])
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
            //'heading'=>$heading,
        ],
        'persistResize'=>true,
        //'exportConfig'=>$exportConfig,
    ]);

$area = GridView::widget([
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumnsArea,
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
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>"Add Book", 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>"Reset Grid"])
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
            //'heading'=>$heading,
        ],
        'persistResize'=>true,
        //'exportConfig'=>$exportConfig,
    ]);

$dependencia = GridView::widget([
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumnsDependencia,
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
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>"Add Book", 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>"Reset Grid"])
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
            //'heading'=>$heading,
        ],
        'persistResize'=>true,
        //'exportConfig'=>$exportConfig,
    ]);
    
$genero = GridView::widget([
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumnsGenero,
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
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>"Add Book", 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>"Reset Grid"])
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
            //'heading'=>$heading,
        ],
        'persistResize'=>true,
        //'exportConfig'=>$exportConfig,
    ]);
    
$edad = GridView::widget([
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumnsEdad,
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
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>"Add Book", 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>"Reset Grid"])
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
            //'heading'=>$heading,
        ],
        'persistResize'=>true,
        //'exportConfig'=>$exportConfig,
    ]);
                        
echo Tabs::widget([
    'items' => [
        [
            'label' => 'Distrito',
            'content' => '<div>'.$distrito.'</div>',
           
            'active' => true
        ],
        [
         'label' => 'Curso',                
         'content' => '<div>'.$curso.'</div>',
        ],
        [
         'label' => 'Area Regional', 
         'content' => '<div>'.$area.'</div>',
        ],
        [
         'label' => 'Dependencia',
         'content' => '<div>'.$dependencia.'</div>',
        ],
        [
         'label' => 'Genero',
         'content' => '<div>'.$genero.'</div>', 
        ],
        [
         'label' => 'Edad',
         'content' => '<div>'.$edad.'</div>',
        ],
        [
         'label' => 'Sub-17',
         //'content' => '<div>'.$sub17.'</div>',  
         'content' => '<div>'.$contenido.'</div>',
        ]
    ],
    
]);

 ?>
</div>