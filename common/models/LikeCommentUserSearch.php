<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LikeCommentUser;

/**
 * LikeCommentUserSearch represents the model behind the search form of `common\models\LikeCommentUser`.
 */
class LikeCommentUserSearch extends LikeCommentUser
{
    public $from_date;
    public $to_date;
    public $username;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date_report', 'user_id', 'like_count', 'answer_true', 'answer_false'], 'integer'],
            [['from_date', 'to_date', 'username'], 'safe'],
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
        $query = LikeCommentUser::find();

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
            'user_id' => $this->user_id,
            'like_count' => $this->like_count,
            'answer_true' => $this->answer_true,
            'answer_false' => $this->answer_false,
        ]);

        if ($this->from_date) {
            $query->andFilterWhere(['>=', 'date_report', $this->from_date]);
        }
        if ($this->to_date) {
            $query->andFilterWhere(['<=', 'date_report', $this->to_date]);
        }
        if($this->username){
            $query->innerJoin('phpbb_users','phpbb_users.user_id = phpbb_like_comment_user.user_id')
                ->andWhere(['like', 'phpbb_users.username_clean', $this->username]);
        }

        return $dataProvider;
    }
}
