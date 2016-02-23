<?php
namespace app\models;

use yii\base\Model;


class CustomForm extends Model
{
    /**
     * @var 
     */
    public $evento;
    public $gestion;
    public $etapa; 
    public $cantidad;
    public $atributo;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
             [['etapa'], 'string'],
             [['gestion'], 'number'],
             [['cantidad'], 'integer'],
             ['cantidad', 'compare', 'compareValue' => 0, 'operator' => '>'],
             ['cantidad', 'compare', 'compareValue' => 100, 'operator' => '<='],        
            //[['cantidad'], 'number','min'=>1,'max'=>100],
             [['atributo'],'string']
        ];
    }

    public function gestiones(){

        $usuario = \Yii::$app->user->getId();

        $anio_min = Evento::find()->where(['USUARIO'=> new \MongoId($usuario)])->min('GESTION');
        $anio_max = Evento::find()->where(['USUARIO'=> new \MongoId($usuario)])->max('GESTION');

        $gestion = array();

        if($anio_max > $anio_min){
            for($i=$anio_min; $i<=$anio_max;$i++){
                $gestion[$i] = $i;
            }
        }else{
            $gestion[$anio_min] = $anio_min;
        }

        return $gestion;
    }
}