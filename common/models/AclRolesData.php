<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

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

    public static function getRoleOptionId($role_id)
    {
        $aclRole = AclRoles::findOne(['role_id' => $role_id]);

        if (strpos($aclRole->role_name, 'ROLE_FORUM_') !== false) {
            $type = AclOptions::TYPE_FORUM;
        } elseif (strpos($aclRole->role_name, 'ROLE_MOD_') !== false) {
            $type = AclOptions::TYPE_MODE;
        }elseif(strpos($aclRole->role_name,'ROLE_USER_') !== false){
            $type = AclOptions::TYPE_USER;
        }else{
            $type = AclOptions::TYPE_ADMIN;
        }
        $aclRoleData = AclOptions::find()
            ->select(['phpbb_acl_options.auth_option_id as id', 'phpbb_acl_options.description as name'])
            ->andWhere(['type'=>$type])->asArray()->all();
        return ArrayHelper::map($aclRoleData, 'id', 'name');
    }
}
