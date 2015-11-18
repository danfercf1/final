<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exploracion de Datos';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiantes-index">

    <h1>Datos Estudiantes</h1>

    <?php /* echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Estudiantes', ['create'], ['class' => 'btn btn-success']) */?>
    </p>

    <?php

    $gridColumns = [
        'DISTRITO',
        'PATERNO',
        'NOMBRE',
        'CURSO',
        'RUDE',
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute'=>'NOTA_ETAPA1',
            'readonly'=>function($model, $key, $index, $widget) {
                return (!$model->status); // do not allow editing of inactive records
            },
            'editableOptions' => [
                'header' => 'Nota Etapa 1',
                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                'options' => [
                    'pluginOptions' => ['min'=>0, 'max'=>100]
                ]
            ],
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['integer', 1],
            'pageSummary' => true,
            'refreshGrid'=> true
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute'=>'NOTA_ETAPA2',
            'readonly'=>function($model, $key, $index, $widget) {
                return (!$model->status); // do not allow editing of inactive records
            },
            'editableOptions' => [
                'header' => 'NOTA_ETAPA1',
                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                'options' => [
                    'pluginOptions' => ['min'=>0, 'max'=>100]
                ]
            ],
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'width'=>'100px',
            'format'=>['integer', 1],
            'pageSummary' => true
        ],
    ];

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
        'hover'=>true,
        'showPageSummary'=>true,
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
            //'heading'=>$heading,
        ],
        'persistResize'=>true,
        //'exportConfig'=>$exportConfig,
    ]);?>

</div>
