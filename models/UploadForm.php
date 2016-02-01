<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */

class UploadForm extends Model
{
    public $ubicacion = "listas_excel/archivos/";
    /**
     * @var UploadedFile file attribute
     */
    public $archivo;
    public $nombre;
    public $gestion;
    public $etapas;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['archivo'], 'file', 'extensions' => 'xlsx, xls'],
            [['gestion', 'nombre', 'etapas', 'archivo'], 'required'],
            [['nombre', 'etapas'], 'string'],
            [['gestion'], 'number'],
        ];
    }

    public function gestiones(){
        $anio  = (int) date("Y");
        $gestion = array();
        for($i=2013; $i<=$anio+5;$i++){
            $gestion[$i] = $i;
        }
        return $gestion;
    }
    
}