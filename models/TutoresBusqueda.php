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
            [['_id', 'NOMBRE', 'PATERNO', 'MATERNO', 'GENERO', 'CI', 'CORREO', 'FONO'], 'safe'],
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
            ->andFilterWhere(['like', 'NOMBRE', $this->NOMBRE])
            ->andFilterWhere(['like', 'PATERNO', $this->PATERNO])
            ->andFilterWhere(['like', 'MATERNO', $this->MATERNO])
            ->andFilterWhere(['like', 'GENERO', $this->GENERO])
            ->andFilterWhere(['like', 'CI', $this->CI])
            ->andFilterWhere(['like', 'CORREO', $this->CORREO])
            ->andFilterWhere(['like', 'FONO', $this->FONO]);

        return $dataProvider;
    }
}
