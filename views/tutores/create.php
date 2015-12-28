<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tutor */

$this->title = 'Crear Tutor';
$this->params['breadcrumbs'][] = ['label' => 'Tutores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tutor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
