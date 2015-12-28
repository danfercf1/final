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
    public static function collectionName()
    {
        return ['datos', 'usuarios'];
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
            [['nombre', 'apellido', 'username', 'password', 'rol', 'fecha_creacion', 'oldPassword'], 'safe']
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
            'rol' => 'Rol',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }

    public function beforeSave($insert)
    {

        if ($this->oldPassword != $this->password) {
            $this->password = sha1($this->password);
        }

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
