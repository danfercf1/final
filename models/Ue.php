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
 * @property mixed $SECCION
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
            'COD_SIE' => 'Codigo SIE',
            'SECCION' => 'Seccion',
            'CANTON' => 'Canton',
            'DEPENDENCIA' => 'Dependencia',
        ];
    }

    public function getEstudiantes(){
        return $this->hasMany(Estudiantes::className(),['UNIDAD_EDUCATIVA'=>'_id']);
    }

    /*public function afterSave(){
        $this->last_id = $this->_id;
    }*/
    
    public function getNombreUE($id){
        //$id2='563183ea5e273a19642e9efe';
        $uenombre = Ue::find()->where(['_id'=>$id])->one();
        return $uenombre->AREA;
        //return $id;
    }
    
}
