<?php

namespace app\models;
use yii\mongodb\Query;
use Yii;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $nombre;
    public $apellido;
    public $rol;

    /*private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];*/

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $query = new Query;
        // compose the query
        $query->select([])->where(["_id"=>new \MongoId($id)])->from('usuarios');
        // execute the query
        $usuario = $query->one();

        $id = new \MongoId($usuario['_id']);

        $resultado = array("id"=>$id->{'$id'}, "nombre"=>$usuario["nombre"], "apellido"=>$usuario["apellido"], "password"=>$usuario["password"],"rol"=>$usuario["rol"],"username"=>$usuario["username"]);

        return isset($usuario) ? new static($resultado) : null;

    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                var_dump($user);
                return new static($user);
            }
        }*/

        $query = new Query;
        // compose the query
        $query->select([])->where(["username"=>$username])->from('usuarios');
        // execute the query
        $usuario = $query->one();

        if($usuario){

            $id = new \MongoId($usuario['_id']);

            $resultado = array("id"=>$id->{'$id'}, "nombre"=>$usuario["nombre"], "apellido"=>$usuario["apellido"], "password"=>$usuario["password"],"rol"=>$usuario["rol"],"username"=>$usuario["username"]);

            return new static($resultado);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //var_dump($this->password, sha1($password));die;
        return $this->password === sha1($password);
    }
}
