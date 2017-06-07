<?php
/**
 * Created by PhpStorm.
 * User: nhocconsanhdieu
 * Date: 26/5/2015
 * Time: 12:03 PM
 */

namespace console\controllers;

use common\helpers\CUtils;
use common\models\Banlist;
use common\models\Campaign;
use common\models\CampaignPromotion;
use common\models\Category;
use common\models\Content;
use common\models\ContentProfile;
use common\models\ContentViewLog;
use common\models\Dealer;
use common\models\Forums;
use common\models\Groups;
use common\models\LikeCommentUser;
use common\models\LogCampaignPromotion;
use common\models\Posts;
use common\models\PostsLikes;
use common\models\ReportCampaign;
use common\models\ReportContent;
use common\models\ReportContentHot;
use common\models\ReportContentProfile;
use common\models\ReportRevenue;
use common\models\ReportSubscriberActivity;
use common\models\ReportSubscriberDaily;
use common\models\ReportSubscriberNumber;
use common\models\ReportSubscriberService;
use common\models\ReportTopics;
use common\models\ReportTopup;
use common\models\ReportUsers;
use common\models\ReportVoucher;
use common\models\Service;
use common\models\Site;
use common\models\Subscriber;
use common\models\SubscriberActivity;
use common\models\SubscriberServiceAsm;
use common\models\SubscriberTransaction;
use common\models\Topics;
use common\models\User;
use common\models\Users;
use DateTime;
use Exception;
use Yii;
use yii\console\Controller;

class ReportController extends Controller
{

    /**
     * Bao cao thue bao goi cuoc
     */
    public function actionReportTopic($start_day = '')
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            print("Bao cao bat dau chay \n");

            if ($start_day != '') {
                $beginPreDay = strtotime(DateTime::createFromFormat("dmY", $start_day)->setTime(0, 0)->format('Y-m-d H:i:s'));
                $endPreDay = strtotime(DateTime::createFromFormat("dmY", $start_day)->setTime(23, 59, 59)->format('Y-m-d H:i:s'));
                $to_day_date = DateTime::createFromFormat("dmY", $start_day)->setTime(0, 0)->format('Y-m-d H:i:s');
            } else {
                $beginPreDay = strtotime("midnight", time());
                $endPreDay = strtotime("tomorrow", $beginPreDay) - 1;
                $to_day_date = (new DateTime('now'))->setTime(0, 0)->format('Y-m-d H:i:s');
            }

            print("Thoi gian bat dau: $beginPreDay : Thoi gian ket thuc: $endPreDay ");
            print("Chuyen sang ngay: $to_day_date \n");

            echo "Deleted report game daily date:" . date("d-m-Y H:i:s", $beginPreDay) . ' timestamp:' . $beginPreDay;
            ReportTopics::deleteAll(['between', 'report_date', $beginPreDay, $endPreDay]);

