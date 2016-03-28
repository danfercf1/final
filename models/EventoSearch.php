<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Evento;

/**
 * EventoSearch represents the model behind the search form about `app\models\Evento`.
 */
class EventoSearch extends Evento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'NOMBRE_EVENTO', 'USUARIO', 'ETAPAS', 'GESTION'], 'safe'],
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
        $query = Evento::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'NOMBRE_EVENTO', $this->NOMBRE_EVENTO])
            //->andFilterWhere(['=', 'USUARIO', new \MongoId(\Yii::$app->user->identity->id)])
            ->andFilterWhere(['like', 'ETAPAS', $this->ETAPAS]);

        if(isset($this->GESTION) && !empty($this->GESTION)){
                $query->andFilterWhere(['=', 'GESTION', (int)$this->GESTION]);
        }

        return $dataProvider;
    }
}
