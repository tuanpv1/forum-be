<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kpi_sum".
 *
 * @property integer $id
 * @property integer $forum_id
 * @property integer $topic_id
 * @property integer $type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $post_id
 * @property integer $rate
 */
class KpiSum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kpi_sum';
    }

    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;

    const TYPE_MAX_TOPIC = 1;
    const TYPE_ANSWER_SLOW = 2;
    const TYPE_ANSWER_WRONG = 3;
    const TYPE_RATE = 4;
    const TYPE_POST_NEGATIVE = 5;
    const TYPE_NO_ANSWER = 6;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forum_id', 'topic_id', 'type', 'status', 'created_at', 'updated_at', 'post_id', 'rate'], 'integer'],
            [['type', 'status'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'forum_id' => 'Forum ID',
            'topic_id' => 'Topic ID',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'post_id' => 'Post ID',
            'rate' => 'Rate',
        ];
    }
}
