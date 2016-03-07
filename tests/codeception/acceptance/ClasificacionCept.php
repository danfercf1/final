<?php 
use tests\codeception\_pages\LoginPage;
use tests\codeception\_pages\AboutPage;


$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions for Clasificación and see result');
$I->amOnPage(Yii::$app->homeUrl);

$loginPage = LoginPage::openBy($I);
$loginPage->login('joannaleslye@gmail.com', '123456');

AboutPage::openBy($I);
$I->seeLink('Clasificacion','/site/ranking');
$I->click('Clasificacion');
$I->expectTo('lista-eventos');
$I->see('Olimpiadas Matematicas Plurinacional');
$I->see('2', 'td');
$I->seeLink('2', '/site/r_general?EstudiantesBusqueda[NOMBRE_EVENTO]=56ba766c5e273a0710feb8f1&EstudiantesBusqueda[NRO_ETAPA]=2&EstudiantesBusqueda[SELECC_ETAPA2]=1&sort=-NOTA_ETAPA2');
$I->click('2');
$I->expectTo('r_general');