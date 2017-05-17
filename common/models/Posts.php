<?php

namespace common\models;

use common\helpers\CommonUtils;
use common\helpers\CUtils;
use Yii;

/**
 * This is the model class for table "phpbb_posts".
 *
 * @property string $post_id
 * @property string $topic_id
 * @property string $forum_id
 * @property string $poster_id
 * @property string $icon_id
 * @property string $poster_ip
 * @property string $post_time
 * @property integer $post_reported
 * @property integer $enable_bbcode
 * @property integer $enable_smilies
 * @property integer $enable_magic_url
 * @property integer $enable_sig
 * @property string $post_username
 * @property string $post_subject
 * @property string $post_text
 * @property string $post_checksum
 * @property integer $post_attachment
 * @property string $bbcode_bitfield
 * @property string $bbcode_uid
 * @property integer $post_postcount
 * @property string $post_edit_time
 * @property string $post_edit_reason
 * @property string $post_edit_user
 * @property integer $post_edit_count
 * @property integer $post_edit_locked
 * @property integer $post_status_display
 * @property integer $post_visibility
 * @property string $post_delete_time
 * @property string $post_delete_reason
 * @property string $post_delete_user
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_posts';
    }

    const STATUS_POST_VISIBILITY = 1;
    const STATUS_POST_INVISIBILITY = 0;

    const STATUS_ANSWER_WRONG = 1;
    const STATUS_ANSWER_RIGHT = 2;
    const STATUS_ANSWER_NEGATIVE = 3;
    const STATUS_ANSWER_APPROVE = 0;


    public static function getStatus()
    {
        $ls = [
            self::STATUS_POST_VISIBILITY => Yii::t('app', 'Hiển thị'),
            self::STATUS_POST_INVISIBILITY => Yii::t('app', 'Ẩn'),

        ];
        return $ls;
    }

    public function getStatusName()
    {
        $lst = self::getStatus();
        if (array_key_exists($this->post_visibility, $lst)) {
            return $lst[$this->post_visibility];
        }
        return $this->post_visibility;
    }

    public static function getStatusAnswer()
    {
        $ls = [
            self::STATUS_ANSWER_RIGHT => Yii::t('app', 'Trả lời đúng'),
            self::STATUS_ANSWER_WRONG => Yii::t('app', 'Trả lời sai'),
            self::STATUS_ANSWER_APPROVE => Yii::t('app', 'Chưa duyệt'),
            self::STATUS_ANSWER_NEGATIVE => Yii::t('app', 'Nội dung tiêu cực'),

        ];
        return $ls;
    }

    public function getStatusAnswerName()
    {
        $lst = self::getStatusAnswer();
        if (array_key_exists($this->post_status_display, $lst)) {
            return $lst[$this->post_status_display];
        }
        return $this->post_status_display;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_id', 'forum_id', 'poster_id', 'icon_id', 'post_time', 'post_reported', 'enable_bbcode', 'enable_smilies', 'enable_magic_url', 'enable_sig', 'post_attachment', 'post_postcount', 'post_edit_time', 'post_edit_user', 'post_edit_count', 'post_edit_locked', 'post_visibility', 'post_delete_time', 'post_delete_user','post_status_display'], 'integer'],
            [['post_text'], 'required'],
            [['post_text'], 'string'],
            [['poster_ip'], 'string', 'max' => 40],
            [['post_username', 'post_subject', 'bbcode_bitfield', 'post_edit_reason', 'post_delete_reason'], 'string', 'max' => 255],
            [['post_checksum'], 'string', 'max' => 32],
            [['bbcode_uid'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'topic_id' => 'Topic ID',
            'forum_id' => 'Forum ID',
            'poster_id' => 'Người bình luận',
            'icon_id' => 'Icon ID',
            'poster_ip' => 'Poster Ip',
            'post_time' => 'Thời gian bình luận',
            'post_reported' => 'Post Reported',
            'enable_bbcode' => 'Enable Bbcode',
            'enable_smilies' => 'Enable Smilies',
            'enable_magic_url' => 'Enable Magic Url',
            'enable_sig' => 'Enable Sig',
            'post_username' => 'Post Username',
            'post_subject' => 'Chủ đề bình luận',
            'post_text' => 'Nội dung bình luận',
            'post_checksum' => 'Post Checksum',
            'post_attachment' => 'Post Attachment',
            'bbcode_bitfield' => 'Bbcode Bitfield',
            'bbcode_uid' => 'Bbcode Uid',
            'post_postcount' => 'Post Postcount',
            'post_edit_time' => 'Post Edit Time',
            'post_edit_reason' => 'Post Edit Reason',
            'post_edit_user' => 'Post Edit User',
            'post_edit_count' => 'Post Edit Count',
            'post_edit_locked' => 'Post Edit Locked',
            'post_visibility' => 'Trạng thái hiển thị',
            'post_delete_time' => 'Post Delete Time',
            'post_delete_reason' => 'Post Delete Reason',
            'post_delete_user' => 'Post Delete User',
            'post_status_display' => 'Đánh giá',
        ];
    }

    public function createNewPost($modelTopics)
    {
        /** @var  $modelTopics Topics */
        $model = new Posts();
        $model->topic_id = $modelTopics->topic_id;
        $model->forum_id = $modelTopics->forum_id;
        $model->poster_id = Yii::$app->user->id;
        $model->icon_id = 0;
        $model->poster_ip = CUtils::clientIP();
        $model->post_time = time();
        $model->post_reported = 0;
        $model->enable_bbcode = 0;
        $model->enable_smilies = 1;
        $model->enable_magic_url = 1;
        $model->enable_sig = 1;
        $model->post_username = '';
        $model->post_subject = $modelTopics->topic_title;
        $model->post_text = $modelTopics->post_text;
        $model->post_attachment = 0;
        $model->post_checksum = md5($modelTopics->post_text);
        $model->bbcode_bitfield = '';
        $model->bbcode_uid = CommonUtils::parse_message();
        $model->post_edit_time = 0;
        $model->post_edit_reason = '';
        $model->post_edit_user = 0;
        $model->post_edit_count = 0;
        $model->post_edit_locked = 0;
        $model->post_visibility = 1;
        $model->post_delete_time = 0;
        $model->post_delete_reason = '';
        $model->post_delete_user = 0;
        if (!$model->save()) {
            $forum = Forums::findOne(['forum_id' => $modelTopics->forum_id]);
            /** @var $forum Forums */
            $forum->forum_last_post_id = $model->post_id;
            $forum->forum_last_poster_id = Yii::$app->user->id;
            $forum->forum_last_post_subject = $model->post_subject;
            $forum->forum_last_post_time = time();
            $forum->forum_last_poster_name = Yii::$app->user->getIdentity()->username;
            $forum->save();
            Yii::info($model->getErrors());
            return false;
        }
        $modelTopics->topic_first_post_id = $model->post_id;
        $modelTopics->topic_last_post_id = $model->post_id;
        $modelTopics->save();
        return $model;
    }

    public function approve($status)
    {
        $this->post_status_display = $status;

        return $this->update(false);
    }
}
