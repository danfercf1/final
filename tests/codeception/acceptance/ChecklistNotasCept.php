<?php 
use tests\codeception\_pages\LoginPage;
use tests\codeception\_pages\AboutPage;


$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions for Checklist Notas and see result');
$I->amOnPage(Yii::$app->homeUrl);

$loginPage = LoginPage::openBy($I);
$loginPage->login('joannaleslye@gmail.com', '123456');

AboutPage::openBy($I);
$I->seeElement('#menu-principal');
//$I->see('Estudiantes');
$I->see('Estudiantes', 'a');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeLink('Exploracion de datos', '/estudiantes/index');
$I->click('Exploracion de datos');
$I->expectTo('lista-eventos');
$I->see('Olimpiada Prueba');
$I->see('2', 'td');
$I->seeLink('1', '/estudiantes/datos?EstudiantesBusqueda[NOMBRE_EVENTO]=56ba8bf35e273a21b45ecded&EstudiantesBusqueda[NRO_ETAPA]=1');
$I->click('1');
$I->expectTo('datos');
$I->see('9', 'td');

$I->seeElement('#test');
//$I->checkOption('#test');
$I->click('input[type=checkbox]');
$I->seeCheckboxIsChecked('#test');

