<?php
/* @var $this yii\web\View */
$this->title = 'Departamento de Matemáticas - Inicio';
?>
<div class="site-index">

    <div class="jumbotron">
    
        <!--h1>Departamento de Matem&aacute;ticas</h1-->
        <!--h1>Test Yii</h1-->
        
        <div class="image">

            <img src="/images/olimpiada.png" width=300 height=200></img>
            
        </div>

        <!--p class="lead">Sistema de estad&iacute;stico de Administraci&oacute;n de las Olimpiadas de Matem&aacute;ticas.</p-->
        <p class="lead">Sistema de Gesti&oacute;n de Informaci&oacute;n Acad&eacute;mica</p>

        <!--p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p-->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <a href="/site/ranking"><h2>Clasificacion</h2></a>

                <p>Los participantes de las Olimpiadas Matem&aacute;ticas son seleccionados en cada etapa
                correspondiente al certamen segun criterios de evaluacion establecidos por el comite organizador.</p>

            </div>
            <div class="col-lg-4">
                <a href="/site/estadisticas"><h2>Estadisticas</h2></a>

                <p>Las calificaciones obtenidas por etapa clasificatoria, son sometidas a un an&aacute;lisis 
                estad&iacute;stico por medio de gr&aacute;ficos representando el desempeño acad&eacute;mico 
                en la gestion actual.</p>

            </div>
            <div class="col-lg-4">
                <a href="/site/reportes"><h2>Reportes</h2></a>

                <p>Nómina de estudiantes clasificados en la Etapa final de las Olimpiadas Matem&aacute;ticas, es decir
                son los estudiantes ganadores del certamen.</p>
            </div>
        </div>

    </div>
</div>
