<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ganadores a nivel Departamental';
$this->params['breadcrumbs'][] = ['label' => 'clasificacion', 'url' => ['clasificados']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion">

    <p class="lead">Olimpiada Cient&iacute;fica Estudiantil Plurinacional 2015</p>

    <h2><?= Html::encode($this->title) ?></h2>

    <h3>1ro Secundaria</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // '_id',
            'Ap_PATERNO',
            'Ap_MATERNO',
            'NOMBRE',
            'DISTRITO_EDUCATIVO',
            'UE',
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <h3>2do Secundaria</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // '_id',
            'Ap_PATERNO',
            'Ap_MATERNO',
            'NOMBRE',
            'DISTRITO_EDUCATIVO',
            'UE',
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <h3>3ro Secundaria</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // '_id',
            'Ap_PATERNO',
            'Ap_MATERNO',
            'NOMBRE',
            'DISTRITO_EDUCATIVO',
            'UE',
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <h3>4to Secundaria</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // '_id',
            'Ap_PATERNO',
            'Ap_MATERNO',
            'NOMBRE',
            'DISTRITO_EDUCATIVO',
            'UE',
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <h3>5to Secundaria</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // '_id',
            'Ap_PATERNO',
            'Ap_MATERNO',
            'NOMBRE',
            'DISTRITO_EDUCATIVO',
            'UE',
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <h3>6to Secundaria</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // '_id',
            'Ap_PATERNO',
            'Ap_MATERNO',
            'NOMBRE',
            'DISTRITO_EDUCATIVO',
            'UE',
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
</div>