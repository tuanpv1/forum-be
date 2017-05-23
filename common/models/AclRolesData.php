<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_acl_roles_data".
 *
 * @property string $role_id
 * @property string $auth_option_id
 * @property integer $auth_setting
 *
 * @property AclOptions $aclOptions
 * @property AclRoles[] $aclRoles
 */
class AclRolesData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_acl_roles_data';
    }

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'auth_option_id'], 'required'],
            [['role_id', 'auth_option_id', 'auth_setting'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'auth_option_id' => 'Auth Option ID',
            'auth_setting' => 'Auth Setting',
        ];
    }

    public function getAclOptions()
    {
        return $this->hasOne(AclOptions::className(), ['auth_option_id' => 'auth_option_id']);
    }

    public function getAclRoles()
    {
        return $this->hasMany(AclRoles::className(), ['role_id' => 'role_id']);
    }
}
