<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ue */

$this->title = 'Editar Unidad Educativa: ' . ' ' . $model->NOMBRE_UE;
$this->params['breadcrumbs'][] = ['label' => 'Ues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NOMBRE_UE, 'url' => ['view', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = 'Editar...';
?>
<div class="ue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
