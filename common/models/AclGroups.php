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

    public $user_arr = array();
    public $listGroup = array();
    public $category;
    public $list_id = [];

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
            [['user_arr','listGroup','category','list_id'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Nhóm người dùng',
            'forum_id' => 'Forum ID',
            'auth_option_id' => 'Auth Option ID',
            'auth_role_id' => 'Nhóm quyền',
            'auth_setting' => 'Auth Setting',
            'user_arr' => 'Thành viên',
            'list_id' => 'Quyền chi tiết',
            'listGroup' => 'Nhóm người dùng'
        ];
    }

    public static function getListGroup()
    {
        $role = Groups::find()->andWhere(['IN','group_id',[Groups::GROUP_ADMINISTRATORS,Groups::GROUP_GLOBAL_MODERATORS,Groups::GROUP_REGISTERED,Groups::GROUP_NEWLY_REGISTEREDLY]])->all();
        $listRole = [];
        $listRole[0] = 'Nhóm người dùng';
        foreach ($role as $item) {
            /** @var $item Groups */
            $listRole[$item->group_id] = $item->setGroupName($item->group_id);
        }
        return $listRole;
    }

    public static function getListRoles()
    {
        $role = AclRoles::findAll(['status'=>AclRoles::STATUS_ACTIVE,'role_type'=>AclRoles::TYPE_FORUM]);
        $listRole = [];
        $listRole[0] = 'Không có quyền truy cập';
        foreach ($role as $item) {
            /** @var $item AclRoles */
            $listRole[$item->role_id] = $item->display_name;
        }
        return $listRole;
    }
}
