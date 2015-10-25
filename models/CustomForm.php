<?php
namespace app\models;

use yii\base\Model;


class CustomForm extends Model
{
    /**
     * @var 
     */
    public $cantidad;
    public $atributo;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
        
             [['cantidad'], 'integer'],
             ['cantidad', 'compare', 'compareValue' => 0, 'operator' => '>'],
             ['cantidad', 'compare', 'compareValue' => 100, 'operator' => '<='],        
            //[['cantidad'], 'number','min'=>1,'max'=>100],
             [['atributo'],'string'] 
        ];
    }

    /*public function gestiones(){
        $anio  = (int) date("Y");
        $gestion = array();
        for($i=$anio; $i<=$anio+10;$i++){
            $gestion[$i] = $i;
        }
        return $gestion;
    }*/
    
}