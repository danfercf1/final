<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */
$this->title = $model->nombreCompleto();
//$this->params['breadcrumbs'][] = ['label' => 'Estudiantes: Exploracion de datos', 'url' => '#', 'template' => "<li id='link'>{link}</li>\n"];
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes: Exploracion de datos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $evento_model->NOMBRE_EVENTO;
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(<<<JS
    $("#link").find('a').click(function(){
        window.history.back();
    });
JS
    , View::POS_READY, 'link_est');
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
            ['label'=>'TUTOR', 'format'=>'raw', 'value'=>Html::a($model->tutor->nombreCompleto(), ['tutores/view', 'id' => (string)$model->TUTOR->{'$id'}, 'id_estudiante'=>(string)$model->_id])],
            ['label'=>'UNIDAD EDUCATIVA', 'format'=>'raw', 'value'=>Html::a($model->uE->NOMBRE_UE, ['ue/view', 'id' => (string)$model->UNIDAD_EDUCATIVA->{'$id'}, 'id_estudiante'=>(string)$model->_id])],
        ],
    ]) ?>

    <p>
        <?= Html::a('Editar', ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
        &nbsp;
    </p>

    <p> <?= Html::a('Eliminar', ['delete', 'id' => (string)$model->_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de que quiere eliminar este elemento?',
                'method' => 'post',
            ],
        ]);
        ?>
    </p>

</div>