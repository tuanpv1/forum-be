<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_rh_topictags".
 *
 * @property string $id
 * @property string $topic_id
 * @property string $tag_id
 */
class TopicTagAsm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_rh_topictags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topic_id' => 'Topic ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
