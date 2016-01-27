<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use kartik\widgets\SideNav;
use app\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php //$this->registerJsFile(Yii::$app->request->baseUrl . '/jsjoy/autoc.js', array('position' => $this::POS_END), 'autoc'); ?>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                //'brandLabel' => 'Test Yii',
                //'brandLabel' => 'Olimpiadas Matem&aacute;ticas',
                'brandLabel' => "<img class='logo-inicio' src='/images/logoFinal.png' />
                <div class='logo-texto'>Olimpiadas Matem&aacute;ticas</div>",
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    //['label' => 'Inicio', 'url' => ['/site/index']],
                    //['label' => 'Estudiantes', 'url' => ['/estudiantes/index']],
                    //['label' => 'Usuarios', 'url' => ['/usuarios/index']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Iniciar sesion', 'url' => ['/site/login']] :
                        ['label' => 'Cerrar sesion (' . Yii::$app->user->identity->nombre . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                            
                            
                
                 ],
            ]);
            NavBar::end();
              
        ?>
        <div class="container">
            <div class="sidebar">
            <?php
            echo SideNav::widget([
                'type' => $type,
                'encodeLabels' => false,
                'heading' => $heading,
                'items' => [
                    // Important: you need to specify url as 'controller/action',
                    // not just as 'controller' even if default action is used.
                    ['label' => 'Inicio', 'icon' => 'home', 'url' => Url::to(['/site/index', 'type'=>$type]), 'active' => ($item == 'index')],
                    ['label' => 'Estudiantes', 'icon' => 'book', 'items' => [
                        ['label' => 'Cargar Excel', 'url' => Url::to(['/estudiantes/cargarexcel', 'type'=>$type]), 'active' => ($item == 'cargarexcel')],
                        ['label' => 'Exploracion de datos', 'url' => Url::to(['/estudiantes/index', 'type'=>$type]), 'active' => ($item == 'datos')],
                        ['label' => 'Historial', 'icon' => 'user', 'items' => [
                            ['label' => 'Eventos anteriores', 'url' => Url::to(['/estudiantes/historial', 'type'=>$type]), 'active' => ($item == 'historial')],
                            //['label' => 'Registro 2', 'url' => Url::to(['/site/online-2', 'type'=>$type]), 'active' => ($item == 'online-2')]
                        ]],
                    ]],
                    ['label' => 'Clasificacion', 'icon' => 'tags', 'items' => [
                        ['label' => 'Ranking general', 'url' => Url::to(['/site/ranking/', 'type'=>$type]), 'active' => ($item == 'r_general')],
                        ['label' => 'Personalizar ranking', 'url' => Url::to(['/site/personalizar', 'type'=>$type]), 'active' => ($item == 'personalizar')],
                        
                        ['label' => 'Boletin informativo', 'icon' => 'bullhorn', 'items' => [
                            ['label' => 'Estadisticas', 'url' => Url::to(['/site/estadisticas', 'type'=>$type]), 'active' => ($item == 'estadisticas')],
                            ['label' => 'Reportes', 'url' => Url::to(['/site/reportes', 'type'=>$type]), 'active' => ($item == 'reportes')]
                        ]],
                    ]],
                    ['label' => 'Cuenta de usuario', 'icon' => 'user', 'url' => Url::to(['/usuarios/index', 'type'=>$type]), 'active' => ($item == 'index')],
                ],
            ]);
            ?>
            </div>
            <div class="main">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
            </div>
            
            
            
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
