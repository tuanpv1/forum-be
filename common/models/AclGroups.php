<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_acl_groups".
 *
 * @property string $group_id
 * @property string $forum_id
 * @property string $auth_option_id
 * @property string $auth_role_id
 * @property integer $auth_setting
 */
class AclGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_acl_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'forum_id', 'auth_option_id', 'auth_role_id', 'auth_setting'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'forum_id' => 'Forum ID',
            'auth_option_id' => 'Auth Option ID',
            'auth_role_id' => 'Auth Role ID',
            'auth_setting' => 'Auth Setting',
        ];
    }
}
