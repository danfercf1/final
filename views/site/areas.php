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
       
var_dump($model);
die;
                    
$test3a = GridView::widget([
                            'dataProvider' => $rural,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],                    
                                
                                //'_id',
                                //['label'=>'AREA', 'format'=>'raw','value'=>function($model){return $model->uE->AREA;}],
                                ['label'=>'Area Rural', 'format'=>'raw','value'=>getAlumnos(0, 'r', 10)],
                                //'CURSO',
                                'PATERNO',
                                'MATERNO',
                                'NOMBRE',
                                'NOTA',
                                //'UNIDAD_EDUCATIVA', 
                            ],   
                        ]);

 ?>
</div>