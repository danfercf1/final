<?php 
use tests\codeception\_pages\LoginPage;
use tests\codeception\_pages\AboutPage;


$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions for Reportes and see result');
$I->amOnPage(Yii::$app->homeUrl);

$loginPage = LoginPage::openBy($I);
$loginPage->login('joannaleslye@gmail.com', '123456');

AboutPage::openBy($I);
$I->seeLink('Reportes','/site/reportes');
$I->click('Reportes');
$I->expectTo('historial-eventos');
$I->seeLink('Olimpiadas Matematicas Plurinacional', 'reporteshistorial?EstudiantesBusqueda[NOMBRE_EVENTO]=56ba766c5e273a0710feb8f1&EstudiantesBusqueda[SELECC_ETAPA2]=1&sort=-NOTA_ETAPA2');
$I->click('Olimpiadas Matematicas Plurinacional');
$I->expectTo('reporteshistorial');