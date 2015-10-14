<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clasificados rumbo a la Etapa 3';
$this->params['breadcrumbs'][] = ['label' => 'clasificacion', 'url' => ['clasificados']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion">

    <p class="lead">Olimpiada Cient&iacute;fica Estudiantil Plurinacional 2015</p>

    <h2><?= Html::encode($this->title) ?></h2>


<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'_id',
            'DISTRITO_EDUCATIVO',
            'CURSO',
            'Ap_PATERNO',
            'Ap_MATERNO',
            'NOMBRE',
            'UE',
            
           
        ],  
        
    ]); ?>
</div>