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
            'number_like_postive' => 'Number Like Postive',
            'number_answer_postive' => 'Number Answer Postive',
            'number_answer_negative' => 'Number Answer Negative',
        ];
    }
}
