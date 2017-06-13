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
use common\models\ReportUserPositive;
use common\models\ReportUsers;
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

        $from_date = isset($param['ReportTopics']['from_date']) ? $param['ReportTopics']['from_date'] : $from_date_default;
        $to_date = isset($param['ReportTopics']['to_date']) ? $param['ReportTopics']['to_date'] : $to_date_default;
        $forum_id = isset($param['ReportTopics']['forum_id']) ? $param['ReportTopics']['forum_id'] : '';

        $started = strtotime(DateTime::createFromFormat("d/m/Y", $from_date)->setTime(0, 0)->format('Y-m-d H:i:s'));
        $finished = strtotime(DateTime::createFromFormat("d/m/Y", $to_date)->setTime(0, 0)->format('Y-m-d H:i:s'));

        if ($finished < $started) {
            Yii::$app->session->setFlash('error', Yii::t('app','Ngày kết thúc tìm kiếm không được nhỏ hơn ngày bắt đầu tìm kiếm'));
        }
        $report = new ReportTopics();
        $report->from_date = $from_date;
        $report->to_date = $to_date;
        $report->forum_id = $forum_id;
        $arrayProvider = $report->generateReport();

        return $this->render('report-topic',[
            'report' => $report,
            'dataProvider' => $arrayProvider,
        ]);
    }

    public function actionReportUser(){

        $param = Yii::$app->request->queryParams;
        $to_date_default = (new DateTime('now'))->setTime(23, 59, 59)->format('d/m/Y');
        $from_date_default = (new DateTime('now'))->setTime(0, 0)->modify('-7 days')->format('d/m/Y');

        $from_date = isset($param['ReportUsers']['from_date']) ? $param['ReportUsers']['from_date'] : $from_date_default;
        $to_date = isset($param['ReportUsers']['to_date']) ? $param['ReportUsers']['to_date'] : $to_date_default;

        $started = strtotime(DateTime::createFromFormat("d/m/Y", $from_date)->setTime(0, 0)->format('Y-m-d H:i:s'));
        $finished = strtotime(DateTime::createFromFormat("d/m/Y", $to_date)->setTime(0, 0)->format('Y-m-d H:i:s'));

        if ($finished < $started) {
            Yii::$app->session->setFlash('error', Yii::t('app','Ngày kết thúc tìm kiếm không được nhỏ hơn ngày bắt đầu tìm kiếm'));
        }
        $report = new ReportUsers();
        $report->from_date = $from_date;
        $report->to_date = $to_date;
        $arrayProvider = $report->generateReport();

        return $this->render('report-users',[
            'report' => $report,
            'dataProvider' => $arrayProvider,
        ]);
    }

    public function actionReportUserPositive(){
        $param = Yii::$app->request->queryParams;
        $to_date_default = (new DateTime('now'))->setTime(23, 59, 59)->format('d/m/Y');
        $from_date_default = (new DateTime('now'))->setTime(0, 0)->modify('-7 days')->format('d/m/Y');

        $from_date = isset($param['ReportUserPositive']['from_date']) ? $param['ReportUserPositive']['from_date'] : $from_date_default;
        $to_date = isset($param['ReportUserPositive']['to_date']) ? $param['ReportUserPositive']['to_date'] : $to_date_default;

        $started = strtotime(DateTime::createFromFormat("d/m/Y", $from_date)->setTime(0, 0)->format('Y-m-d H:i:s'));
        $finished = strtotime(DateTime::createFromFormat("d/m/Y", $to_date)->setTime(0, 0)->format('Y-m-d H:i:s'));

        if ($finished < $started) {
            Yii::$app->session->setFlash('error', Yii::t('app','Ngày kết thúc tìm kiếm không được nhỏ hơn ngày bắt đầu tìm kiếm'));
        }
        $report = new ReportUserPositive();
        $report->from_date = $from_date;
        $report->to_date = $to_date;
        $arrayProvider = $report->generateReport();

        return $this->render('report-user-positive',[
            'report' => $report,
            'dataProvider' => $arrayProvider,
        ]);
    }
} 