            $forums = Forums::find()->all();
            if (!$forums) {
                $transaction->rollBack();
                echo 'n****** Lỗi! Không tìm thấy Forums ******';
            }
            /** @var  $forum Forums */
            foreach ($forums as $forum) {
                $forum_id = $forum->forum_id;
                $topics = Topics::find()
                    ->andWhere(['forum_id' => $forum_id])
                    ->all();
                if (!$topics) {
                    break;
                }
                /** @var  $topic Topics */
                foreach ($topics as $topic) {
                    $topic_id = $topic->topic_id;
                    $like_count =PostsLikes::find()
                        ->andWhere(['post_id'=>$topic_id])
                        ->count();
                    $total_post = Posts::find()
                        ->innerJoin('phpbb_topics', 'phpbb_topics.topic_id = phpbb_posts.topic_id')
                        ->andWhere('phpbb_topics.topic_first_post_id <> phpbb_posts.post_id')
                        ->andWhere(['topic_id'=>$topic_id])
                        ->count();
                    $view_count = $topic->topic_views;
                    $rate_count = 0;
                    $rp_topic_add = ReportTopics::addNewRecord($to_day_date,$forum_id,$topic_id,$total_post,$like_count,$view_count,$rate_count);

                    if (!$rp_topic_add) {
                        echo '****** ERROR! Report voucher Daily Fail ******';
                        $transaction->rollBack();
                    }
                }
            }
            $transaction->commit();
            echo '****** Chay bao cao hoan thanh! ******';

        } catch (Exception $e) {
            $transaction->rollBack();
            echo '****** LOI! Chay bao cao khong thanh cong: ' . $e->getMessage() . '******';
        }
    }

    public function actionReportUser($start_day = '')
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            print("Bao cao bat dau chay \n");

            if ($start_day != '') {
                $beginPreDay = strtotime(DateTime::createFromFormat("dmY", $start_day)->setTime(0, 0)->format('Y-m-d H:i:s'));
                $endPreDay = strtotime(DateTime::createFromFormat("dmY", $start_day)->setTime(23, 59, 59)->format('Y-m-d H:i:s'));
                $to_day_date = DateTime::createFromFormat("dmY", $start_day)->setTime(0, 0)->format('Y-m-d H:i:s');
            } else {
                $beginPreDay = strtotime("midnight", time());
                $endPreDay = strtotime("tomorrow", $beginPreDay) - 1;
                $to_day_date = (new DateTime('now'))->setTime(0, 0)->format('Y-m-d H:i:s');
            }

            print("Thoi gian bat dau: $beginPreDay : Thoi gian ket thuc: $endPreDay ");
            print("Chuyen sang ngay: $to_day_date \n");

            echo "Deleted report game daily date:" . date("d-m-Y H:i:s", $beginPreDay) . ' timestamp:' . $beginPreDay;
            ReportUsers::deleteAll(['between', 'report_date', $beginPreDay, $endPreDay]);
            $group = [Groups::GROUP_NEWLY_REGISTEREDLY,Groups::GROUP_REGISTERED];
            $total_user = Users::find()
                ->andWhere(['IN', 'group_id', $group])
                ->andWhere(['user_inactive_reason'=>Users::USER_TYPE_ACTIVE])
                ->count();
            $user_ban = Banlist::find()->andWhere(['between', 'ban_start', $beginPreDay, $endPreDay])->count();
            $user_new = Users::find()
                ->andWhere(['user_inactive_reason'=>Users::USER_TYPE_INACTIVE])
                ->andWhere(['IN', 'group_id', $group])
                ->count();
            $addReportUser = ReportUsers::addNewRecord($beginPreDay,$total_user,$user_ban,$user_new);
            if (!$addReportUser) {
                echo '****** ERROR! Report voucher Daily Fail ******';
                $transaction->rollBack();
            }
            $transaction->commit();
            echo '****** Chay bao cao hoan thanh! ******';

        } catch (Exception $e) {
            $transaction->rollBack();
            echo '****** LOI! Chay bao cao khong thanh cong: ' . $e->getMessage() . '******';
        }
    }

    public function actionReportUserLikeComment($start_day = '')
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            print("Bao cao bat dau chay \n");

            if ($start_day != '') {
                $beginPreDay = strtotime(DateTime::createFromFormat("dmY", $start_day)->setTime(0, 0)->format('Y-m-d H:i:s'));
                $endPreDay = strtotime(DateTime::createFromFormat("dmY", $start_day)->setTime(23, 59, 59)->format('Y-m-d H:i:s'));
                $to_day_date = DateTime::createFromFormat("dmY", $start_day)->setTime(0, 0)->format('Y-m-d H:i:s');
            } else {
                $beginPreDay = strtotime("midnight", time());
                $endPreDay = strtotime("tomorrow", $beginPreDay) - 1;
                $to_day_date = (new DateTime('now'))->setTime(0, 0)->format('Y-m-d H:i:s');
            }

            print("Thoi gian bat dau: $beginPreDay : Thoi gian ket thuc: $endPreDay ");
            print("Chuyen sang ngay: $to_day_date \n");

            echo "Deleted report game daily date:" . date("d-m-Y H:i:s", $beginPreDay) . ' timestamp:' . $beginPreDay;
            LikeCommentUser::deleteAll(['between', 'report_date', $beginPreDay, $endPreDay]);
            $group = [Groups::GROUP_NEWLY_REGISTEREDLY,Groups::GROUP_REGISTERED];
            $users = Users::find()
                ->andWhere(['IN', 'group_id', $group])
                ->andWhere(['user_inactive_reason'=>Users::USER_TYPE_ACTIVE])
                ->all();
            if(!$users){
                $transaction->rollBack();
                echo  '****** LỖI! Khong co User ******';
            }
            foreach ($users as $user){

                $addReportUser = LikeCommentUser::addNewRecord($beginPreDay,$total_user,$user_ban,$user_new);
                if (!$addReportUser) {
                    echo '****** ERROR! Report voucher Daily Fail ******';
                    $transaction->rollBack();
                }
            }
            $transaction->commit();
            echo '****** Chay bao cao hoan thanh! ******';

        } catch (Exception $e) {
            $transaction->rollBack();
            echo '****** LOI! Chay bao cao khong thanh cong: ' . $e->getMessage() . '******';
        }
    }
}
