<?php
/**
 * Created by PhpStorm.
 * User: HungChelsea
 * Date: 15-May-17
 * Time: 3:42 PM
 */

namespace console\controllers;


use common\helpers\FileUtils;
use common\models\Forums;
use common\models\KpiSum;
use common\models\Posts;
use common\models\Topics;
use Yii;
use yii\console\Controller;

class KpiController extends Controller
{

    public function actionRun()
    {
        $this->kpiNotifyTopics();
        $this->kpiAnswerSlowOrNoAnswer();

    }

    public function kpiNotifyTopics()
    {

        $listForum = Forums::find()->andWhere('parent_id <> 0 ')->andWhere(['forum_status' => 0])->all();
        if (empty($listForum)) {
            $this->errorLog(date('Y-m-d h:i:s') . ' SUCCESS! NOT HAVE FORUMS');
            echo(date('Y-m-d h:i:s') . " SUCCESS! NOT HAVE FORUMS\n");
        }
        foreach ($listForum as $forum) {
            /** @var  $forum Forums */
            $countTopics = Topics::find()
                ->andWhere(['forum_id' => $forum->forum_id])
                ->andWhere(['topic_status_display' => Topics::STATUS_INACTIVE])
                ->count();
            if ($countTopics >= 30) {
                $kpi_sum = KpiSum::findOne([
                    'forum_id' => $forum->forum_id,
                    'type' => KpiSum::TYPE_MAX_TOPIC,
                    'status' => KpiSum::STATUS_ACTIVE
                ]);
                if (!$kpi_sum) {
                    $kpi_sum = new KpiSum();
                    $kpi_sum->forum_id = $forum->forum_id;
                    $kpi_sum->created_at = time();
                    $kpi_sum->updated_at = time();
                    $kpi_sum->type = KpiSum::TYPE_MAX_TOPIC;
                    $kpi_sum->status = KpiSum::STATUS_ACTIVE;
                    if (!$kpi_sum->save(false)) {
                        $kpi_sum->getErrors();
                        $this->errorLog(date('Y-m-d h:i:s') . 'ERROR! CANNOT SAVE PLEASE CHECK LOG');
                        echo(date('Y-m-d h:i:s') . " ERROR! CANNOT SAVE PLEASE CHECK LOG\n");
                    }
                }
            } else {
                $kpi_sum = KpiSum::findOne([
                    'forum_id' => $forum->forum_id,
                    'type' => KpiSum::TYPE_MAX_TOPIC,
                    'status' => KpiSum::STATUS_ACTIVE
                ]);
                if ($kpi_sum) {
                    $kpi_sum->status = KpiSum::STATUS_INACTIVE;
                    $kpi_sum->updated_at = time();
                    if (!$kpi_sum->save(false)) {
                        $kpi_sum->getErrors();
                        $this->errorLog(date('Y-m-d h:i:s') . 'ERROR! CANNOT SAVE PLEASE CHECK LOG');
                        echo(date('Y-m-d h:i:s') . " ERROR! CANNOT SAVE PLEASE CHECK LOG\n");
                    }
                }
            }
        }
        $this->errorLog(date('Y-m-d h:i:s') . ' SUCCESS! KPI MAX TOPIC');
        echo(date('Y-m-d h:i:s') . " SUCCESS!  KPI\n");

    }

