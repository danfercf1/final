<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "estudiantes".
 *
 * @property \MongoId|string $_id
 * @property mixed $DISTRITO_EDUCATIVO
 * @property mixed $MATERIA
 * @property mixed $CURSO
 * @property mixed $NOMBRE
 * @property mixed $Ap_PATERNO
 * @property mixed $Ap_MATERNO
 * @property mixed $RUDE
 * @property mixed $GENERO
 * @property mixed $CI
 * @property mixed $FECHA_NAC
 * @property mixed $CORREO
 * @property mixed $FONO
 */
class Estudiantes extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['datos', 'estudiantes'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'DISTRITO_EDUCATIVO',
            'MATERIA',
            'CURSO',
            'NOMBRE',
            'Ap_PATERNO',
            'Ap_MATERNO',
            'RUDE',
            'GENERO',
            'CI',
            'FECHA_NAC',
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
            [['DISTRITO_EDUCATIVO', 'MATERIA', 'CURSO', 'NOMBRE', 'Ap_PATERNO', 'Ap_MATERNO', 'RUDE', 'GENERO', 'CI', 'FECHA_NAC', 'CORREO', 'FONO'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'DISTRITO_EDUCATIVO' => 'Distrito  Educativo',
            'MATERIA' => 'Materia',
            'CURSO' => 'Curso',
            'NOMBRE' => 'Nombre',
            'Ap_PATERNO' => 'Ap  Paterno',
            'Ap_MATERNO' => 'Ap  Materno',
            'RUDE' => 'Rude',
            'GENERO' => 'Genero',
            'CI' => 'Ci',
            'FECHA_NAC' => 'Fecha  Nac',
            'CORREO' => 'Correo',
            'FONO' => 'Fono',
        ];
    }

    public function getFechaNaC()
    {
        $fecha = $this->FECHA_NAC;
        return date("d/m/Y", $fecha->sec);
    }
}
