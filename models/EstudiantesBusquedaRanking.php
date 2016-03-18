<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Estudiantes;

/**
 * EstudiantesBusqueda represents the model behind the search form about `app\models\Estudiantes`.
 */
class EstudiantesBusquedaRanking extends Estudiantes
{
    /**
     * @inheritdoc
     */

    public $etapa;
    public $cantidad;
    public $atributo;
    const SCENARIO_SEARCH = 'search';

    public function rules()
    {
        return [
            [['etapa'], 'string'],
            [['cantidad'], 'integer'],
            ['cantidad', 'compare', 'compareValue' => 0, 'operator' => '>'],
            ['cantidad', 'compare', 'compareValue' => 100, 'operator' => '<='],
            //[['cantidad'], 'number','min'=>1,'max'=>100],
            [['atributo'],'string'],
            [['_id', 'PATERNO', 'CURSO', 'GENERO', 'MATERNO', 'CI', 'RUDE', 'NOMBRE', 'FECHA_NACIMIENTO', 'NOTA', 'DEPARTAMENTO', 'MATERIA', 'FONO', 'TUTOR', 'DISTRITO', 'UNIDAD_EDUCATIVA', 'CORREO', 'DISCAPACIDAD', 'NACIONALIDAD','EDAD', 'AREA', 'DEPENDENCIA', 'NOMBRE_EVENTO', 'SELECC_ETAPA1', 'SELECC_ETAPA2', 'SELECC_ETAPA3', 'SELECC_ETAPA4', 'SELECC_ETAPA5'], 'safe'],
            [['cantidad', 'NOMBRE_EVENTO', 'GESTION', 'NRO_ETAPA', 'atributo'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_SEARCH => ['cantidad', 'NOMBRE_EVENTO', 'GESTION', 'NRO_ETAPA', 'atributo'],
        ];
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

        if(isset($params['EstudiantesBusquedaRanking']['cantidad']) && !empty($params['EstudiantesBusquedaRanking']['cantidad'])){

            $pag = ((int) $params['EstudiantesBusquedaRanking']['cantidad'] % 20 == 0) ? 20 : 10;

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'totalCount' => (int) $params['EstudiantesBusquedaRanking']['cantidad'],
                'pagination' => [
                    'pageSize' => $pag,
                ],
            ]);
        }else{
            $dataProvider = new ActiveDataProvider([
                'query' => $query
            ]);
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'DISTRITO', $this->DISTRITO])
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
            ->andFilterWhere(['like', 'DEPENDENCIA', $this->DEPENDENCIA])
            ->andFilterWhere(['=', 'NOMBRE_EVENTO', new \MongoId($this->NOMBRE_EVENTO)]);

            if(isset($this->SELECC_ETAPA1)){
                $query->andFilterWhere(['=', 'SELECC_ETAPA1', (int)$this->SELECC_ETAPA1]);
            }else if(isset($this->SELECC_ETAPA2)){
                $query->andFilterWhere(['=', 'SELECC_ETAPA2', (int)$this->SELECC_ETAPA2]);
            }else if(isset($this->SELECC_ETAPA3)){
                $query->andFilterWhere(['=', 'SELECC_ETAPA3', (int)$this->SELECC_ETAPA3]);
            }else if(isset($this->SELECC_ETAPA4)){
                $query->andFilterWhere(['=', 'SELECC_ETAPA4', (int)$this->SELECC_ETAPA4]);
            }else if(isset($this->SELECC_ETAPA5)){
                $query->andFilterWhere(['=', 'SELECC_ETAPA5', (int)$this->SELECC_ETAPA5]);
            }

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
