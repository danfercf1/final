<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\grid\GridView;
//use yii\widgets\ListView;
//use model\models\Evento;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lista">
    <h1>Exploracion de Olimpiadas</h1>
<?php
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
            return Html::a(Html::encode($model->NOMBRE_EVENTO), 'datos?EstudiantesBusqueda[NOMBRE_EVENTO]='.$model->_id);
        },
        'format'=>'raw'
    ],
    'GESTION',
];

echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'showPageSummary' => true
]);
?>


</div>