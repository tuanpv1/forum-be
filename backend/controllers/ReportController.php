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
use common\models\ReportTopics;
use DateTime;
use Yii;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;

class ReportController  extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actionReportTopic(){

        $param = Yii::$app->request->queryParams;
        $to_date_default = (new DateTime('now'))->setTime(23, 59, 59)->format('d/m/Y');
        $from_date_default = (new DateTime('now'))->setTime(0, 0)->modify('-7 days')->format('d/m/Y');

        $from_date = isset($param['ReportSubscriberServiceForm']['from_date']) ? $param['ReportSubscriberServiceForm']['from_date'] : $from_date_default;
        $to_date = isset($param['ReportSubscriberServiceForm']['to_date']) ? $param['ReportSubscriberServiceForm']['to_date'] : $to_date_default;

        $report = new ReportTopics();
        $report->from_date = $from_date;
        $report->to_date = $to_date;
        $arrayProvider = $report->generateReport();
        $started = strtotime(DateTime::createFromFormat("d/m/Y", $from_date)->setTime(0, 0)->format('Y-m-d H:i:s'));
        $finished = strtotime(DateTime::createFromFormat("d/m/Y", $to_date)->setTime(0, 0)->format('Y-m-d H:i:s'));
        if ($finished < $started) {
            Yii::$app->session->setFlash('error', Yii::t('app','Ngày kết thúc tìm kiếm không được nhỏ hơn ngày bắt đầu tìm kiếm'));
        }
        return $this->render('report-topic',[
            'report' => $report,
            'dataProvider' => $arrayProvider,
        ]);
    }
} 