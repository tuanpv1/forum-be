<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_like_comment_user".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $date_report
 * @property integer $like_count
 * @property integer $answer_true
 * @property integer $answer_false
 */
class LikeCommentUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_like_comment_user';
    }

    public static function addNewRecord($beginPreDay, $user_id, $like_count, $comment_true_count, $comment_false_count)
    {
        $model = new LikeCommentUser();
        $model->user_id = $user_id;
        $model->date_report = $beginPreDay;
        $model->like_count = $like_count;
        $model->answer_true = $comment_true_count;
        $model->answer_false = $comment_false_count;
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
            [['user_id', 'like_count', 'answer_true', 'answer_false','date_report'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'like_count' => 'Like Count',
            'answer_true' => 'Answer True',
            'answer_false' => 'Answer False',
            'date_report' => 'date_report',
        ];
    }
}
