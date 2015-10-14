<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clasificados rumbo a la Etapa Nacional';
$this->params['breadcrumbs'][] = ['label' => 'clasificacion', 'url' => ['clasificados']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion">

    <p class="lead">Olimpiada Cient&iacute;fica Estudiantil Plurinacional 2015</p>

    <h2><?= Html::encode($this->title) ?></h2>

    <h3>Nivel I</h3>
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
            
        ],
    ]); ?>
    
    <h3>Nivel II</h3>
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
           
        ],
    ]); ?>
</div>