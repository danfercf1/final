<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\widgets\Spinner;

/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */

$this->title = "Ejecutar Cargar Excel.bat";
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiantes-view">

    
    
    <div class="well">
    
        <h1><?= Html::encode($this->title) ?></h1>

    <p>Ahora debe ejecutar el archivo Cargar Excel.bat para poder cargar los datos a la Base de datos</p>
        
	   <?=Spinner::widget(['preset' => 'small', 'align' => 'right', 'color' => '#5CB85C'])?>
	   <div class="clearfix"></div>
    </div>

</div>
