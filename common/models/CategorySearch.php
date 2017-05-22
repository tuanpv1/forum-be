<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;

/**
 * CategorySearch represents the model behind the search form about `common\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forum_id', 'parent_id', 'left_id', 'right_id', 'forum_desc_options', 'forum_style', 'forum_rules_options', 'forum_topics_per_page', 'forum_type', 'forum_status', 'forum_last_post_id', 'forum_last_poster_id', 'forum_last_post_time', 'forum_flags', 'display_on_index', 'enable_indexing', 'enable_icons', 'enable_prune', 'prune_next', 'prune_days', 'prune_viewed', 'prune_freq', 'display_subforum_list', 'forum_options', 'forum_posts_approved', 'forum_posts_unapproved', 'forum_posts_softdeleted', 'forum_topics_approved', 'forum_topics_unapproved', 'forum_topics_softdeleted', 'enable_shadow_prune', 'prune_shadow_days', 'prune_shadow_freq', 'prune_shadow_next', 'rh_topictags_enabled'], 'integer'],
            [['forum_parents', 'forum_name', 'forum_desc', 'forum_desc_bitfield', 'forum_desc_uid', 'forum_link', 'forum_password', 'forum_image', 'forum_rules', 'forum_rules_link', 'forum_rules_bitfield', 'forum_rules_uid', 'forum_last_post_subject', 'forum_last_poster_name', 'forum_last_poster_colour'], 'safe'],
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
        $query = Category::find();

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
            'forum_id' => $this->forum_id,
            'parent_id' => $this->parent_id,
            'left_id' => $this->left_id,
            'right_id' => $this->right_id,
            'forum_desc_options' => $this->forum_desc_options,
            'forum_style' => $this->forum_style,
            'forum_rules_options' => $this->forum_rules_options,
            'forum_topics_per_page' => $this->forum_topics_per_page,
            'forum_type' => $this->forum_type,
            'forum_status' => $this->forum_status,
            'forum_last_post_id' => $this->forum_last_post_id,
            'forum_last_poster_id' => $this->forum_last_poster_id,
            'forum_last_post_time' => $this->forum_last_post_time,
            'forum_flags' => $this->forum_flags,
            'display_on_index' => $this->display_on_index,
            'enable_indexing' => $this->enable_indexing,
            'enable_icons' => $this->enable_icons,
            'enable_prune' => $this->enable_prune,
            'prune_next' => $this->prune_next,
            'prune_days' => $this->prune_days,
            'prune_viewed' => $this->prune_viewed,
            'prune_freq' => $this->prune_freq,
            'display_subforum_list' => $this->display_subforum_list,
            'forum_options' => $this->forum_options,
            'forum_posts_approved' => $this->forum_posts_approved,
            'forum_posts_unapproved' => $this->forum_posts_unapproved,
            'forum_posts_softdeleted' => $this->forum_posts_softdeleted,
            'forum_topics_approved' => $this->forum_topics_approved,
            'forum_topics_unapproved' => $this->forum_topics_unapproved,
            'forum_topics_softdeleted' => $this->forum_topics_softdeleted,
            'enable_shadow_prune' => $this->enable_shadow_prune,
            'prune_shadow_days' => $this->prune_shadow_days,
            'prune_shadow_freq' => $this->prune_shadow_freq,
            'prune_shadow_next' => $this->prune_shadow_next,
            'rh_topictags_enabled' => $this->rh_topictags_enabled,
        ]);

        $query->andFilterWhere(['like', 'forum_parents', $this->forum_parents])
            ->andFilterWhere(['like', 'forum_name', $this->forum_name])
            ->andFilterWhere(['like', 'forum_desc', $this->forum_desc])
            ->andFilterWhere(['like', 'forum_desc_bitfield', $this->forum_desc_bitfield])
            ->andFilterWhere(['like', 'forum_desc_uid', $this->forum_desc_uid])
            ->andFilterWhere(['like', 'forum_link', $this->forum_link])
            ->andFilterWhere(['like', 'forum_password', $this->forum_password])
            ->andFilterWhere(['like', 'forum_image', $this->forum_image])
            ->andFilterWhere(['like', 'forum_rules', $this->forum_rules])
            ->andFilterWhere(['like', 'forum_rules_link', $this->forum_rules_link])
            ->andFilterWhere(['like', 'forum_rules_bitfield', $this->forum_rules_bitfield])
            ->andFilterWhere(['like', 'forum_rules_uid', $this->forum_rules_uid])
            ->andFilterWhere(['like', 'forum_last_post_subject', $this->forum_last_post_subject])
            ->andFilterWhere(['like', 'forum_last_poster_name', $this->forum_last_poster_name])
            ->andFilterWhere(['like', 'forum_last_poster_colour', $this->forum_last_poster_colour]);

        return $dataProvider;
    }
}
