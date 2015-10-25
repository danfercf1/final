<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */

$this->title = $model->nombreCompleto();
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$test = 'asdasd';
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
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            '_id',
            'DISTRITO_EDUCATIVO',
            'MATERIA',
            'CURSO',
            'NOMBRE',
            'Ap_PATERNO',
            'Ap_MATERNO',
            'RUDE',
            'GENERO',
            'CI',
            'FECHA_NAC',
            'EDAD',
            'CORREO',
            'FONO',
            ['label'=>'TUTOR','value'=>$test],
            'UE',
        ],
    ]) ?>

</div>
