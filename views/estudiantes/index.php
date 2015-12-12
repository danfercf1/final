<?php

use yii\helpers\Html;
//use kartik\grid\GridView;

use yii\grid\GridView;
//use yii\widgets\ListView;
use model\models\Evento;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lista">
    <h1>Exploracion de datos</h1>
    <ul>
        <li><a href="/estudiantes/datos?EstudiantesBusqueda[GESTION]=2015"> Olimpiadas 2015 </a></li>
        <li><a href="/estudiantes/datosevento?nombre=5667807E5E273A1840E6D390">Nombre Olimpiada 2</a></li>
        <li><a href="blank">Nombre Olimpiada 3</a></li>
    </ul>
    
<?php 
    /*echo ListView::widget( [
        'dataProvider' => $dataProvider,  
    ] );*/

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'_id',
            ['label'=>'Evento', 'format'=>'raw', 'value'=>function ($model) { 
                     return Html::a(Html::encode($model->NOMBRE_EVENTO),'datosevento?nombre='.$model->_id);
             }],
            'GESTION',
        ]
    ]);
?>


</div>