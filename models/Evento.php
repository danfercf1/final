<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "distrito".
 *
 * @property \MongoId|string $_id
 * @property mixed $NOMBRE_EVENTO
 * @property mixed $GESTION
 */
class Distrito extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['datos', 'evento'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'NOMBRE_EVENTO',
            'GESTION',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOMBRE_EVENTO', 'GESTION'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'NOMBRE_EVENTO' => 'Nombre Evento',
            'GESTION' => 'Gestión'
        ];
    }

    public function obtenerNombreEventos(){
        $eventos =  $this::find()->asArray()->all();
        $datos = [];
        foreach($eventos as $v){
            array_push($datos, $v['NOMBRE_EVENTO']);
        }
        return $datos;
    }
}