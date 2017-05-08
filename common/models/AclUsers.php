<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_acl_users".
 *
 * @property string $user_id
 * @property string $forum_id
 * @property string $auth_option_id
 * @property string $auth_role_id
 * @property integer $auth_setting
 */
class AclUsers extends \yii\db\ActiveRecord
{
    const AUTH_ROLE_ID = 0;
    const AUTH_OPITON_ID = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_acl_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'forum_id', 'auth_option_id', 'auth_role_id', 'auth_setting'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'forum_id' => 'Forum ID',
            'auth_option_id' => 'Auth Option ID',
            'auth_role_id' => 'Auth Role ID',
            'auth_setting' => 'Auth Setting',
        ];
    }
}
