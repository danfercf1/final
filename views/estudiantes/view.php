<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */

$this->title = $model->nombreCompleto();
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="estudiantes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => (string)$model->_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
        ?>
    </p>

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
            ['label'=>'TUTOR', 'format'=>'raw', 'value'=>Html::a($model->tutor->NOMBRE_T." ".$model->tutor->PATERNO_T." ".$model->tutor->MATERNO_T, ['tutores/view', 'id' => $model->TUTOR->{'$id'}])],
            ['label'=>'UNIDAD EDUCATIVA', 'format'=>'raw', 'value'=>Html::a($model->uE->NOMBRE_UE, ['ue/view', 'id' => $model->UNIDAD_EDUCATIVA->{'$id'}])],
        ],
    ]) ?>

</div>
