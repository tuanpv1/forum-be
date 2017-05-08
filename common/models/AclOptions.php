<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_acl_options".
 *
 * @property string $auth_option_id
 * @property string $auth_option
 * @property integer $is_global
 * @property integer $is_local
 * @property integer $founder_only
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_global', 'is_local', 'founder_only'], 'integer'],
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
            'auth_option' => 'Auth Option',
            'is_global' => 'Is Global',
            'is_local' => 'Is Local',
            'founder_only' => 'Founder Only',
        ];
    }
}
