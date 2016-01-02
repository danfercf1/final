<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estadisticas';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="estadisticas-form">

    <p class="lead">Ver Estadisticas</p>
    
    
    <?php $form = ActiveForm::begin(['method' => 'get']); ?>
    
    
     <?= $form->field($model, 'evento')->dropDownList($eventos->obtenerNombres(), ['prompt'=>'Seleccionar evento...']) ?>
     <?= $form->field($model, 'gestion')->dropDownList($gestiones, ['prompt'=>'Seleccionar Gestion...']) ?>
     <?= $form->field($model, 'etapa')->dropDownList($eventos->obtenerEtapasEvento(), ['prompt'=>'Seleccionar Etapa...']) ?>
     <?= $form->field($model, 'atributo')->dropDownList(array("1"=>"Distrito", "2"=>"Curso", "3"=>"Edad", "4"=>"Area", "5"=>"Dependencia", "6"=>"Genero"), ['prompt'=>'Seleccionar atributo...']) ?>
    
    
    <div class="form-group">
        <?= Html::submitButton('generar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
