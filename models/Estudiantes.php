<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "estudiantes".
 *
 * @property \MongoId|string $_id
 * @property mixed $PATERNO
 * @property mixed $CURSO
 * @property mixed $GENERO
 * @property mixed $MATERNO
 * @property mixed $CI
 * @property mixed $RUDE
 * @property mixed $NOMBRE
 * @property mixed $FECHA_NACIMIENTO
 * @property mixed $NOTA
 * @property mixed $DEPARTAMENTO
 * @property mixed $MATERIA
 * @property mixed $FONO
 * @property mixed $TUTOR
 * @property mixed $DISTRITO
 * @property mixed $UNIDAD_EDUCATIVA
 * @property mixed $CORREO
 * @property mixed $DISCAPACIDAD
 * @property mixed $NACIONALIDAD
  */
class Estudiantes extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $rango = 12;
    public $notaMin = 51;
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
            'PATERNO',
            'CURSO',
            'GENERO',
            'MATERNO',
            'CI',
            'RUDE',
            'NOMBRE',
            'FECHA_NACIMIENTO',
            'NOTA',
            'DEPARTAMENTO',
            'MATERIA',
            'FONO',
            'TUTOR',
            'DISTRITO',
            'UNIDAD_EDUCATIVA',
            'CORREO',
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
            [['PATERNO', 'CURSO', 'GENERO', 'MATERNO', 'CI', 'RUDE', 'NOMBRE', 'FECHA_NACIMIENTO', 'NOTA', 'DEPARTAMENTO', 'MATERIA', 'FONO', 'TUTOR', 'DISTRITO', 'UNIDAD_EDUCATIVA', 'CORREO', 'DISCAPACIDAD', 'NACIONALIDAD'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'PATERNO' => 'Apellido Paterno',
            'CURSO' => 'Curso',
            'GENERO' => 'Género',
            'MATERNO' => 'Apellido Materno',
            'CI' => 'CI',
            'RUDE' => 'RUDE',
            'NOMBRE' => 'Nombres',
            'FECHA_NACIMIENTO' => 'Fecha N.',
            'NOTA' => 'Nota',
            'MATERIA' => 'Materia',
            'FONO' => 'Teléfono',
            'TUTOR' => 'Tutor',
            'DISTRITO' => 'Distrito',
            'UNIDAD_EDUCATIVA' => 'Unidad Educativa',
            'CORREO' => 'Email',
            'DISCAPACIDAD'=>'Discapacidad',
            'NACIONALIDAD'=>'Nacionalidad'
        ];
    }

    public function getFechaNaC()
    {
        $fecha = $this->FECHA_NACIMIENTO;
        return date("d/m/Y", $fecha->sec);
    }

    public static function getNotaAlta()
    {
        return Estudiantes::find()->max(['NOTA']);
    }

    public function getUE()
    {
        return $this->hasOne(Ue::className(),['_id'=>'UNIDAD_EDUCATIVA']);
    }

    /*
     * Retornar Alumnos segun unidad educativa RURAL o URBANA
    */

    public function getAlumnos($limite=5, $area='u', $nota= 51){
        $notaSelec = [];
        $cont = 0;
        $notas = Estudiantes::find()->with('uE')->where(['NOTA'=>['$gte'=>$nota]])->orderBy(['NOTA' => SORT_DESC])->all();

        if($limite == 0){
            $limite = count($notas);
        }

        foreach($notas as $k=>$v){

            if($v->uE->AREA == $area && $cont < $limite){
                $notaSelec[$k] = $v;
                $cont++;
            }
        }
        return $notaSelec;
    }
}
