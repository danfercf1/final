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
 * @property mixed $EDAD
 * @property mixed $ETAPAS
 * @property mixed $GESTION
 * @property mixed $COD_SIE
 * @property mixed $NOMBRE_UE
 * @property mixed $SECCION
 * @property mixed $CANTON
 * @property mixed $PROVINCIA
 * @property mixed $AREA
 * @property mixed $DEPENDENCIA
 * @property mixed $NOMBRE_EVENTO
 */
class Estudiantes extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $rango = 12;
    public $notaMin = 51;
    public $NOTA_ETAPA1;
    public $NOTA_ETAPA2;
    public $NOTA_ETAPA3;
    public $NOTA_ETAPA4;
    public $NOTA_ETAPA5;


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
            'NACIONALIDAD',
            'EDAD',
            'ETAPAS',
            'COD_SIE',
            'NOMBRE_UE',
            'SECCION',
            'CANTON',
            'PROVINCIA',
            'AREA',
            'DEPENDENCIA',
            'NOMBRE_EVENTO',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PATERNO', 'CURSO', 'GENERO', 'MATERNO', 'CI', 'RUDE', 'NOMBRE', 'FECHA_NACIMIENTO', 'NOTA', 'DEPARTAMENTO', 'MATERIA', 'FONO', 'TUTOR', 'DISTRITO', 'UNIDAD_EDUCATIVA', 'CORREO', 'DISCAPACIDAD', 'NACIONALIDAD', 'EDAD', 'GESTION','COD_SIE', 'NOMBRE_UE', 'AREA', 'SECCION', 'CANTON', 'PROVINCIA', 'AREA', 'DEPENDENCIA', 'NOMBRE_EVENTO'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'PATERNO' => 'Ap. Paterno',
            'CURSO' => 'Curso',
            'GENERO' => 'Género',
            'MATERNO' => 'Ap. Materno',
            'CI' => 'CI',
            'RUDE' => 'RUDE',
            'NOMBRE' => 'Nombre',
            'FECHA_NACIMIENTO' => 'Fecha Nacimiento',
            'NOTA' => 'Nota',
            'MATERIA' => 'Materia',
            'FONO' => 'Teléfono',
            'TUTOR' => 'Tutor',
            'DISTRITO' => 'Distrito Educativo',
            'UNIDAD_EDUCATIVA' => 'Unidad Educativa',
            'CORREO' => 'Correo',
            'DISCAPACIDAD'=>'Discapacidad',
            'NACIONALIDAD'=>'Nacionalidad',
            'EDAD'=>'Edad',
            'GESTION'=>'Gestión',
            'AREA' => 'Area',
            'DEPENDENCIA' => 'Dependencia',
            'NOMBRE_EVENTO' => 'Evento',
        ];
    }

    public function getFechaNaC()
    {
        $fecha = $this->FECHA_NACIMIENTO;
        return date("d/m/Y", $fecha->sec);
    }
    
    public function getEdad($fecha)
    {
        $dias = explode("/", $fecha, 3);
        $dias = mktime(0,0,0, $dias[1], 0, $dias[2]);
        $edad = (int)((time()-$dias)/31556926);
        return $edad;
        
        /*list($dia,$mes,$ano) = explode("/",$fecha);
    	$ano_diferencia  = date("Y") - $ano;
    	$mes_diferencia = date("m") - $mes;
    	$dia_diferencia   = date("d") - $dia;
    	if ($dia_diferencia < 0 || $mes_diferencia < 0)
    		$ano_diferencia--;
    	return $ano_diferencia;*/
    }

    public static function getNotaAlta()
    {
        return Estudiantes::find()->max(['NOTA']);
    }

    public function getUE()
    {
        return $this->hasOne(Ue::className(),['_id'=>'UNIDAD_EDUCATIVA']);
    }

    public function getTutor()
    {
        return $this->hasOne(Tutor::className(),['_id'=>'TUTOR']);
    }

    /*
     * Retornar Alumnos segun unidad educativa RURAL o URBANA
    */

    public function getAlumnos($limite=0, $area='u', $nota = 0){
        $notaSelec = [];
        $cont = 0;
        $notas = Estudiantes::find()->with('uE')->all();

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

    public function nombreCompleto()
    {
        return $this->NOMBRE.' '.$this->PATERNO.' '.$this->MATERNO;
    }

    public function obtenerEtapas($gestion){

        $atributos = [];

        $estudiante = Estudiantes::find()->where(['GESTION'=>(string)$gestion])->one();

        $etapas = $estudiante->ETAPAS;

        for($i=1; $i <= $etapas; $i++){
            array_push($atributos, "NOTA_ETAPA".$i);
        }

        return implode(",", $atributos);
    }

}
