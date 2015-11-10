<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ranking general';
$this->params['breadcrumbs'][] = ['label' => 'clasificacion', 'url' => ['clasificados']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion">

    <p class="lead">Ranking general de mejores notas</p>

    
<?php 

//var_dump($urbano);

$test1 = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'DISTRITO',
                                //'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',      
                            ],  
                            
                        ]);
                        
$test2 = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'CURSO',
                                //'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],  
                            
                        ]);
                       
                       
$test3a = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],                    
                                
                                //'_id',
                                ['label'=>'Area Rural', 'format'=>'raw','value'=>function($model){return $model->uE->AREA;}],
                                //'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                                //'UNIDAD_EDUCATIVA',  
                            ],  
                            
                        ]);
                        
$test3b = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],                    
                                
                                //'_id',
                                ['label'=>'Area Urbana', 'format'=>'raw','value'=>function($model){return $model->uE->AREA;}],
                                //'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                                //'UNIDAD_EDUCATIVA', 
                            ],  
                            
                        ]);
                    
$test4 = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                //'DEPENDENCIA',
                                ['label'=>'DEPENDENCIA', 'format'=>'raw','value'=>function($model){return $model->uE->DEPENDENCIA;}],
                                //'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],  
                            
                        ]);

$test5 = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'GENERO',
                                //'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],  
                            
                        ]);

$test6 = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'EDAD',
                                //'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],  
                            
                        ]);

$test7 = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                'EDAD',
                                //'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                            ],  
                            
                        ]);
                        
                        
                        
echo Tabs::widget([
    'items' => [
        [
            'label' => 'Distrito',
            'content' => '<div>'.$test1.'</div>',
            'active' => true
        ],
        [
         'label' => 'Curso',
         'content' => '<div>'.$test2.'</div>',  
        ],
        [
         'label' => 'Area Regional',
         //'content' => '<div>'.$test3.'</div>',  
         'items' => [
                    [
                        'label' => 'Rural',
                        'content' => '<div>'.$test3a.'</div>',
                    ],
                    [
                        'label' => 'Urbana',
                        'content' => '<div>'.$test3b.'</div>',
                    ],
               ],
        ],
        [
         'label' => 'Dependencia',
         'content' => '<div>'.$test4.'</div>',  
        ],
        [
         'label' => 'Genero',
         'content' => '<div>'.$test5.'</div>',  
        ],
        [
         'label' => 'Sub-15',
         'content' => '<div>'.$test6.'</div>',  
        ],
        [
         'label' => 'Sub-17',
         'content' => '<div>'.$test7.'</div>',  
        ]
    ],
    
]);


 ?>
</div>