<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ue */

$this->title = 'Create Ue';
$this->params['breadcrumbs'][] = ['label' => 'Ues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
