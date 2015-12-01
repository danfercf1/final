<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "distrito".
 *
 * @property \MongoId|string $_id
 * @property mixed $NOMBRE
 */
class Distrito extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['datos', 'distrito'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'NOMBRE',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOMBRE'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'NOMBRE' => 'Nombre',
        ];
    }

    public function obtenerNombres(){
        $distritos =  $this::find()->asArray()->all();
        $datos = [];
        foreach($distritos as $v){
            array_push($datos, $v['NOMBRE']);
        }
        return $datos;
    }
}
