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
    
    <?php $form = ActiveForm::begin([
        'id' => 'estadisticas-form',
        'method' => 'get', 'action'=>'/site/graficas'
    ]); ?>
    
     <?= $form->field($model, 'evento')->dropDownList($eventos->obtenerNombres(true), ['prompt'=>'Seleccionar evento...']) ?>
     <?= $form->field($model, 'gestion')->dropDownList($gestiones, ['prompt'=>'Seleccionar Gestion...']) ?>
     <?= $form->field($model, 'etapa')->dropDownList($eventos->obtenerEtapasEvento(true), ['prompt'=>'Seleccionar Etapa...']) ?>
     <?= $form->field($model, 'atributo')->dropDownList(array("distrito"=>"Distrito", "curso"=>"Curso", "edad"=>"Edad", "area"=>"Area", "dependencia"=>"Dependencia", "genero"=>"Genero"), ['prompt'=>'Seleccionar atributo...']) ?>

    <div class="form-group">
        <?= Html::submitButton('generar', ['class' => 'btn btn-success', 'name' => 'estadisticas-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
