<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "tutor".
 *
 * @property \MongoId|string $_id
 * @property mixed $NOMBRE
 * @property mixed $PATERNO
 * @property mixed $MATERNO
 * @property mixed $GENERO
 * @property mixed $CI
 * @property mixed $CORREO
 * @property mixed $FONO
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
            'NOMBRE',
            'PATERNO',
            'MATERNO',
            'GENERO',
            'CI',
            'CORREO',
            'FONO',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOMBRE', 'PATERNO', 'MATERNO', 'GENERO', 'CI', 'CORREO', 'FONO'], 'safe']
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
            'PATERNO' => 'Paterno',
            'MATERNO' => 'Materno',
            'GENERO' => 'Genero',
            'CI' => 'Ci',
            'CORREO' => 'Correo',
            'FONO' => 'Fono',
        ];
    }
}
