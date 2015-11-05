<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "tutor".
 *
 * @property \MongoId|string $_id
 * @property mixed $NOMBRE_T
 * @property mixed $PATERNO_T
 * @property mixed $MATERNO_T
 * @property mixed $GENERO_T
 * @property mixed $CI_T
 * @property mixed $CORREO_T
 * @property mixed $FONO_T
 */
class Tutor extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['datos', 'tutor'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'NOMBRE_T',
            'PATERNO_T',
            'MATERNO_T',
            'GENERO_T',
            'CI_T',
            'CORREO_T',
            'FONO_T',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOMBRE_T', 'PATERNO_T', 'MATERNO_T', 'GENERO_T', 'CI_T', 'CORREO_T', 'FONO_T'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'NOMBRE_T' => 'Nombre',
            'PATERNO_T' => 'Ap. Paterno',
            'MATERNO_T' => 'Ap. Materno',
            'GENERO_T' => 'Genero',
            'CI_T' => 'CI',
            'CORREO_T' => 'Correo',
            'FONO_T' => 'Telefono',
        ];
    }
    
    
    public function nombreCompleto()
    {
        return $this->NOMBRE_T.' '.$this->PATERNO_T.' '.$this->MATERNO_T;
    }
}
