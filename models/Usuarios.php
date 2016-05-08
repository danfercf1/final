<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "usuarios".
 *
 * @property \MongoId|string $_id
 * @property mixed $nombre
 * @property mixed $apellido
 * @property mixed $username
 * @property mixed $password
 * @property mixed $oldPassword
 * @property mixed $rol
 * @property mixed $fecha_creacion
 */
class Usuarios extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    CONST SCENARIO_UPDATE = 'update';
    CONST SCENARIO_DEFAULT = 'default';
    CONST SCENARIO_CREATE = 'create';
    public static function collectionName()
    {
        return ['datos', 'usuarios'];
    }

    public function scenarios()
    {
        return [
            //self::SCENARIO_UPDATE => ['FECHA_NACIMIENTO', 'NOMBRE', 'MATERNO', 'PATERNO', 'CI', 'FONO', 'CORREO'],
            self::SCENARIO_CREATE => ['nombre', 'apellido','username','password','repeat_pass', 'rol', 'fecha_creacion'],
            self::SCENARIO_DEFAULT => ['nombre', 'apellido','username','password','repeat_pass', 'rol', 'fecha_creacion'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'nombre',
            'apellido',
            'username',
            'password',
            'repeat_pass',
            'oldPassword',
            'rol',
            'fecha_creacion',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'username', 'password', 'rol', 'fecha_creacion', 'oldPassword'], 'safe'],
            [['nombre', 'apellido', 'username', 'password', 'rol', 'repeat_pass'], 'required'],
            [['username'], 'email'],
            [['username'], 'unique'],
            ['repeat_pass', 'compare', 'compareAttribute'=>'password', 'message'=>"Contraseñas no coinciden", 'on' => 'create' ],
            [['repeat_pass', 'password'], 'string', 'min'=>6, 'max'=>16]

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'username' => 'Email',
            'password' => 'Password',
            'repeat_pass' => 'Repetir password',
            'rol' => 'Rol',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    public function beforeSave($insert)
    {

        if ($this->oldPassword != $this->password) {
            $this->password = sha1($this->password);
        }

        $this->fecha_creacion = new \MongoDate();

        return parent::beforeSave($insert);
    }
    
    public function nombreCompleto()
    {
        return $this->nombre.' '.$this->apellido;
    }

    public function getEventos(){
        return $this->hasMany(Evento::className(), ['USUARIO'=>'_id']);
    }
}
