<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Evento;

$this->title = 'Historial';
$this->params['breadcrumbs'][] = ['label' => 'Historial', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Historial gestiones pasadas...';

?>


<div class="upload-form">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    
    <?= $form->field($model, 'gestion')->dropDownList($gestiones, ['prompt'=>'Seleccionar Gestion...'])?>

    <div class="form-group">
        <?= Html::submitButton('Ver Historial', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>