<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Confirmacion de Registro';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Su registro fue realizado correctamente puede regresar al inicio haciendo clic <?= Html::a('aqu&iacute;', ['/site/index'], ['class'=>'btn btn-primary']) ?></p>

</div>
