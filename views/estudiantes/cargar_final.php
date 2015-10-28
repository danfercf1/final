<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */

$this->title = "Ejecutar Cargar Excel.bat";
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiantes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Ahora debe ejecutar el archivo Cargar Excel.bat para poder cargar los datos a la Base de datos</p>

</div>
