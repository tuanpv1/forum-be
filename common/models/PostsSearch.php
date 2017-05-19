<?php

namespace common\models;

use DateTime;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Posts;

/**
 * PostsSearch represents the model behind the search form about `common\models\Posts`.
 */
class PostsSearch extends Posts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'topic_id', 'forum_id', 'poster_id', 'icon_id', 'post_reported', 'enable_bbcode', 'enable_smilies', 'enable_magic_url', 'enable_sig', 'post_attachment', 'post_postcount', 'post_edit_time', 'post_edit_user', 'post_edit_count', 'post_edit_locked', 'post_visibility', 'post_delete_time', 'post_delete_user','post_status_display'], 'integer'],
            [['poster_ip', 'post_username', 'post_subject', 'post_text', 'post_checksum', 'bbcode_bitfield', 'bbcode_uid', 'post_edit_reason', 'post_delete_reason','post_time'], 'safe'],
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
        $user_id = Yii::$app->user->identity->getId();
        $forums = AclUsers::find()->select('forum_id')->distinct()->andWhere(['user_id' => $user_id])->all();
        $array_forum_id = [];
        if ($forums) {
            foreach ($forums as $item) {
                /** @var AclUsers $item */
                if ((int)$item->forum_id) {
                    array_push($array_forum_id, (int)$item->forum_id);
                }
            }
        }

        $query = Posts::find()->innerJoin('phpbb_topics','phpbb_topics.topic_id = phpbb_posts.topic_id')
        ->andWhere('phpbb_topics.topic_first_post_id <> phpbb_posts.post_id');

        if (!in_array(ConstGeneral::ADMIN_ID, ConstGeneral::checkPermissionUserGroup($user_id))) {
            if (is_array($array_forum_id) && $array_forum_id != null) {
                $query->andWhere(['IN', 'phpbb_topics.forum_id', $array_forum_id]);
            } else {
                $query->andWhere(['phpbb_topics.forum_id' => -1]);
            }
        }

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
            'phpbb_posts.post_id' => $this->post_id,
            'phpbb_posts.topic_id' => $this->topic_id,
            'phpbb_posts.forum_id' => $this->forum_id,
            'phpbb_posts.poster_id' => $this->poster_id,
            'phpbb_posts.icon_id' => $this->icon_id,
//            'phpbb_posts.post_time' => $this->post_time,
            'phpbb_posts.post_reported' => $this->post_reported,
            'phpbb_posts.enable_bbcode' => $this->enable_bbcode,
            'phpbb_posts.post_visibility' => $this->post_visibility,
            'phpbb_posts.post_status_display' => $this->post_status_display,
        ]);

        $query->andFilterWhere(['like', 'post_username', $this->post_username])
            ->andFilterWhere(['like', 'post_subject', $this->post_subject])
            ->andFilterWhere(['like', 'post_text', $this->post_text]);
        if($this->post_time){
            $created_at_defaut = DateTime::createFromFormat("d/m/Y", $this->post_time)->setTime(0, 0)->format('Y-m-d H:i:s');
            $query->andFilterWhere(['>=', 'phpbb_posts.post_time', strtotime($created_at_defaut)]);
            $query->andFilterWhere(['<=', 'phpbb_posts.post_time', strtotime($created_at_defaut) + 86400]);// mỗi ngày cách nhau 86400
        }
        $query->orderBy(['topic_id'=>SORT_DESC]);
        return $dataProvider;
    }
}
