<?php
use tests\codeception\_pages\AboutPage;
/* @var $scenario Codeception\Scenario */
/*echo 'Hola';*/
//var_dump ($scenario); die;
$I = new FunctionalTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('Olimpiadas Matem&aacute;ticas');
$I->seeLink('Iniciar sesion');
$I->click('Iniciar sesion');
$I->see('Iniciar sesion');
