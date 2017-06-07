<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_report_user".
 *
 * @property integer $id
 * @property integer $date_report
 * @property integer $total_user
 * @property integer $user_ban
 * @property integer $user_register
 */
class ReportUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_report_user';
    }

    public static function addNewRecord($beginPreDay, $total_user, $user_ban, $user_new)
    {
        $model = new ReportUsers();
        $model->date_report = $beginPreDay;
        $model->user_ban = $user_ban;
        $model->total_user = $total_user;
        $model->user_register = $user_new;
        if(!$model->save()){
            $model->getErrors();
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
            [['date_report', 'total_user', 'user_ban', 'user_register'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_report' => 'Date Report',
            'total_user' => 'Total User',
            'user_ban' => 'User Ban',
            'user_register' => 'User Register',
        ];
    }
}
