<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "ue".
 *
 * @property \MongoId|string $_id
 * @property mixed $PROVINCIA
 * @property mixed $NOMBRE_UE
 * @property mixed $AREA
 * @property mixed $COD_SIE
 * @property mixed $CANTON
 * @property mixed $DEPENDENCIA
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
            'PROVINCIA',
            'NOMBRE_UE',
            'AREA',
            'COD_SIE',
            'SECCION',
            'CANTON',
            'DEPENDENCIA',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROVINCIA', 'NOMBRE_UE', 'AREA', 'COD_SIE', 'SECCION', 'CANTON', 'DEPENDENCIA'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'PROVINCIA' => 'Provincia',
            'NOMBRE_UE' => 'Nombre',
            'AREA' => 'Area',
            'COD_SIE' => 'C�digo SIE',
            'SECCION' => 'Secci�n',
            'CANTON' => 'Cant�n',
            'DEPENDENCIA' => 'Dependencia',
        ];
    }

    public function getEstudiantes(){
        return $this->hasMany(Estudiantes::className(),['UNIDAD_EDUCATIVA'=>'_id']);
    }

    /*public function afterSave(){
        $this->last_id = $this->_id;
    }*/
}