    public function kpiAnswerSlowOrNoAnswer()
    {
        $listTopics = Topics::find()
            ->andWhere('topic_status_display <> :status', [':status' => Topics::STATUS_INACTIVE])
            ->andWhere('topic_status_display <> :status_', [':status_' => Topics::STATUS_BLOCK])
            ->all();
        if (empty($listTopics)) {
            $this->errorLog(date('Y-m-d h:i:s') . ' SUCCESS! NOT HAVE FORUMS');
            echo(date('Y-m-d h:i:s') . " SUCCESS! NOT HAVE FORUMS\n");
        }
        foreach ($listTopics as $topic) {
            /** @var $topic Topics */

            $posted = Posts::find()
                ->andWhere(['topic_id' => $topic->topic_id])
                ->andWhere('post_id <> :post_id', ['post_id' => $topic->topic_id])
                ->orderBy(['post_id' => SORT_ASC])
                ->one();
            /** @var $posted Posts */

            if (($topic->topic_time == $topic->topic_last_post_time && time() - $topic->topic_time > 30 * 60) || !$posted && time() - $topic->topic_time > 30 * 60 || $posted && $posted->post_time - $topic->topic_time > 30 * 60) {
                $kpi_sum = KpiSum::findOne([
                    'forum_id' => $topic->forum_id,
                    'topic_id' => $topic->topic_id,
                    'type' => KpiSum::TYPE_ANSWER_SLOW,
                    'status' => KpiSum::STATUS_ACTIVE
                ]);
                if (!$kpi_sum) {
                    $kpi_sum = new KpiSum();
                    $kpi_sum->forum_id = $topic->forum_id;
                    $kpi_sum->topic_id = $topic->topic_id;
                    $kpi_sum->user_id = $topic->topic_poster;
                    $kpi_sum->type = KpiSum::TYPE_ANSWER_SLOW;
                    $kpi_sum->status = KpiSum::STATUS_ACTIVE;
                    $kpi_sum->created_at = time();
                    $kpi_sum->updated_at = time();
                    if (!$kpi_sum->save(false)) {
                        $kpi_sum->getErrors();
                        $this->errorLog(date('Y-m-d h:i:s') . 'ERROR! CANNOT SAVE PLEASE CHECK LOG');
                        echo(date('Y-m-d h:i:s') . " ERROR! CANNOT SAVE PLEASE CHECK LOG\n");
                    }
                }
            } else {
                $kpi_sum = KpiSum::findOne(['forum_id' => $topic->forum_id, 'topic_id' => $topic->topic_id, 'type' => KpiSum::TYPE_ANSWER_SLOW]);
                if ($kpi_sum) {
                    $kpi_sum->status = KpiSum::STATUS_INACTIVE;
                    $kpi_sum->updated_at = time();
                    if (!$kpi_sum->save(false)) {
                        $kpi_sum->getErrors();
                        $this->errorLog(date('Y-m-d h:i:s') . 'ERROR! CANNOT SAVE PLEASE CHECK LOG');
                        echo(date('Y-m-d h:i:s') . " ERROR! CANNOT SAVE PLEASE CHECK LOG\n");
                    }
                }
            }

            if (($topic->topic_time == $topic->topic_last_post_time && time() - $topic->topic_time > 2 * 24 * 60 * 60) || !$posted && time() - $topic->topic_time > 2 * 24 * 60 * 60 || $posted && $posted->post_time - $topic->topic_time > 2 * 24 * 60 * 60) {
                $kpi_sum = KpiSum::findOne(['forum_id' => $topic->forum_id, 'topic_id' => $topic->topic_id, 'type' => KpiSum::TYPE_NO_ANSWER, 'status' => KpiSum::STATUS_ACTIVE]);
                if (!$kpi_sum) {
                    $kpi_sum = new KpiSum();
                    $kpi_sum->forum_id = $topic->forum_id;
                    $kpi_sum->topic_id = $topic->topic_id;
                    $kpi_sum->user_id = $topic->topic_poster;
                    $kpi_sum->type = KpiSum::TYPE_NO_ANSWER;
                    $kpi_sum->status = KpiSum::STATUS_ACTIVE;
                    $kpi_sum->created_at = time();
                    $kpi_sum->updated_at = time();
                    if (!$kpi_sum->save(false)) {
                        $kpi_sum->getErrors();
                        $this->errorLog(date('Y-m-d h:i:s') . ' ERROR! CANNOT SAVE PLEASE CHECK LOG');
                        echo(date('Y-m-d h:i:s') . " ERROR! CANNOT SAVE PLEASE CHECK LOG\n");
                    }
                }
            } else {
                $kpi_sum = KpiSum::findOne(['forum_id' => $topic->forum_id, 'topic_id' => $topic->topic_id, 'type' => KpiSum::TYPE_NO_ANSWER]);
                if ($kpi_sum) {
                    $kpi_sum->status = KpiSum::STATUS_INACTIVE;
                    $kpi_sum->updated_at = time();
                    if (!$kpi_sum->save(false)) {
                        $kpi_sum->getErrors();
                        $this->errorLog(date('Y-m-d h:i:s') . ' ERROR! CANNOT SAVE PLEASE CHECK LOG');
                        echo(date('Y-m-d h:i:s') . " ERROR! CANNOT SAVE PLEASE CHECK LOG\n");
                    }
                }
            }
        }
        $this->errorLog(date('Y-m-d h:i:s') . ' SUCCESS! KPI');
        echo(date('Y-m-d h:i:s') . " SUCCESS!  KPI NO ANSWER AND SLOW ANSWER \n");
    }

    public function kpiAnswerWrong()
    {
        $listPost = Posts::find()
            ->innerJoin('phpbb_topics','phpbb_topics.topic_id = phpbb_posts.topic_id')
            ->andWhere('phpbb_topics.topic_first_post_id <> phpbb_posts.post_id')
            ->andWhere(['phpbb_posts.post_status_display' => Posts::STATUS_ANSWER_WRONG])
            ->orderBy(['phpbb_posts.post_time'=>SORT_DESC]);

    }


    public static function errorLog($txt)
    {
        FileUtils::appendToFile(Yii::getAlias('@runtime/logs/error.log'), $txt);
    }
}