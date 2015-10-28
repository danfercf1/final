<?php
namespace app\models;

use yii\base\Model;


class MultiSelectForm extends Model
{
    /**
     * @var 
     */
     public $atributo;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
             [['atributo'],'string'] 
        ];
    }
    
}