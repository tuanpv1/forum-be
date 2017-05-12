<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_user_notifications".
 *
 * @property string $item_type
 * @property string $item_id
 * @property string $user_id
 * @property string $method
 * @property integer $notify
 * @property integer $id
 */
class UserNotifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_user_notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'user_id', 'notify'], 'integer'],
            [['item_type', 'method'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_type' => 'Item Type',
            'item_id' => 'Item ID',
            'user_id' => 'User ID',
            'method' => 'Method',
            'notify' => 'Notify',
            'id' => 'ID',
        ];
    }
}
