<?php

/*use yii\helpers\Html;*/
use kartik\helpers\Html;
/*use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;*/
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\widgets\Select2;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesBusqueda */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mejores notas';
$this->params['breadcrumbs'][] = ['label' => 'clasificacion', 'url' => ['clasificados']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificacion">

    <p class="lead">Mejores notas</p> 
    
    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'type' => ActiveForm::TYPE_VERTICAL]); 
          /*$form->field($model, 'select_data')->multiselect($model-> atributo);*/?>
          
    <?php   echo Select2::widget([
            'name' => 'state_2',
            'value' => '',
            'data' => $data,
            'options' => ['multiple' => true, 'placeholder' => 'Select states ...']
            ]);?>

    
    
    
    <?php ActiveForm::end(); ?>
    
</div>