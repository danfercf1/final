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

    public function obtenerNombres(){
        $model =  $this::find()->asArray()->all();
        $datos = [];
        foreach($model as $v){
            array_push($datos, $v['NOMBRE_EVENTO']);
        }
        return $datos;
    }
}
