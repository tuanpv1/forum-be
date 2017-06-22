<?php

namespace common\models;

use DateTime;
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
    public $from_date;
    public $to_date;
    public $username;

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
        if (!$model->save()) {
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
            [['user_id', 'like_count', 'answer_true', 'answer_false', 'date_report'], 'integer'],
            [['from_date', 'to_date', 'username'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Tên thành viên',
            'username' => 'Tên thành viên',
            'like_count' => 'Tổng số like',
            'answer_true' => 'Tổng số câu trả lời đúng',
            'answer_false' => 'Tổng số câu trả lời sai',
            'date_report' => 'Ngày',
            'from_date' => 'Từ ngày',
            'to_date' => 'Đến ngày',
        ];
    }

    public function generateReport()
    {
        if ($this->from_date != '' && DateTime::createFromFormat("d/m/Y", $this->from_date)) {
            $from_date = DateTime::createFromFormat("d/m/Y", $this->from_date)->setTime(0, 0)->format('Y-m-d H:i:s');
        } else {
            $from_date = (new DateTime('now'))->setTime(0, 0)->format('Y-m-d H:i:s');
        }

        if ($this->to_date != '' && DateTime::createFromFormat("d/m/Y", $this->to_date)) {
            $to_date = DateTime::createFromFormat("d/m/Y", $this->to_date)->setTime(23, 59, 59)->format('Y-m-d H:i:s');
        } else {
            $to_date = (new DateTime('now'))->setTime(23, 59, 59)->format('Y-m-d H:i:s');
        }

        $started = strtotime($from_date);
        $finished = strtotime($to_date);

        $param = Yii::$app->request->queryParams;
        $searchModel = new LikeCommentUserSearch();
        $param['LikeCommentUserSearch']['from_date'] = $started;
        $param['LikeCommentUserSearch']['to_date'] = $finished;
        $param['LikeCommentUserSearch']['username'] = $this->username;

        $dataProvider = $searchModel->search($param);

        return $dataProvider;
    }
}
