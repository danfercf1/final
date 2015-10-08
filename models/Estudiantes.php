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
 * @property mixed $GESTION
 * @property mixed $UE
 * @property mixed $TUTOR
 * @property mixed $NOTA
 * @property mixed $DISCAPACIDAD
 * @property mixed $NACIONALIDAD
 */
class Estudiantes extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $rango = 12;
    public static function collectionName()
    {
        return ['datos', 'estudiante'];
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
            'GESTION',
            'UE',
            'TUTOR',
            'NOTA',
            'DISCAPACIDAD',
            'NACIONALIDAD'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DISTRITO_EDUCATIVO', 'MATERIA', 'CURSO', 'NOMBRE', 'Ap_PATERNO', 'Ap_MATERNO', 'RUDE', 'GENERO', 'CI', 'FECHA_NAC', 'CORREO', 'FONO', 'NOTA', 'GESTION', 'UE', 'TUTOR', 'DISCAPACIDAD', 'NACIONALIDAD'], 'safe']
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
            'Ap_PATERNO' => 'Ap.  Paterno',
            'Ap_MATERNO' => 'Ap.  Materno',
            'RUDE' => 'Rude',
            'GENERO' => 'Género',
            'CI' => 'CI',
            'FECHA_NAC' => 'Fecha  Nacimiento',
            'CORREO' => 'Correo',
            'FONO' => 'Teléfono',
            'GESTION' => 'Gestión',
            'UE' => 'Unidad Educativa',
            'TUTOR' => 'Tutor',
            'NOTA' => 'Nota',
            'DISCAPACIDAD'=>'Discapacidad',
            'NACIONALIDAD'=>'Nacionalidad'
        ];
    }

    public function getFechaNaC()
    {
        $fecha = $this->FECHA_NAC;
        return date("d/m/Y", $fecha->sec);
    }
}
