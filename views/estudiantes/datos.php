<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\Typeahead;
use yii\web\JsExpression;
use yii\jui;

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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        /*'filterModel' => Typeahead::widget([
                            'model' => $searchModel, 
                            'attribute' => 'PATERNO',
                            'options' => ['placeholder' => 'Filter as you type ...'],
                            'dataset' => [
                                [
                                    'local' => $datae,
                                    'limit' => 10
                                ]
                            ]
                        ]),*/                        
        
        /*'filterModel' => AutoComplete::widget([
                            'model' => $searchModel,
                            'attribute' => 'project_status',
                            'clientOptions' => [
                                'source' => ['USA', 'RUS'],
                            ],
                        ]),
        'value' => 'projectstatus.name',*/                        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'_id', 
            'DISTRITO',
            'PATERNO',
            'MATERNO',
            'NOMBRE',
            'CURSO',
            /*[
                "label"=>"Fecha de N.",
                "value"=>function ($model) {
                    return $model->getFechaNac();
                }
            ],*/
            'NOTA',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>


