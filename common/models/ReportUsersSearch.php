<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ReportUsers;

/**
 * ReportUsersSearch represents the model behind the search form of `common\models\ReportUsers`.
 */
class ReportUsersSearch extends ReportUsers
{
    public $from_date;
    public $to_date;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date_report', 'total_user', 'user_ban', 'user_register'], 'integer'],
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
        $query = ReportUsers::find();

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
            'total_user' => $this->total_user,
            'user_ban' => $this->user_ban,
            'user_register' => $this->user_register,
        ]);
        if ($this->from_date) {
            $query->andFilterWhere(['>=', 'date_report', $this->from_date]);
        }
        if ($this->to_date) {
            $query->andFilterWhere(['<=', 'date_report', $this->to_date]);
        }

        return $dataProvider;
    }
}
