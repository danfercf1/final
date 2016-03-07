<?php
use tests\codeception\_pages\AboutPage;
$scenario->env('firefox');
/* @var $scenario Codeception\Scenario */
/*echo 'Hola';*/
//var_dump ($scenario); die;
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('Olimpiadas Matem&aacute;ticas');
$I->see('Sistema de Gesti&oacute;n de Informaci&oacute;n Acad&eacute;mica');
$I->seeLink('Iniciar sesion');
$I->click('Iniciar sesion');
$I->see('Iniciar sesion');
