<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_config_system".
 *
 * @property integer $id
 * @property integer $number_like_postive
 * @property integer $number_answer_postive
 * @property integer $number_answer_negative
 */
class ConfigSystem extends \yii\db\ActiveRecord
{
    const ID = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_config_system';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number_like_postive', 'number_answer_postive', 'number_answer_negative'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number_like_postive' => 'Mức like tối thiểu để trở thành viên tích cực',
            'number_answer_postive' => 'Số câu trả lời đúng tối thiểu trờ thành thành viên tích cực',
            'number_answer_negative' => 'Số câu trả lời sai tối đa',
        ];
    }
}
