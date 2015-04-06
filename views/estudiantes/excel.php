<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Cargar lista';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="estudiantes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::fileInput("excel")?>

    <div class="form-group">
        <?= Html::submitButton('Cargar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>