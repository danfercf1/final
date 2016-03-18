<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Tutor */

$this->title = $model->nombreCompleto();
$this->params['breadcrumbs'][] = ['label' => 'Tutores', 'url' => '#', 'template' => "<li id='link'>{link}</li>\n"];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(<<<JS
    $("#link").find('a').click(function(){
        window.history.back();
    });
JS
    , View::POS_READY, 'link_tut');

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
 
<div class="tutor-view">

    <h1>Tutor(a): <?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            '_id',
            'NOMBRE_T',
            'PATERNO_T',
            'MATERNO_T',
            'GENERO_T',
            'CI_T',
            'CORREO_T',
            'FONO_T',
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

