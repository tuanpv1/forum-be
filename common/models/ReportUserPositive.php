<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_report_user_positive".
 *
 * @property integer $id
 * @property integer $date_report
 * @property integer $user_positive_id
 * @property integer $user_negative_id
 */
class ReportUserPositive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_report_user_positive';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_report', 'user_positive_id', 'user_negative_id'], 'integer'],
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
            'user_positive_id' => 'User Positive ID',
            'user_negative_id' => 'User Negative ID',
        ];
    }
}
