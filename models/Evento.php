<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "evento".
 *
 * @property \MongoId|string $_id
 * @property mixed $NOMBRE_EVENTO
 * @property mixed $USUARIO
 * @property mixed $ETAPAS
 * @property mixed $GESTION
 */
class Evento extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['datos', 'evento'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'NOMBRE_EVENTO',
            'USUARIO',
            'ETAPAS',
            'GESTION',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOMBRE_EVENTO', 'USUARIO', 'ETAPAS', 'GESTION'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'NOMBRE_EVENTO' => 'Nombre  Evento',
            'USUARIO' => 'Usuario',
            'ETAPAS' => 'Etapas',
            'GESTION' => 'Gestion',
        ];
    }

    /**
     * Relacion con evento
    */
    public function getEvento()
    {
        return $this->hasOne(EVENTO::className(),['_id'=>'NOMBRE_EVENTO']);
        //return $this->hasOne(Evento::className(),['_id'=>'NOMBRE_EVENTO']);
    }
    
    public function getGestionEvento()
    {   
        $anio  = (int) date("Y");
        $gestionEvento = 'GESTION';
        $gestion = array();
        for($i=$gestionEvento; $i<=$anio;$i++){
            $gestion[$i] = $i;
        }
        return $gestion;
    }

    public function obtenerNombres($list=false){

        $usuarios_model = new Usuarios();

        //$usuario = $usuarios_model->find()->where(['_id'=>Yii::$app->user->identity->getId()])->with('eventos')->one();

        $eventos = Evento::find()->all();

        $datos = [];

        if(!$list){
            foreach($eventos as $v){
                array_push($datos, $v['NOMBRE_EVENTO']);
            }
            return $datos;
        }else{
            //$eventos = $usuario->eventos;
            //foreach($eventos as $v){
                for($i=0;$i < count($eventos);$i++){
                    $id = new \MongoId($eventos[$i]['_id']);
                    $datos[$id->{'$id'}] = $eventos[$i]['NOMBRE_EVENTO'];
                }
            return $datos;
        }
    }

    public  function obtenerEtapasEvento($list=false, $action='/estudiantes/datos'){

        $cant_etapas = $this->ETAPAS;

        $etapas = [];
        $etapasT = '';

        if(!$list){
            for ($i=1; $i <= $cant_etapas; $i++){

                if($action == '/estudiantes/datos'){
                    if($i == 1){
                        $selecc = "";
                    }else{
                        $selecc = "&EstudiantesBusqueda[SELECC_ETAPA".($i-1)."]=1";
                    }
                    $etapasT .= '<a class="link_etapas" href="'.$action.'?EstudiantesBusqueda[NOMBRE_EVENTO]='.$this->_id.'&EstudiantesBusqueda[NRO_ETAPA]='.$i.$selecc.'" id="etapa_'.$i.'"><span>'.$i.'</span></a>';
                }else if($action == '/site/r_general'){

                    $selecc = "&EstudiantesBusqueda[SELECC_ETAPA".$i."]=1";

                    $etapasT .= '<a class="link_etapas" href="'.$action.'?EstudiantesBusqueda[NOMBRE_EVENTO]='.$this->_id.'&EstudiantesBusqueda[NRO_ETAPA]='.$i.$selecc.'&sort=-NOTA_ETAPA'.$i.'" id="etapa_'.$i.'"><span>'.$i.'</span></a>';
                }
            }
            return $etapasT;
        }else{
            for ($i=1; $i <= $cant_etapas; $i++){
                $etapas[$i] = 'Etapa '.$i;
            }

            return $etapas;
        }

    }

    public function beforeDelete()
    {
        Estudiantes::deleteAll(['NOMBRE_EVENTO'=>$this->_id]);
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }
}
