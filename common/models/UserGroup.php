<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_user_group".
 *
 * @property integer $group_id
 * @property integer $user_id
 * @property integer $group_leader
 * @property integer $user_pending
 */
class UserGroup extends \yii\db\ActiveRecord
{
    const NOT_PENDDING = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_user_group';
    }

    public static function createNew($group_id,$user_id)
    {
        $checkExist = UserGroup::findOne(['group_id'=>$group_id,'user_id'=>$user_id]);
        if(isset($checkExist) && !empty($checkExist)){
            return true;
        }else {
            $model = new UserGroup();
            $model->group_id = $group_id;
            $model->user_id = $user_id;
            $model->user_pending = self::NOT_PENDDING;
            if (!$model->save()) {
                Yii::info($model->getErrors());
                return false;
            }
            return true;
        }
    }

    public static function removeGroupUser($old_group, $user_id)
    {
        $model = UserGroup::findOne(['group_id'=>$old_group,'user_id'=>$user_id]);
        if(empty($model)){
            return true;
        }
        if(!$model->delete()){
            Yii::info($model->getErrors());
            return false;
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'user_id', 'group_leader', 'user_pending'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'user_id' => 'User ID',
            'group_leader' => 'Group Leader',
            'user_pending' => 'User Pending',
        ];
    }
}
