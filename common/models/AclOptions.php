<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_acl_options".
 *
 * @property string $auth_option_id
 * @property string $auth_option
 * @property string $description
 * @property integer $is_global
 * @property integer $is_local
 * @property integer $founder_only
 *
 * @property AclRolesData[] $aclRolesData
 */
class AclOptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_acl_options';
    }

    public $viewAttr = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_global', 'is_local', 'founder_only'], 'integer'],
            [['description'], 'string'],
            [['auth_option'], 'string', 'max' => 50],
            [['auth_option'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'auth_option_id' => 'Auth Option ID',
            'auth_option' => 'Tên quyền',
            'is_global' => 'Is Global',
            'is_local' => 'Is Local',
            'description' => 'Mô tả',
            'founder_only' => 'Founder Only',
        ];
    }

    public function getAclRolesData()
    {
        return $this->hasMany(AclRolesData::className(), ['auth_option_id' => 'auth_option_id']);
    }
}
