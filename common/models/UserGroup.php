<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_user_group".
 *
 * @property integer $group_id
 * @property integer $user_id
 * @property integer $group_leader
 * @property integer $user_pending
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_user_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'user_id', 'group_leader', 'user_pending'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'user_id' => 'User ID',
            'group_leader' => 'Group Leader',
            'user_pending' => 'User Pending',
        ];
    }
}
