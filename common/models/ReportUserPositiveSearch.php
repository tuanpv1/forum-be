<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ReportUserPositive;

/**
 * ReportUserPositiveSearch represents the model behind the search form of `common\models\ReportUserPositive`.
 */
class ReportUserPositiveSearch extends ReportUserPositive
{
    public $from_date;
    public $to_date;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date_report', 'total_number_positive', 'total_number_negattive'], 'integer'],
            [['user_positive_id', 'user_negative_id'], 'safe'],
            [['from_date', 'to_date'], 'safe'],
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
        $query = ReportUserPositive::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'date_report' => $this->date_report,
            'total_number_positive' => $this->total_number_positive,
            'total_number_negattive' => $this->total_number_negattive,
        ]);

        $query->andFilterWhere(['like', 'user_positive_id', $this->user_positive_id])
            ->andFilterWhere(['like', 'user_negative_id', $this->user_negative_id]);

        return $dataProvider;
    }
}
