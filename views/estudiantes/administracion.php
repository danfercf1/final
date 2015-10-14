<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\web\View; 
use app\models\EstudiantesBusqueda; 
use yii\data\ActiveDataProvider;


$this->title = 'Administracion';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="lista">
    <h1>Administracion</h1>
    <ul>
        <li><a href="/estudiantes/administracion/excel">Registro participantes</a></li>
        <li><a href="/estudiantes/administracion/create">Inscribir estudiante</a></li>
        <li><a href="/estudiantes/administracion/nota">Registro notas</a></li>
    </ul>
    
    

</div>