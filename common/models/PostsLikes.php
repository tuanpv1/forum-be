<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_posts_likes".
 *
 * @property string $post_id
 * @property string $user_id
 * @property string $type
 * @property string $timestamp
 */
class PostsLikes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_posts_likes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'user_id'], 'required'],
            [['post_id', 'user_id'], 'integer'],
            [['type'], 'string', 'max' => 16],
            [['timestamp'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'timestamp' => 'Timestamp',
        ];
    }
}
