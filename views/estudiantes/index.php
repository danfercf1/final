<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exploracion...';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="lista-eventos">
    <?php 
    $heading = 'Exploracion Olimpiadas';

    Yii::$app->session->open();

    $gridColumns = [
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute'=>'NOMBRE_EVENTO',
            //'width'=>'200px',
            'filterType'=>GridView::FILTER_TYPEAHEAD,
            'filterWidgetOptions'=>[
                'name' => 'NOMBRE_EVENTO',
                'options' => ['placeholder' => 'Buscar Evento'],
                'pluginOptions' => ['highlight'=>true],
                'dataset' => [
                    [
                        'local' => $eventos->obtenerNombres(),
                        'limit' => 10
                    ]
                ]
            ],
            'value'=>function ($model) {
                return Html::encode($model->NOMBRE_EVENTO);
            },
            'format'=>'raw'
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute'=>'GESTION',
            //'filter'=>false,
            'enableSorting' => false,
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute'=>'ETAPAS',
            'filter'=>false,
            'enableSorting' => false,
            'value'=>function ($model) {
                return $model->obtenerEtapasEvento();
            },
            'options' => ['id' => 'etapa_evento'],
            'format'=>'raw',
        ]
    ];

     echo GridView::widget([
            'id'=>'grid_eventos',
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
            ],
            'persistResize'=>true,
            //'exportConfig'=>$exportConfig,
        ]);
    
    ?>
</div>