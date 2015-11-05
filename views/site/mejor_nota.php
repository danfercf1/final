<?php

use yii\helpers\Html;
/*use kartik\helpers\Html;*/
/*use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;*/
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\widgets\Select2;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mejores notas';
$this->params['breadcrumbs'][] = ['label' => 'clasificacion', 'url' => ['clasificados']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion">

    <p class="lead">Mejores notas</p> 
     
    <?php 
        $data = [1 => "Distrito", 
        2 => "Curso", 
        3 => "Area", 
        4 => "Dependencia", 
        5 => "Genero", 
        6 => "Edad Sub-15", 
        7 => "Edad Sub-17",
        ];
    
    ?>        
    <?php   
        echo '<label class="control-label">Armar tabla</label>';
        echo Select2::widget([
        'name' => 'state_10',
        'size' => Select2::SMALL,
        'data' => $data,
        'options' => ['placeholder' => 'Seleccionar variables ...', 'multiple' => true],
        'pluginOptions' => [
        'tags' => true,
        'maximumInputLength' => 10
        ],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('generar', ['class' => 'btn btn-success']) ?>
    </div>
    
</div>