<?php

namespace common\models;

use DateTime;
use Yii;

/**
 * This is the model class for table "phpbb_report_user".
 *
 * @property integer $id
 * @property integer $date_report
 * @property integer $total_user
 * @property integer $user_ban
 * @property integer $user_register
 */
class ReportUsers extends \yii\db\ActiveRecord
{
    public $from_date;
    public $to_date;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_report_user';
    }

    public static function addNewRecord($beginPreDay, $total_user, $user_ban, $user_new)
    {
        $model = new ReportUsers();
        $model->date_report = $beginPreDay;
        $model->user_ban = $user_ban;
        $model->total_user = $total_user;
        $model->user_register = $user_new;
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
            [['date_report', 'total_user', 'user_ban', 'user_register'], 'integer'],
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
            'date_report' => 'Ngày',
            'total_user' => 'Tổng số thành viên',
            'user_ban' => 'Thành viên bị ban',
            'user_register' => 'Thành viên đăng ký mới',
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
        $searchModel = new ReportUsersSearch();
        $param['ReportUsersSearch']['from_date'] =$started;
        $param['ReportUsersSearch']['to_date'] =$finished;

        $dataProvider = $searchModel->search($param);

        return $dataProvider;
    }
}
