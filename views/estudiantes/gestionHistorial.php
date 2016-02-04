<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Historial';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="gestionhistorial-form">

    <p class="lead">Ver Historial de Olimpiadas</p>
    
    
    <?php $form = ActiveForm::begin(['method' => 'get', 'action'=>'/estudiantes/historial']); ?>
    
     <?= Html::dropDownList('EventoSearch[GESTION]', [], $gestiones, ['prompt'=>'Seleccionar Gestion...']) ?>


    <div class="form-group">
        <?= Html::submitButton('Cargar historial', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>