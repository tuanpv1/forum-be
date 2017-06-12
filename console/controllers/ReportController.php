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
use common\models\ConfigSystem;
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
use common\models\ReportUserPositive;
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

            echo "Xoa bao cao chay truoc do trong ngay:" . date("d-m-Y H:i:s", $beginPreDay) . ' timestamp:' . $beginPreDay;
            ReportTopics::deleteAll(['between', 'date_report', $beginPreDay, $endPreDay]);

            $forums = Forums::find()->select('forum_id')->all();
            if (!$forums) {
                $transaction->rollBack();
                echo '\n****** Lỗi! Không tìm thấy Forums ******';
            }
            /** @var  $forum Forums */
            foreach ($forums as $forum) {
                $forum_id = $forum->forum_id;
                $topics = Topics::find()
                    ->andWhere(['forum_id' => $forum_id])
                    ->all();
                if ($topics) {
                    /** @var  $topic Topics */
                    foreach ($topics as $topic) {
                        $topic_id = $topic->topic_id;
                        $like_count = PostsLikes::find()
                            ->andWhere(['post_id' => $topic_id])
                            ->count();
                        $total_post = Posts::find()
                            ->innerJoin('phpbb_topics', 'phpbb_topics.topic_id = phpbb_posts.topic_id')
                            ->andWhere('phpbb_topics.topic_first_post_id <> phpbb_posts.post_id')
                            ->andWhere(['phpbb_posts.topic_id' => $topic_id])
                            ->count();
                        $view_count = $topic->topic_views;
                        $rate_count = 0;
                        $rp_topic_add = ReportTopics::addNewRecord($beginPreDay, $forum_id, $topic_id, $total_post, $like_count, $view_count, $rate_count);

                        if (!$rp_topic_add) {
                            echo '****** ERROR! Chay bao cao khong thanh cong ******';
                            $transaction->rollBack();
                            die();
                        }
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

            echo "Xoa bao cao chay truoc do trong ngay:" . date("d-m-Y H:i:s", $beginPreDay) . ' timestamp:' . $beginPreDay;
            ReportUsers::deleteAll(['between', 'date_report', $beginPreDay, $endPreDay]);
            $group = [Groups::GROUP_NEWLY_REGISTEREDLY, Groups::GROUP_REGISTERED];
            $total_user = Users::find()
                ->andWhere(['IN', 'group_id', $group])
                ->andWhere(['user_inactive_reason' => Users::USER_TYPE_ACTIVE])
                ->count();
            $user_ban = Banlist::find()->andWhere(['between', 'ban_start', $beginPreDay, $endPreDay])->count();
            $user_new = Users::find()
                ->andWhere(['user_inactive_reason' => Users::USER_TYPE_INACTIVE])
                ->andWhere(['IN', 'group_id', $group])
                ->count();
            $addReportUser = ReportUsers::addNewRecord($beginPreDay, $total_user, $user_ban, $user_new);
            if (!$addReportUser) {
                echo '****** ERROR! Chay bao cao khong thanh cong ******';
                $transaction->rollBack();
                exit();
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

            echo "Xoa bao cao chay truoc do trong ngay:" . date("d-m-Y H:i:s", $beginPreDay) . ' timestamp:' . $beginPreDay;
            LikeCommentUser::deleteAll(['between', 'date_report', $beginPreDay, $endPreDay]);
            $group = [Groups::GROUP_NEWLY_REGISTEREDLY, Groups::GROUP_REGISTERED];
            $users = Users::find()
                ->andWhere(['IN', 'group_id', $group])
                ->andWhere(['user_inactive_reason' => Users::USER_TYPE_ACTIVE])
                ->all();
            if (!$users) {
                $transaction->rollBack();
                echo '****** LỖI! Khong co User ******';
            }
            foreach ($users as $user) {
                /** @var Users $user */
                $user_id = $user->user_id;
                $like_count = PostsLikes::find()
                    ->andWhere(['user_id' => $user_id])
                    ->andWhere(['between', 'timestamp', $beginPreDay, $endPreDay])
                    ->andWhere(['type' => 'post'])
                    ->count();
                $comment_true_count = Posts::find()
                    ->andWhere(['between', 'post_time', $beginPreDay, $endPreDay])
                    ->andWhere(['post_status_display' => Posts::STATUS_ANSWER_RIGHT])
                    ->andWhere(['poster_id' => $user_id])
                    ->count();
                $comment_false_count = Posts::find()
                    ->andWhere(['between', 'post_time', $beginPreDay, $endPreDay])
                    ->andWhere(['post_status_display' => Posts::STATUS_ANSWER_WRONG])
                    ->andWhere(['poster_id' => $user_id])
                    ->count();
                $addReportUser = LikeCommentUser::addNewRecord($beginPreDay, $user_id, $like_count, $comment_true_count, $comment_false_count);
                if (!$addReportUser) {
                    echo '****** ERROR! Chay bao cao khong thanh cong ******';
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

    public function actionReportUserPositive($start_day = '')
    {
        $config_sysyem = ConfigSystem::findOne(ConfigSystem::ID);
        if (!$config_sysyem) {
            print(" LOI! Chua config tham so  \n");
            exit();
        }
        $number_like_positive = $config_sysyem->number_like_postive;
        $number_answer_positve = $config_sysyem->number_answer_postive;
        $number_answer_negative = $config_sysyem->number_answer_negative;
        if (!$number_answer_positve && !$number_like_positive) {
            print(" LOI! Chua config tham so  \n");
            exit();
        }
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

            echo "Xoa bao cao chay truoc do trong ngay:" . date("d-m-Y H:i:s", $beginPreDay) . ' timestamp:' . $beginPreDay;
            ReportUserPositive::deleteAll(['between', 'report_date', $beginPreDay, $endPreDay]);
            $group = [Groups::GROUP_NEWLY_REGISTEREDLY, Groups::GROUP_REGISTERED];
            $users_id_positive = LikeCommentUser::find()
                ->select('user_id')
                ->andWhere(['>=', 'like_count', $number_like_positive])
                ->andWhere(['>=', 'answer_true', $number_answer_positve])
                ->andWhere(['between', 'report_date', $beginPreDay, $endPreDay])
                ->all();
            $users_id_negative = LikeCommentUser::find()
                ->select('user_id')
                ->andWhere(['<=', 'answer_false', $number_answer_negative])
                ->andWhere(['between', 'report_date', $beginPreDay, $endPreDay])
                ->all();
            $addReportUserPositive = ReportUserPositive::addNewRecord($beginPreDay, $users_id_positive, $users_id_negative);
            if (!$addReportUserPositive) {
                echo '****** ERROR! Chay bao cao khong thanh cong ******';
                $transaction->rollBack();
            }
            $transaction->commit();
            echo '****** Chay bao cao hoan thanh! ******';

        } catch (Exception $e) {
            $transaction->rollBack();
            echo '****** LOI! Chay bao cao khong thanh cong: ' . $e->getMessage() . '******';
        }
    }
}
