<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'_id',
            'NOMBRE',
            'DISTRITO_EDUCATIVO',
            'MATERIA',
            'CURSO',
            // 'Ap_PATERNO',
            // 'Ap_MATERNO',
            // 'RUDE',
            // 'GENERO',
            // 'CI',
            [
                "label"=>"Fecha de Nac",
                "value"=>function ($model) {
                    return $model->getFechaNac();
                }
            ],
            // 'CORREO',
            // 'FONO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
