<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */
$this->title = $model->nombreCompleto();
$this->params['breadcrumbs'][] = ['label' => 'Clasificacion: Ranking general', 'url' => ['ranking']];
$this->params['breadcrumbs'][] = ['label' => 'Olimpiada...', 'url' => [$url]];
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
            //'FECHA_NACIMIENTO',
            ['label'=>'Fecha Nacimiento', 'value'=>$model->getFechaNaC()],
            //'EDAD',
            ['label'=>'Edad', 'value'=>$model->getEdad($model->getFechaNaC())],
            'CORREO',
            'FONO',
            ['label'=>'Tutor', 'format'=>'raw', 'value'=>Html::a($model->tutor->nombreCompleto(), ['tutores/view', 'id' => $model->TUTOR->{'$id'}, 'id_estudiante'=>(string)$model->_id])],
            'NOMBRE_UE',
            'DEPENDENCIA',
        ],
    ]) ?>

</div>