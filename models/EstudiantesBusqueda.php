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
            [['_id', 'DISTRITO_EDUCATIVO', 'MATERIA', 'CURSO', 'NOMBRE', 'Ap_PATERNO', 'Ap_MATERNO', 'RUDE', 'GENERO', 'CI', 'FECHA_NAC', 'CORREO', 'FONO', 'UE', 'TUTOR'], 'safe'],
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
            ->andFilterWhere(['like', 'DISTRITO_EDUCATIVO', $this->DISTRITO_EDUCATIVO])
            ->andFilterWhere(['like', 'MATERIA', $this->MATERIA])
            ->andFilterWhere(['like', 'CURSO', $this->CURSO])
            ->andFilterWhere(['like', 'NOMBRE', $this->NOMBRE])
            ->andFilterWhere(['like', 'Ap_PATERNO', $this->Ap_PATERNO])
            ->andFilterWhere(['like', 'Ap_MATERNO', $this->Ap_MATERNO])
            ->andFilterWhere(['like', 'RUDE', $this->RUDE])
            ->andFilterWhere(['like', 'GENERO', $this->GENERO])
            ->andFilterWhere(['like', 'CI', $this->CI])
            ->andFilterWhere(['like', 'FECHA_NAC', $this->FECHA_NAC])
            ->andFilterWhere(['like', 'CORREO', $this->CORREO])
            ->andFilterWhere(['like', 'FONO', $this->FONO])
            ->andFilterWhere(['like', 'UE', $this->UE])
            ->andFilterWhere(['like', 'TUTOR', $this->TUTOR]);

        return $dataProvider;
    }

    public function getFechaNaC()
    {
        $fecha = $this->FECHA_NAC;
        return date("d/m/Y", $fecha->sec);
    }
}
