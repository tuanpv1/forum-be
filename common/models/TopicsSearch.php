<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Topics;

/**
 * TopicsSearch represents the model behind the search form about `common\models\Topics`.
 */
class TopicsSearch extends Topics
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_id', 'forum_id', 'icon_id', 'topic_attachment', 'topic_reported', 'topic_poster', 'topic_time', 'topic_time_limit', 'topic_views', 'topic_status', 'topic_type', 'topic_first_post_id', 'topic_last_post_id', 'topic_last_poster_id', 'topic_last_post_time', 'topic_last_view_time', 'topic_moved_id', 'topic_bumped', 'topic_bumper', 'poll_start', 'poll_length', 'poll_max_options', 'poll_last_vote', 'poll_vote_change', 'topic_visibility', 'topic_delete_time', 'topic_delete_user', 'topic_posts_approved', 'topic_posts_unapproved', 'topic_posts_softdeleted'], 'integer'],
            [['topic_title', 'topic_first_poster_name', 'topic_first_poster_colour', 'topic_last_poster_name', 'topic_last_poster_colour', 'topic_last_post_subject', 'poll_title', 'topic_delete_reason'], 'safe'],
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
        $query = Topics::find();

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
            'topic_id' => $this->topic_id,
            'forum_id' => $this->forum_id,
            'icon_id' => $this->icon_id,
            'topic_attachment' => $this->topic_attachment,
            'topic_reported' => $this->topic_reported,
            'topic_poster' => $this->topic_poster,
            'topic_time' => $this->topic_time,
            'topic_time_limit' => $this->topic_time_limit,
            'topic_views' => $this->topic_views,
            'topic_status' => $this->topic_status,
            'topic_type' => $this->topic_type,
            'topic_first_post_id' => $this->topic_first_post_id,
            'topic_last_post_id' => $this->topic_last_post_id,
            'topic_last_poster_id' => $this->topic_last_poster_id,
            'topic_last_post_time' => $this->topic_last_post_time,
            'topic_last_view_time' => $this->topic_last_view_time,
            'topic_moved_id' => $this->topic_moved_id,
            'topic_bumped' => $this->topic_bumped,
            'topic_bumper' => $this->topic_bumper,
            'poll_start' => $this->poll_start,
            'poll_length' => $this->poll_length,
            'poll_max_options' => $this->poll_max_options,
            'poll_last_vote' => $this->poll_last_vote,
            'poll_vote_change' => $this->poll_vote_change,
            'topic_visibility' => $this->topic_visibility,
            'topic_delete_time' => $this->topic_delete_time,
            'topic_delete_user' => $this->topic_delete_user,
            'topic_posts_approved' => $this->topic_posts_approved,
            'topic_posts_unapproved' => $this->topic_posts_unapproved,
            'topic_posts_softdeleted' => $this->topic_posts_softdeleted,
        ]);

        $query->andFilterWhere(['like', 'topic_title', $this->topic_title])
            ->andFilterWhere(['like', 'topic_first_poster_name', $this->topic_first_poster_name])
            ->andFilterWhere(['like', 'topic_first_poster_colour', $this->topic_first_poster_colour])
            ->andFilterWhere(['like', 'topic_last_poster_name', $this->topic_last_poster_name])
            ->andFilterWhere(['like', 'topic_last_poster_colour', $this->topic_last_poster_colour])
            ->andFilterWhere(['like', 'topic_last_post_subject', $this->topic_last_post_subject])
            ->andFilterWhere(['like', 'poll_title', $this->poll_title])
            ->andFilterWhere(['like', 'topic_delete_reason', $this->topic_delete_reason]);

        return $dataProvider;
    }
}
