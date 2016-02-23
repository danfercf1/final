<?php 
use tests\codeception\_pages\LoginPage;
use tests\codeception\_pages\AboutPage;


$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions for Estadisticas and see result');
$I->amOnPage(Yii::$app->homeUrl);

$loginPage = LoginPage::openBy($I);
$loginPage->login('joannaleslye@gmail.com', '123456');

AboutPage::openBy($I);
$I->seeLink('Estadisticas','/site/estadisticas');
$I->click('Estadisticas');
$I->seeElement('#estadisticas-form');
$I->submitForm('#estadisticas-form', array('CustomForm' => array(
             'evento' => 'Olimpiadas Matematicas Plurinacional',
             'gestion' => '2015',
             'etapa' => 'Etapa 2',
             'atributo' => 'Curso'
        )));

if (method_exists($I, 'wait')) {
    $I->wait(3); // only for selenium
}
$I->expectTo('graficas');
