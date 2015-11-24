<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;

use kartik\widgets\Select2;

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

$distrito = GridView::widget([
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
                            'dataProvider' => $dataProviderS15,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                    
                                //'_id',
                                //'EDAD',
                                ['label'=>'EDAD', 'value'=>$model->estudiantes->getEdad($model->getFechaNaC())],
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
                        ]);
                        
echo $fechaLimite;                        
                        
echo Tabs::widget([
    'items' => [
        [
            'label' => 'Distrito',
            'content' => '
                        <div class="selector">
                        <label>Seleccionar distrito</label>
                        <select> 
                            <option>distrito 1</option>
                            <option>distrito 2</option>
                            <option>distrito 3</option>
                        </select>
                        <button>cargar</button>
                        </div>
                        
                        <div>'.$distrito.'</div>
                        ',
           
            'active' => true
        ],
        [
         'label' => 'Curso',                
         //'content' => '<div>'.$curso.'</div>',  
         'items' => [
                    [
                        'label' => '1ro Sec.',
                        'content' => '<div>'.$curso1.'</div>',
                    ],
                    [
                        'label' => '2do Sec.',
                        'content' => '<div>'.$curso2.'</div>',
                    ],
                    [
                        'label' => '3ro Sec.',
                        'content' => '<div>'.$curso3.'</div>',
                    ],
                    [
                        'label' => '4to Sec.',
                        'content' => '<div>'.$curso4.'</div>',
                    ],
                    [
                        'label' => '5to Sec.',
                        'content' => '<div>'.$curso5.'</div>',
                    ],
                    [
                        'label' => '6to Sec.',
                        'content' => '<div>'.$curso6.'</div>',
                    ],
               ],
        ],
        [
         'label' => 'Area Regional',
         //'content' => '<div>'.$test3.'</div>',  
         'items' => [
                    [
                        'label' => 'Rural',
                        'content' => '<div>'.$rural.'</div>',
                    ],
                    [
                        'label' => 'Urbana',
                        'content' => '<div>'.$urbano.'</div>',
                    ],
               ],
        ],
        [
         'label' => 'Dependencia',
         //'content' => '<div>'.$test4.'</div>',  
         'items' => [
                    [
                        'label' => 'Convenio',
                        'content' => '<div>'.$convenio.'</div>',
                    ],
                    [
                        'label' => 'Fiscal o estatal',
                        'content' => '<div>'.$fiscal.'</div>',
                    ],
                    [
                        'label' => 'Privada',
                        'content' => '<div>'.$privado.'</div>',
                    ],
               ],
        ],
        [
         'label' => 'Femenino',
         'content' => '<div>'.$femenino.'</div>',  
        ],
        [
         'label' => 'Masculino',
         'content' => '<div>'.$masculino.'</div>',  
        ],
        [
         'label' => 'Sub-15',
         'content' => '<div>'.$sub15.'</div>',  
        ],
        [
         'label' => 'Sub-17',
         'content' => '<div>'.$sub17.'</div>',  
        ]
    ],
    
]);


 ?>
</div>