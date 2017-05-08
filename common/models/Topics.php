<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_topics".
 *
 * @property string $topic_id
 * @property string $forum_id
 * @property string $icon_id
 * @property integer $topic_attachment
 * @property integer $topic_reported
 * @property string $topic_title
 * @property string $topic_poster
 * @property string $topic_time
 * @property string $topic_time_limit
 * @property string $topic_views
 * @property integer $topic_status
 * @property integer $topic_type
 * @property string $topic_first_post_id
 * @property string $topic_first_poster_name
 * @property string $topic_first_poster_colour
 * @property string $topic_last_post_id
 * @property string $topic_last_poster_id
 * @property string $topic_last_poster_name
 * @property string $topic_last_poster_colour
 * @property string $topic_last_post_subject
 * @property string $topic_last_post_time
 * @property string $topic_last_view_time
 * @property string $topic_moved_id
 * @property integer $topic_bumped
 * @property string $topic_bumper
 * @property string $poll_title
 * @property string $poll_start
 * @property string $poll_length
 * @property integer $poll_max_options
 * @property string $poll_last_vote
 * @property integer $poll_vote_change
 * @property integer $topic_visibility
 * @property integer $topic_status_display
 * @property string $topic_delete_time
 * @property string $topic_delete_reason
 * @property string $topic_delete_user
 * @property string $topic_posts_approved
 * @property string $topic_posts_unapproved
 * @property string $topic_posts_softdeleted
 */
class Topics extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_NEW_POST = 1;
    const STATUS_IN_PROCESS = 2;
    const STATUS_ANSWERED = 3;
    const STATUS_UNANSWERED = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_topics';
    }

    public static function getStatus()
    {
        $ls = [
            self::STATUS_INACTIVE => Yii::t('app','Chưa duyệt'),
            self::STATUS_NEW_POST => Yii::t('app','Mới post'),
            self::STATUS_IN_PROCESS => Yii::t('app',"Đang xử lý"),
            self::STATUS_ANSWERED => Yii::t('app',"Đang giải quyết"),
            self::STATUS_UNANSWERED => Yii::t('app',"Chưa trả lời")
        ];
        return $ls;
    }

    public function getStatusName()
    {
        $lst = self::getStatus();
        if (array_key_exists($this->topic_status_display, $lst)) {
            return $lst[$this->topic_status_display];
        }
        return $this->topic_status_display;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forum_id', 'icon_id', 'topic_attachment', 'topic_reported', 'topic_poster', 'topic_time', 'topic_time_limit', 'topic_views', 'topic_status', 'topic_type', 'topic_first_post_id', 'topic_last_post_id', 'topic_last_poster_id', 'topic_last_post_time', 'topic_last_view_time', 'topic_moved_id', 'topic_bumped', 'topic_bumper', 'poll_start', 'poll_length', 'poll_max_options', 'poll_last_vote', 'poll_vote_change', 'topic_visibility', 'topic_delete_time', 'topic_delete_user', 'topic_posts_approved', 'topic_posts_unapproved', 'topic_posts_softdeleted','topic_status_display'], 'integer'],
            [['topic_title', 'topic_first_poster_name', 'topic_last_poster_name', 'topic_last_post_subject', 'poll_title', 'topic_delete_reason'], 'string', 'max' => 255],
            [['topic_first_poster_colour', 'topic_last_poster_colour'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'topic_id' => 'Topic ID',
            'forum_id' => 'Thuộc Danh mục',
            'icon_id' => 'Icon ID',
            'topic_attachment' => 'Topic Attachment',
            'topic_reported' => 'Topic Reported',
            'topic_title' => 'Tên bài viết',
            'topic_poster' => 'Topic Poster',
            'topic_time' => 'Ngày tạo',
            'topic_time_limit' => 'Topic Time Limit',
            'topic_views' => 'Topic Views',
            'topic_status' => 'Topic Status',
            'topic_type' => 'Topic Type',
            'topic_first_post_id' => 'Topic First Post ID',
            'topic_first_poster_name' => 'Topic First Poster Name',
            'topic_first_poster_colour' => 'Topic First Poster Colour',
            'topic_last_post_id' => 'Topic Last Post ID',
            'topic_last_poster_id' => 'Topic Last Poster ID',
            'topic_last_poster_name' => 'Topic Last Poster Name',
            'topic_last_poster_colour' => 'Topic Last Poster Colour',
            'topic_last_post_subject' => 'Topic Last Post Subject',
            'topic_last_post_time' => 'Thời gian post bài',
            'topic_last_view_time' => 'Topic Last View Time',
            'topic_moved_id' => 'Topic Moved ID',
            'topic_bumped' => 'Topic Bumped',
            'topic_bumper' => 'Topic Bumper',
            'poll_title' => 'Poll Title',
            'poll_start' => 'Poll Start',
            'poll_length' => 'Poll Length',
            'poll_max_options' => 'Poll Max Options',
            'poll_last_vote' => 'Poll Last Vote',
            'poll_vote_change' => 'Poll Vote Change',
            'topic_visibility' => 'Topic Visibility',
            'topic_delete_time' => 'Topic Delete Time',
            'topic_delete_reason' => 'Topic Delete Reason',
            'topic_delete_user' => 'Xóa bởi QTV',
            'topic_posts_approved' => 'Topic Posts Approved',
            'topic_posts_unapproved' => 'Topic Posts Unapproved',
            'topic_posts_softdeleted' => 'Topic Posts Softdeleted',
            'topic_status_display' => 'Trạng thái',
        ];
    }

    public function approve($status,$user = null)
    {
        $this->topic_status_display = $status;

        return $this->update(false);
    }
}
