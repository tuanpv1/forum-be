<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ReportTopics;

/**
 * ReportTopicsSearch represents the model behind the search form of `common\models\ReportTopics`.
 */
class ReportTopicsSearch extends ReportTopics
{
    public $from_date;
    public $to_date;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date_report', 'forum_id', 'topic_id', 'like_count', 'total_post', 'view_count', 'rate_count'], 'integer'],
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
        $query = ReportTopics::find();
        $query->select(
            'COUNT(topic_id) as topic_id,
            SUM(total_post) as total_post,
            SUM(like_count) as like_count,
            SUM(view_count) as view_count,
            SUM(rate_count) as rate_count,
            date_report'
        );
        $query->groupBy('date_report');

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

        if ($this->from_date) {
            $query->andFilterWhere(['>=', 'date_report', $this->from_date]);
        }
        if ($this->to_date) {
            $query->andFilterWhere(['<=', 'date_report', $this->to_date]);
        }
        if ($this->forum_id) {
            $query->andFilterWhere(['forum_id'=>$this->forum_id]);
        }

        return $dataProvider;
    }

    public function searchDetail($params)
    {
        $query = ReportTopics::find();

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
            'topic_id' => $this->topic_id,
            'like_count' => $this->like_count,
            'total_post' => $this->total_post,
            'view_count' => $this->view_count,
            'rate_count' => $this->rate_count,
        ]);

        if ($this->from_date) {
            $query->andFilterWhere(['>=', 'date_report', $this->from_date]);
        }
        if ($this->to_date) {
            $query->andFilterWhere(['<=', 'date_report', $this->to_date]);
        }
        if ($this->to_date) {
            $query->andFilterWhere(['forum_id'=>$this->forum_id]);
        }

        return $dataProvider;
    }
}
