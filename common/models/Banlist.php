<?php

namespace common\models;

use DateTime;
use Yii;

/**
 * This is the model class for table "phpbb_banlist".
 *
 * @property string $ban_id
 * @property string $ban_userid
 * @property string $ban_ip
 * @property string $ban_email
 * @property string $ban_start
 * @property string $ban_end
 * @property integer $ban_exclude
 * @property string $ban_reason
 * @property string $ban_give_reason
 */
class Banlist extends \yii\db\ActiveRecord
{
    const TYPE_USER = 1;
    const TYPE_EMAIL = 2;
    const TYPE_IP = 3;

    public $all_user_id;
    public $select_time;
    public $input_until_time;

    const TIME_30_MINUTES = 1;
    const TIME_ONE_HOURS = 2;
    const TIME_SIX_HOURS = 3;
    const TIME_ONE_DAY = 4;
    const TIME_SEVEN_DAY = 5;
    const TIME_TWO_WEEKS = 6;
    const TIME_ONE_MONTH = 7;
    const TIME_UNTIL = 8;

    const BAN_EXCLUDE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_banlist';
    }

    public static function getToTime($select_time, $input_until_time)
    {
        if($select_time == self::TIME_30_MINUTES){
            return time() + 30*60;
        }
        if($select_time == self::TIME_ONE_HOURS){
            return time() + 60*60;
        }
        if($select_time == self::TIME_SIX_HOURS){
            return time() + 6*60*60;
        }
        if($select_time == self::TIME_ONE_DAY){
            return time() + 24*60*60;
        }
        if($select_time == self::TIME_SEVEN_DAY){
            return time() + 7*24*60*60;
        }
        if($select_time == self::TIME_TWO_WEEKS){
            return time() + 14*24*60*60;
        }
        if($select_time == self::TIME_ONE_MONTH){
            return time() + 30*24*60*60;
        }
        if($select_time == self::TIME_UNTIL && $input_until_time != ''){
            return DateTime::createFromFormat("d/m/Y", $input_until_time)->setTime(0, 0)->format('Y-m-d H:i:s');
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ban_userid', 'ban_start', 'ban_end', 'ban_exclude'], 'integer'],
            [['ban_ip'], 'string', 'max' => 40],
            [['ban_email'], 'string', 'max' => 100],
            [['ban_reason', 'ban_give_reason'], 'string', 'max' => 255],
            [['all_user_id'], 'required','message'=>Yii::t('app','Ban thành viên không được để trống!')],
            [['select_time'], 'required','message'=>Yii::t('app','Thời gian Ban không được để trống!')],
            [['ban_reason'], 'required','message'=>Yii::t('app','Lý do Ban không được để trống!')],
            [['ban_give_reason'], 'required','message'=>Yii::t('app','Lý do Ban gửi cho thành viên không được để trống!')],
            ['all_user_id','safe'],
            ['select_time','safe'],
            ['input_until_time','safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ban_id' => 'Ban ID',
            'all_user_id' => 'Ban User',
            'ban_ip' => 'Ban Ip',
            'ban_email' => 'Ban Email',
            'ban_start' => 'Thời gian bắt đầu',
            'ban_end' => 'Thời gian kết thúc',
            'ban_exclude' => 'Ban Exclude',
            'ban_reason' => 'Lý do Ban',
            'ban_give_reason' => 'Lý do Ban gửi cho thành viên',
            'input_until_time' => 'Chọn Ban đến ngày',
        ];
    }

    public static function selectTimeBan(){
        return [
            self::TIME_30_MINUTES => 'Ba mươi Phút',
            self::TIME_ONE_HOURS => 'Một tiếng',
            self::TIME_SIX_HOURS => 'Sáu tiếng',
            self::TIME_ONE_DAY => 'Một Ngày',
            self::TIME_SEVEN_DAY => 'Bảy tiếng',
            self::TIME_TWO_WEEKS => 'Hai tuần',
            self::TIME_ONE_MONTH => 'Một tháng',
            self::TIME_UNTIL => 'Cho đến khi',
        ];
    }

    public static function addUserToBanList($user_id,$email,$ip,$from_time,$to_time,$reason,$reason_give){
        $model_ban_user = new Banlist();
        $model_ban_user->ban_userid = $user_id;
        $model_ban_user->ban_email = '';
        $model_ban_user->ban_ip = '';
        $model_ban_user->ban_start = $from_time;
        $model_ban_user->ban_end = $to_time;
        $model_ban_user->ban_reason = $reason;
        $model_ban_user->ban_give_reason = $reason_give;
        $model_ban_user->ban_exclude = self::BAN_EXCLUDE;
        if(!$model_ban_user->save(false)){
            Yii::info($model_ban_user->getErrors());
            return false;
        }
        return true;
    }
}
