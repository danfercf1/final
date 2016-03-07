<?php 
use tests\codeception\_pages\LoginPage;
use tests\codeception\_pages\AboutPage;


$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions for Ranking Personalizado and see result');
$I->amOnPage(Yii::$app->homeUrl);

$loginPage = LoginPage::openBy($I);
$loginPage->login('joannaleslye@gmail.com', '123456');

AboutPage::openBy($I);
$I->seeElement('#menu-principal');
//$I->see('Estudiantes');
$I->see('Clasificacion', 'a');
if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->seeLink('Personalizar ranking', '/site/personalizar');
$I->click('Personalizar ranking');
$I->seeElement('#form_personalizado');
$I->submitForm('#form_personalizado', array('CustomForm' => array(
             'nombre evento' => 'Olimpiadas Matematicas Plurinacional',
             'gestion' => '2015',
             'nro etapa' => '2',
             'cantidad' => '5',
             'multiselect' => [
                 'Distrito',
                 'Curso',
                 'Edad',
                 'Area',
                 'Dependencia',
                 'Genero'
             ]
        )));

if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->expectTo('rankingpersonalizado');