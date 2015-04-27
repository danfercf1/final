<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ue;

/**
 * UeBusqueda represents the model behind the search form about `app\models\Ue`.
 */
class UeBusqueda extends Ue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'NOMBRE', 'CODIGOSIE', 'DEPENDENCIA', 'AREA', 'PROVINCIA', 'LOCALIDAD'], 'safe'],
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
        $query = Ue::find();

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
            ->andFilterWhere(['like', 'CODIGOSIE', $this->CODIGOSIE])
            ->andFilterWhere(['like', 'DEPENDENCIA', $this->DEPENDENCIA])
            ->andFilterWhere(['like', 'AREA', $this->AREA])
            ->andFilterWhere(['like', 'PROVINCIA', $this->PROVINCIA])
            ->andFilterWhere(['like', 'LOCALIDAD', $this->LOCALIDAD]);

        return $dataProvider;
    }
}
