<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */

class UploadForm extends Model
{
    public $ubicacion = "listas_excel/";
    /**
     * @var UploadedFile file attribute
     */
    public $file;
    public $gestion;
    public $etapa;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            //[['file'], 'file', 'extensions' => 'xlsx'],
            /*[['gestion'], 'required'],*/
            [['gestion'], 'number'],
        ];
    }

    public function gestiones(){
        $anio  = (int) date("Y");
        $gestion = array();
        for($i=$anio; $i<=$anio+10;$i++){
            $gestion[$i] = $i;
        }
        return $gestion;
    }
    
}