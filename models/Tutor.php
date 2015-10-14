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
 * @property mixed $GESTION
 * @property mixed $UE
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
            'GESTION',
            'UE',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOMBRE', 'PATERNO', 'MATERNO', 'GENERO', 'CI', 'CORREO', 'FONO', 'GESTION', 'UE'], 'safe']
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
            'PATERNO' => 'Ap. Paterno',
            'MATERNO' => 'Ap. Materno',
            'GENERO' => 'Genero',
            'CI' => 'CI',
            'CORREO' => 'Correo',
            'FONO' => 'Telefono',
            'GESTION' => 'Gestion',
            'UE' => 'Unidad Educativa',
        ];
    }
}
