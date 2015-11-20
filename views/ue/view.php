<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ue */

$this->title = $model->NOMBRE_UE;
$this->params['breadcrumbs'][] = ['label' => 'Unidades Educativas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php 

if (isset($_GET["id_estudiante"])) {?>
    <div class="back">
        <a href="<?php Yii::$app->homeUrl;?>/estudiantes/view?id=<?php echo $_GET["id_estudiante"] ?> ">Volver a estudiante...</a>
    </div>
<?php }else{
    // Fallback behaviour goes here
}
?>

<div class="ue-view">

    <h1>Unidad Educativa: <?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            '_id',
            'NOMBRE_UE',
            'COD_SIE',
            'DEPENDENCIA',
            'AREA',
            'SECCION',
            'CANTON',
            'PROVINCIA',
        ],
    ]) ?>
    
    <p>
        <?= Html::a('Editar', ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
        &nbsp;
    </p>
    <p>  
        <?= Html::a('Eliminar', ['delete', 'id' => (string)$model->_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de que quiere eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
