<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_topics_watch".
 *
 * @property string $topic_id
 * @property string $user_id
 * @property integer $notify_status
 */
class TopicsWatch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_topics_watch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_id', 'user_id', 'notify_status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'topic_id' => 'Topic ID',
            'user_id' => 'User ID',
            'notify_status' => 'Notify Status',
        ];
    }
}
