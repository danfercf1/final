<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "ue".
 *
 * @property \MongoId|string $_id
 * @property mixed $NOMBRE
 * @property mixed $CODIGOSIE
 * @property mixed $DEPENDENCIA
 * @property mixed $AREA
 * @property mixed $PROVINCIA
 * @property mixed $LOCALIDAD
 */
class Ue extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $last_id;

    public static function collectionName()
    {
        return ['datos', 'ue'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'NOMBRE',
            'CODIGOSIE',
            'DEPENDENCIA',
            'AREA',
            'PROVINCIA',
            'LOCALIDAD',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOMBRE', 'CODIGOSIE', 'DEPENDENCIA', 'AREA', 'PROVINCIA', 'LOCALIDAD'], 'safe']
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
            'CODIGOSIE' => 'Codigosie',
            'DEPENDENCIA' => 'Dependencia',
            'AREA' => 'Area',
            'PROVINCIA' => 'Provincia',
            'LOCALIDAD' => 'Localidad',
        ];
    }

    /*public function afterSave(){
        $this->last_id = $this->_id;
    }*/
}
