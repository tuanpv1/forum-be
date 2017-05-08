<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_topics_posted".
 *
 * @property string $user_id
 * @property string $topic_id
 * @property integer $topic_posted
 */
class TopicsPosted extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_topics_posted';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'topic_id'], 'required'],
            [['user_id', 'topic_id', 'topic_posted'], 'integer'],
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
            'topic_posted' => 'Topic Posted',
        ];
    }
}
