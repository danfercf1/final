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
            [['archivo'], 'file', 'extensions' => 'xlsx'],
            [['gestion', 'nombre', 'etapas', 'archivo'], 'required'],
            [['nombre', 'etapas'], 'string'],
            [['gestion'], 'number'],
        ];
    }

    public function gestiones(){
        $anio  = (int) date("Y");
        $gestion = array();
        for($i=$anio; $i<=$anio+5;$i++){
            $gestion[$i] = $i;
        }
        return $gestion;
    }
    
}