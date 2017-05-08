<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_topics_track".
 *
 * @property string $user_id
 * @property string $topic_id
 * @property string $forum_id
 * @property string $mark_time
 */
class TopicsTrack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_topics_track';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'topic_id'], 'required'],
            [['user_id', 'topic_id', 'forum_id', 'mark_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'topic_id' => 'Topic ID',
            'forum_id' => 'Forum ID',
            'mark_time' => 'Mark Time',
        ];
    }
}
