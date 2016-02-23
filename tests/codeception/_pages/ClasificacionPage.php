<?php
namespace tests\codeception\_pages;

use yii\codeception\BasePage;

class ClasificacionPage extends BasePage
{
    public $route = 'site/graficas';

   /**
     * @param string $evento
     * @param string $gestion
     * @param string $etapa
     * @param string $atributo
     */
   
    public function verEstadisticas($evento, $gestion, $etapa, $atributo)
    {
        $this->actor->submitForm('#estadisticas-form', array('CustomForm' => array(
             'evento' => 'Olimpiadas Matematicas Plurinacional',
             'gestion' => '2015',
             'etapa' => 'Etapa 2',
             'atributo' => 'Curso'
        )));
        
    }
}