<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_acl_roles".
 *
 * @property string $role_id
 * @property string $role_name
 * @property string $role_description
 * @property string $role_type
 * @property integer $role_order
 */
class AclRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_acl_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_description'], 'required'],
            [['role_description'], 'string'],
            [['role_order'], 'integer'],
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
            'role_name' => 'Role Name',
            'role_description' => 'Role Description',
            'role_type' => 'Role Type',
            'role_order' => 'Role Order',
        ];
    }
}
