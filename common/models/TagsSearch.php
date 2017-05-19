<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tags;

/**
 * TagsSearch represents the model behind the search form about `common\models\Tags`.
 */
class TagsSearch extends Tags
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'count', 'tag_status'], 'integer'],
            [['tag', 'tag_lowercase'], 'safe'],
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
        $query = Tags::find();

        // add conditions that should always apply here

        $orderDefault = [];
        $orderDefault['id'] = SORT_DESC;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => $orderDefault,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'count' => $this->count,
            'tag_status' => $this->tag_status,
        ]);

        $query->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'tag_lowercase', $this->tag_lowercase]);

        return $dataProvider;
    }
}
