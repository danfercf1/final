<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tutor;

/**
 * TutoresBusqueda represents the model behind the search form about `app\models\Tutor`.
 */
class TutoresBusqueda extends Tutor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'NOMBRE_T', 'PATERNO_T', 'MATERNO_T', 'GENERO_T', 'CI_T', 'CORREO_T', 'FONO_T'], 'safe'],
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
        $query = Tutor::find();

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
            ->andFilterWhere(['like', 'NOMBRE_T', $this->NOMBRE_T])
            ->andFilterWhere(['like', 'PATERNO_T', $this->PATERNO_T])
            ->andFilterWhere(['like', 'MATERNO_T', $this->MATERNO_T])
            ->andFilterWhere(['like', 'GENERO_T', $this->GENERO_T])
            ->andFilterWhere(['like', 'CI_T', $this->CI_T])
            ->andFilterWhere(['like', 'CORREO_T', $this->CORREO_T])
            ->andFilterWhere(['like', 'FONO_T', $this->FONO_T]);

        return $dataProvider;
    }
}
