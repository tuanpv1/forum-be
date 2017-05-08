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
 * @property string $topic_delete_time
 * @property string $topic_delete_reason
 * @property string $topic_delete_user
 * @property string $topic_posts_approved
 * @property string $topic_posts_unapproved
 * @property string $topic_posts_softdeleted
 */
class Topics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_topics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forum_id', 'icon_id', 'topic_attachment', 'topic_reported', 'topic_poster', 'topic_time', 'topic_time_limit', 'topic_views', 'topic_status', 'topic_type', 'topic_first_post_id', 'topic_last_post_id', 'topic_last_poster_id', 'topic_last_post_time', 'topic_last_view_time', 'topic_moved_id', 'topic_bumped', 'topic_bumper', 'poll_start', 'poll_length', 'poll_max_options', 'poll_last_vote', 'poll_vote_change', 'topic_visibility', 'topic_delete_time', 'topic_delete_user', 'topic_posts_approved', 'topic_posts_unapproved', 'topic_posts_softdeleted'], 'integer'],
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
            'forum_id' => 'Forum ID',
            'icon_id' => 'Icon ID',
            'topic_attachment' => 'Topic Attachment',
            'topic_reported' => 'Topic Reported',
            'topic_title' => 'Topic Title',
            'topic_poster' => 'Topic Poster',
            'topic_time' => 'Topic Time',
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
            'topic_last_post_time' => 'Topic Last Post Time',
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
            'topic_delete_user' => 'Topic Delete User',
            'topic_posts_approved' => 'Topic Posts Approved',
            'topic_posts_unapproved' => 'Topic Posts Unapproved',
            'topic_posts_softdeleted' => 'Topic Posts Softdeleted',
        ];
    }
}
