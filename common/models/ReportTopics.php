<?php

namespace common\models;

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
        ];
    }
}
