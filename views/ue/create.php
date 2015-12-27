<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ue */

$this->title = 'Crear Unid. Educativa';
$this->params['breadcrumbs'][] = ['label' => 'Unidades educativas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
