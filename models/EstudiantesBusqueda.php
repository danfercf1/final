<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Estudiantes;

/**
 * EstudiantesBusqueda represents the model behind the search form about `app\models\Estudiantes`.
 */
class EstudiantesBusqueda extends Estudiantes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'PATERNO', 'CURSO', 'GENERO', 'MATERNO', 'CI', 'RUDE', 'NOMBRE', 'FECHA_NACIMIENTO', 'NOTA', 'DEPARTAMENTO', 'MATERIA', 'FONO', 'TUTOR', 'DISTRITO', 'UNIDAD_EDUCATIVA', 'CORREO', 'DISCAPACIDAD', 'NACIONALIDAD','EDAD', 'AREA', 'DEPENDENCIA'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Estudiantes::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'DISTRITO', $this->DISTRITO])
            ->andFilterWhere(['like', 'MATERIA', $this->MATERIA])
            ->andFilterWhere(['like', 'CURSO', $this->CURSO])
            ->andFilterWhere(['like', 'NOMBRE', $this->NOMBRE])
            ->andFilterWhere(['like', 'PATERNO', $this->PATERNO])
            ->andFilterWhere(['like', 'MATERNO', $this->MATERNO])
            ->andFilterWhere(['like', 'RUDE', $this->RUDE])
            ->andFilterWhere(['like', 'GENERO', $this->GENERO])
            ->andFilterWhere(['like', 'CI', $this->CI])
            ->andFilterWhere(['like', 'FECHA_NACIMIENTO', $this->FECHA_NACIMIENTO])
            ->andFilterWhere(['like', 'CORREO', $this->CORREO])
            ->andFilterWhere(['like', 'FONO', $this->FONO])
            ->andFilterWhere(['like', 'UE', $this->UNIDAD_EDUCATIVA])
            ->andFilterWhere(['like', 'TUTOR', $this->TUTOR])
            ->andFilterWhere(['like', 'AREA', $this->AREA])
            ->andFilterWhere(['like', 'DEPENDENCIA', $this->DEPENDENCIA]);
            
        if((int)$this->EDAD == 15){
            $query->andFilterWhere(['<=', 'EDAD', (int)$this->EDAD]);
        }
        else if((int)$this->EDAD == 17){
             $query->andFilterWhere(['>', 'EDAD', 15]); 
             $query->andFilterWhere(['<=', 'EDAD', (int)$this->EDAD]);  
        }
            

        return $dataProvider;
    }

    public function getFechaNaC()
    {
        $fecha = $this->FECHA_NACIMIENTO;
        return date("d/m/Y", $fecha->sec);
    }

    public function cursos(){
        return ['1s'=>'1ro Sec','2s'=>'2do Sec', '3s'=>'3ro Sec','4s'=>'4to Sec', '5s'=>'5to Sec', '6s'=>'6to Sec'];
    }
}
