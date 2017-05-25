<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_acl_roles".
 *
 * @property string $role_id
 * @property string $role_name
 * @property string $display_name
 * @property string $role_description
 * @property string $role_type
 * @property integer $role_order
 * @property integer $status
 * @property string $description
 *
 * @property AclRolesData[] $aclRolesData
 */
class AclRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public $list_id;

    public static function tableName()
    {
        return 'phpbb_acl_roles';
    }
    public $viewAttr = [];

    const ROLE_FORUM_READONLY = 17 ; //chi duoc xem danh muc  ap dung cho anonymous
    const ROLE_FORUM_POLLS = 21 ; //cho phep post comment bai viet, su dung bieu tuong trong danh muc ap dung cho nguoi dung la mod va thanh vien chinh thuc
    const ROLE_FORUM_NEW_MEMBER = 24 ; //ap dung cho thanh vien thuong
    const ROLE_FORUM_FULL = 14; // ap dung cho admin

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_description'], 'required'],
            [['list_id','display_name'], 'safe'],
            [['role_description', 'description'], 'string'],
            [['role_order','status','role_id'], 'integer'],
            [['role_name'], 'string', 'max' => 255],
            [['role_type'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'role_name' => 'Tên quyền',
            'role_description' => 'Mô tả chi tiết',
            'role_type' => 'Role Type',
            'role_order' => 'Role Order',
            'description' => 'Mô tả',
            'status' => 'Trạng thái',
            'list_id' => 'Quyền chi tiết',
            'display_name' => 'Tên hiển thị',
        ];
    }

    public function getAclRolesOptionData()
    {
        $texts = '';
        $listData = AclRolesData::find()
            ->andWhere(['role_id' => $this->role_id])
            ->andWhere(['auth_setting' => AclRolesData::STATUS_ACTIVE])
            ->all();
        foreach ($listData as $item) {
            /** @var $item AclRolesData */
            $texts .= $item->aclOptions->description.'<br>';
        }
        return $texts;
    }

    public function getAclRolesData()
    {
        $this->hasMany(AclRolesData::className(), ['role_id' => 'role_id']);
    }
}
