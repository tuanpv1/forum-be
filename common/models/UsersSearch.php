<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Users;
use yii\web\User;

/**
 * UsersSearch represents the model behind the search form about `common\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_type', 'group_id', 'user_perm_from', 'user_regdate', 'user_passchg', 'user_email_hash', 'user_lastvisit', 'user_lastmark', 'user_lastpost_time', 'user_last_search', 'user_warnings', 'user_last_warning', 'user_login_attempts', 'user_inactive_reason', 'user_inactive_time', 'user_posts', 'user_style', 'user_rank', 'user_new_privmsg', 'user_unread_privmsg', 'user_last_privmsg', 'user_message_rules', 'user_full_folder', 'user_emailtime', 'user_topic_show_days', 'user_post_show_days', 'user_notify', 'user_notify_pm', 'user_notify_type', 'user_allow_pm', 'user_allow_viewonline', 'user_allow_viewemail', 'user_allow_massemail', 'user_options', 'user_avatar_width', 'user_avatar_height', 'user_new', 'user_reminded', 'user_reminded_time'], 'integer'],
            [['user_permissions', 'user_ip', 'username', 'username_clean', 'user_password', 'user_email', 'user_birthday', 'user_lastpage', 'user_last_confirm_key', 'user_lang', 'user_timezone', 'user_dateformat', 'user_colour', 'user_topic_sortby_type', 'user_topic_sortby_dir', 'user_post_sortby_type', 'user_post_sortby_dir', 'user_avatar', 'user_avatar_type', 'user_sig', 'user_sig_bbcode_uid', 'user_sig_bbcode_bitfield', 'user_jabber', 'user_actkey', 'user_newpasswd', 'user_form_salt', 'user_password_yii', 'auth_key'], 'safe'],
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
        $query = Users::find();
        $query->andWhere('group_id <> :group_other',['group_other'=>Users::BOTS]);
        $query->andWhere('group_id <> :group_GUESTS',['group_GUESTS'=>Users::GUESTS]);
        $query->andWhere('username <> :name_s',['name_s'=>'admin']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['user_type' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'user_type' => $this->user_type,
            'group_id' => $this->group_id,
            'user_perm_from' => $this->user_perm_from,
            'user_regdate' => $this->user_regdate,
            'user_passchg' => $this->user_passchg,
            'user_email_hash' => $this->user_email_hash,
            'user_lastvisit' => $this->user_lastvisit,
            'user_lastmark' => $this->user_lastmark,
            'user_lastpost_time' => $this->user_lastpost_time,
            'user_last_search' => $this->user_last_search,
            'user_warnings' => $this->user_warnings,
            'user_last_warning' => $this->user_last_warning,
            'user_login_attempts' => $this->user_login_attempts,
            'user_inactive_reason' => $this->user_inactive_reason,
            'user_inactive_time' => $this->user_inactive_time,
            'user_posts' => $this->user_posts,
            'user_style' => $this->user_style,
            'user_rank' => $this->user_rank,
            'user_new_privmsg' => $this->user_new_privmsg,
            'user_unread_privmsg' => $this->user_unread_privmsg,
            'user_last_privmsg' => $this->user_last_privmsg,
            'user_message_rules' => $this->user_message_rules,
            'user_full_folder' => $this->user_full_folder,
            'user_emailtime' => $this->user_emailtime,
            'user_topic_show_days' => $this->user_topic_show_days,
            'user_post_show_days' => $this->user_post_show_days,
            'user_notify' => $this->user_notify,
            'user_notify_pm' => $this->user_notify_pm,
            'user_notify_type' => $this->user_notify_type,
            'user_allow_pm' => $this->user_allow_pm,
            'user_allow_viewonline' => $this->user_allow_viewonline,
            'user_allow_viewemail' => $this->user_allow_viewemail,
            'user_allow_massemail' => $this->user_allow_massemail,
            'user_options' => $this->user_options,
            'user_avatar_width' => $this->user_avatar_width,
            'user_avatar_height' => $this->user_avatar_height,
            'user_new' => $this->user_new,
            'user_reminded' => $this->user_reminded,
            'user_reminded_time' => $this->user_reminded_time,
        ]);

        $query->andFilterWhere(['like', 'user_permissions', $this->user_permissions])
            ->andFilterWhere(['like', 'user_ip', $this->user_ip])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'username_clean', $this->username_clean])
            ->andFilterWhere(['like', 'user_password', $this->user_password])
            ->andFilterWhere(['like', 'user_email', $this->user_email])
            ->andFilterWhere(['like', 'user_birthday', $this->user_birthday])
            ->andFilterWhere(['like', 'user_lastpage', $this->user_lastpage])
            ->andFilterWhere(['like', 'user_last_confirm_key', $this->user_last_confirm_key])
            ->andFilterWhere(['like', 'user_lang', $this->user_lang])
            ->andFilterWhere(['like', 'user_timezone', $this->user_timezone])
            ->andFilterWhere(['like', 'user_dateformat', $this->user_dateformat])
            ->andFilterWhere(['like', 'user_colour', $this->user_colour])
            ->andFilterWhere(['like', 'user_topic_sortby_type', $this->user_topic_sortby_type])
            ->andFilterWhere(['like', 'user_topic_sortby_dir', $this->user_topic_sortby_dir])
            ->andFilterWhere(['like', 'user_post_sortby_type', $this->user_post_sortby_type])
            ->andFilterWhere(['like', 'user_post_sortby_dir', $this->user_post_sortby_dir])
            ->andFilterWhere(['like', 'user_avatar', $this->user_avatar])
            ->andFilterWhere(['like', 'user_avatar_type', $this->user_avatar_type])
            ->andFilterWhere(['like', 'user_sig', $this->user_sig])
            ->andFilterWhere(['like', 'user_sig_bbcode_uid', $this->user_sig_bbcode_uid])
            ->andFilterWhere(['like', 'user_sig_bbcode_bitfield', $this->user_sig_bbcode_bitfield])
            ->andFilterWhere(['like', 'user_jabber', $this->user_jabber])
            ->andFilterWhere(['like', 'user_actkey', $this->user_actkey])
            ->andFilterWhere(['like', 'user_newpasswd', $this->user_newpasswd])
            ->andFilterWhere(['like', 'user_form_salt', $this->user_form_salt])
            ->andFilterWhere(['like', 'user_password_yii', $this->user_password_yii])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key]);

        return $dataProvider;
    }
}
