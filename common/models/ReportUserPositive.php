<?php

namespace common\models;

use DateTime;
use Yii;

/**
 * This is the model class for table "phpbb_report_user_positive".
 *
 * @property integer $id
 * @property integer $date_report
 * @property integer $total_number_positive
 * @property integer $total_number_negattive
 * @property string $user_positive_id
 * @property string $user_negative_id
 */
class ReportUserPositive extends \yii\db\ActiveRecord
{
    public $from_date;
    public $to_date;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_report_user_positive';
    }

    public static function addNewRecord($beginPreDay, $users_id_positive, $users_id_negative, $total_user_positive, $total_user_negative)
    {
        $model = new ReportUserPositive();
        $model->date_report = $beginPreDay;
        $model->user_positive_id = $users_id_positive;
        $model->user_negative_id = $users_id_negative;
        $model->total_number_negattive = $total_user_negative;
        $model->total_number_positive = $total_user_positive;
        if(!$model->save()){
            Yii::info($model->getErrors());
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
            [['date_report','total_number_positive','total_number_negattive'], 'integer'],
            [['user_positive_id', 'user_negative_id'],'string'],
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
            'user_positive_id' => 'User Positive ID',
            'user_negative_id' => 'User Negative ID',
            'total_number_positive' => 'Tổng số thành viên tích cực trong ngày',
            'total_number_negattive' => 'Tổng số thành viên tiêu cực trong ngày',
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
        $searchModel = new ReportUserPositiveSearch();
        $param['ReportUserPositiveSearch']['from_date'] =$started;
        $param['ReportUserPositiveSearch']['to_date'] =$finished;

        $dataProvider = $searchModel->search($param);

        return $dataProvider;
    }
}
