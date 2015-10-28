<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Datos Estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiantes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php /*echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Estudiantes', ['create'], ['class' => 'btn btn-success']) */?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'_id',
            'NOMBRE',
            'DISTRITO',
            'CURSO',
            'PATERNO',
            'MATERNO',
            'RUDE',
            // 'GENERO',
            // 'CI',
            [
                "label"=>"Fecha de N.",
                "value"=>function ($model) {
                    return $model->getFechaNac();
                }
            ],
            'NOTA',
            // 'FONO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
