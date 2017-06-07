<?php

namespace common\models;

use DateTime;
use Yii;

/**
 * This is the model class for table "phpbb_report_topic".
 *
 * @property integer $id
 * @property integer $date_report
 * @property integer $forum_id
 * @property integer $topic_id
 * @property integer $like_count
 * @property integer $total_post
 * @property integer $view_count
 * @property integer $rate_count
 */
class ReportTopics extends \yii\db\ActiveRecord
{
    public $from_date;
    public $to_date;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_report_topic';
    }

    public static function addNewRecord($date_report, $forum_id, $topic_id, $total_post, $like_count, $view_count, $rate_count)
    {
        $model = new ReportTopics();
        $model->date_report = $date_report;
        $model->forum_id=$forum_id;
        $model->topic_id = $topic_id;
        $model->total_post = $total_post;
        $model->like_count = $like_count;
        $model->view_count = $view_count;
        $model->rate_count = $rate_count;
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
            [['date_report', 'forum_id', 'topic_id', 'like_count', 'total_post', 'view_count', 'rate_count'], 'integer'],
            [['from_date', 'to_date'], 'safe'],
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
            'forum_id' => 'Forum ID',
            'topic_id' => 'Topic ID',
            'like_count' => 'Like Count',
            'total_post' => 'Total Post',
            'view_count' => 'View Count',
            'rate_count' => 'Rate Count',
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

        $param = Yii::$app->request->queryParams;
        $searchModel = new ReportTopicsSearch();
        $param['ReportTopicsSearch']['from_date'] =$from_date;
        $param['ReportTopicsSearch']['to_date'] =$to_date;
        $dataProvider = $searchModel->search($param);

        return $dataProvider;
    }
}
