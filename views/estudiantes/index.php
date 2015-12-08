<?php

use yii\helpers\Html;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lista">
    <h1>Exploracion de datos</h1>
    <ul>
        <li><a href="/estudiantes/datos?EstudiantesBusqueda[GESTION]=2015">Olimpiadas Plurinacional 2015</a></li>
        <li><a href="blank">Nombre Olimpiada 2</a></li>
        <li><a href="blank">Nombre Olimpiada 3</a></li>
    </ul>
    
<?php

    /*echo GridView::widget([
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumnsEvento,
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
            'heading'=>'Exploracion de Datos',
        ],
        'persistResize'=>true,
        //'exportConfig'=>$exportConfig,
    ]);*/
    
    ?>


</div>