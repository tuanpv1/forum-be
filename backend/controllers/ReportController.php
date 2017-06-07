<?php
/**
 * Created by PhpStorm.
 * User: Hoan
 * Date: 10/26/2015
 * Time: 3:36 PM
 */

namespace backend\controllers;

use common\components\ActionLogTracking;
use common\helpers\CUtils;
use common\models\Category;
use Yii;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class ReportController extends BaseBEController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            [
                'class' => ActionLogTracking::className(),
                'user' => Yii::$app->user,
                'model_type_default' => UserActivity::ACTION_TARGET_TYPE_REPORT,
                'post_action' => [
                    ['action' => 'subscriber-daily', 'accept_ajax' => true],
                    ['action' => 'subscriber-activity', 'accept_ajax' => true],
                    ['action' => 'content', 'accept_ajax' => true],
                    ['action' => 'revenues', 'accept_ajax' => true],
                    ['action' => 'content-profile', 'accept_ajax' => true],
                    ['action' => 'subscriber-number', 'accept_ajax' => true],

                ],
                // 'only' => ['create', 'delete', 'packages']
            ],
        ]);
    }


    
    public function actionReportServiceSubscriber(){
        $param = Yii::$app->request->queryParams;
        $to_date_default = (new DateTime('now'))->setTime(23, 59, 59)->format('d/m/Y');
        $from_date_default = (new DateTime('now'))->setTime(0, 0)->modify('-7 days')->format('d/m/Y');

        $site_id = isset($param['ReportSubscriberServiceForm']['site_id']) ? $param['ReportSubscriberServiceForm']['site_id'] : Yii::$app->params['site_id'];
        $from_date = isset($param['ReportSubscriberServiceForm']['from_date']) ? $param['ReportSubscriberServiceForm']['from_date'] : $from_date_default;
        $to_date = isset($param['ReportSubscriberServiceForm']['to_date']) ? $param['ReportSubscriberServiceForm']['to_date'] : $to_date_default;
        $service_id = isset($param['ReportSubscriberServiceForm']['service_id']) ? $param['ReportSubscriberServiceForm']['service_id'] : null;
        $white_list = isset($param['ReportSubscriberServiceForm']['white_list']) ? $param['ReportSubscriberServiceForm']['white_list'] : null;

        $report = new ReportSubscriberServiceForm();
        $report->site_id = $site_id;
        $report->from_date = $from_date;
        $report->to_date = $to_date;
        $report->service_id = $service_id;
        $report->white_list = $white_list;
        $arrayProvider = $report->generateReport();
        $started = strtotime(DateTime::createFromFormat("d/m/Y", $from_date)->setTime(0, 0)->format('Y-m-d H:i:s'));
        $finished = strtotime(DateTime::createFromFormat("d/m/Y", $to_date)->setTime(0, 0)->format('Y-m-d H:i:s'));
        if ($finished < $started) {
            Yii::$app->session->setFlash('error', Yii::t('app','Ngày kết thúc tìm kiếm không được nhỏ hơn ngày bắt đầu tìm kiếm'));
        }
        return $this->render('report-subscriber-service',[
            'report' => $report,
            'dataProvider' => $arrayProvider[0],
            'dataProviderDetail' => $arrayProvider[1],
            'site_id' => $site_id,
        ]);
    }
} 