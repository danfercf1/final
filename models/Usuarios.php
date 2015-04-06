<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "usuarios".
 *
 * @property \MongoId|string $_id
 * @property mixed $nombre
 * @property mixed $apellido
 * @property mixed $email
 * @property mixed $password
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
            'email',
            'password',
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
            [['nombre', 'apellido', 'email', 'password', 'rol', 'fecha_creacion'], 'safe']
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
            'email' => 'Email',
            'password' => 'Password',
            'rol' => 'Rol',
            'fecha_creacion' => 'Fecha Creacion',
        ];
    }
}
