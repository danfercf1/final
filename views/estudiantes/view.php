<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */

$this->title = $model->nombreCompleto();
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['datos']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="estudiantes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            '_id',
            'DISTRITO',
            'MATERIA',
            'CURSO',
            'NOMBRE',
            'PATERNO',
            'MATERNO',
            'RUDE',
            'GENERO',
            'CI',
            'FECHA_NACIMIENTO',
            'EDAD',
            'CORREO',
            'FONO',
            ['label'=>'TUTOR', 'format'=>'raw', 'value'=>Html::a($model->tutor->nombreCompleto(), ['tutores/view', 'id' => $model->TUTOR->{'$id'}, 'id_estudiante'=>(string)$model->_id])],
            ['label'=>'UNIDAD EDUCATIVA', 'format'=>'raw', 'value'=>Html::a($model->uE->NOMBRE_UE, ['ue/view', 'id' => $model->UNIDAD_EDUCATIVA->{'$id'}, 'id_estudiante'=>(string)$model->_id])],
        ],
    ]) ?>
    
    <p>
        <?= Html::a('Editar', ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => (string)$model->_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de que quiere eliminar este elemento?',
                'method' => 'post',
            ],
        ]);
        ?>
    </p>

</div>
