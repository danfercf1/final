<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Ver Notas';
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="estudiantes-form">

<?php

echo "<pre>";

foreach($urbano as $v){
    echo "RUDE:".$v->RUDE." Nombre:".$v->NOMBRE." Apellido P:".$v->PATERNO. " Nota:".$v->NOTA." Colegio:".$v->uE->NOMBRE_UE."<br>";
}
echo "--RURAL--<br>";
foreach($rural as $v){
    echo "RUDE:".$v->RUDE." Nombre:".$v->NOMBRE." Apellido P:".$v->PATERNO. " Nota:".$v->NOTA." Colegio:".$v->uE->NOMBRE_UE."<br>";
}
;
?>

</div>