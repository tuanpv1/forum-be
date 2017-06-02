<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "phpbb_users".
 *
 * @property string $user_id
 * @property integer $user_type
 * @property string $group_id
 * @property string $user_permissions
 * @property string $user_perm_from
 * @property string $user_ip
 * @property string $user_regdate
 * @property string $username
 * @property string $username_clean
 * @property string $user_password
 * @property string $user_passchg
 * @property string $user_email
 * @property string $user_email_hash
 * @property string $user_birthday
 * @property string $user_lastvisit
 * @property string $user_lastmark
 * @property string $user_lastpost_time
 * @property string $user_lastpage
 * @property string $user_last_confirm_key
 * @property string $user_last_search
 * @property integer $user_warnings
 * @property string $user_last_warning
 * @property integer $user_login_attempts
 * @property integer $user_inactive_reason
 * @property string $user_inactive_time
 * @property string $user_posts
 * @property string $user_lang
 * @property string $user_timezone
 * @property string $user_dateformat
 * @property string $user_style
 * @property string $user_rank
 * @property string $user_colour
 * @property integer $user_new_privmsg
 * @property integer $user_unread_privmsg
 * @property string $user_last_privmsg
 * @property integer $user_message_rules
 * @property integer $user_full_folder
 * @property string $user_emailtime
 * @property string $user_password_yii
 * @property integer $user_topic_show_days
 * @property string $user_topic_sortby_type
 * @property string $user_topic_sortby_dir
 * @property integer $user_post_show_days
 * @property string $user_post_sortby_type
 * @property string $user_post_sortby_dir
 * @property integer $user_notify
 * @property integer $user_notify_pm
 * @property integer $user_notify_type
 * @property integer $user_allow_pm
 * @property integer $user_allow_viewonline
 * @property integer $user_allow_viewemail
 * @property integer $user_allow_massemail
 * @property string $user_options
 * @property string $user_avatar
 * @property string $user_avatar_type
 * @property integer $user_avatar_width
 * @property integer $user_avatar_height
 * @property string $user_sig
 * @property string $user_sig_bbcode_uid
 * @property string $user_sig_bbcode_bitfield
 * @property string $user_jabber
 * @property string $user_actkey
 * @property string $user_newpasswd
 * @property string $user_form_salt
 * @property integer $user_new
 * @property integer $user_reminded
 * @property string $user_reminded_time
 * @property string $auth_key
 */
class Users extends ActiveRecord implements IdentityInterface
{

    const USER_TYPE_ACTIVE = 0;
    const USER_TYPE_INACTIVE = 1;
    const USER_TYPE_DELETED = 2;
    const USER_TYPE_ADMIN = 3;

    const GUESTS = 1;
    const BOTS = 6;

    const STYLE_DEFAULT = 1;
    const ALOW_PM = 1;
    const ALOW_VIEW_ONLINE = 1;
    const ALOW_VIEƯ_EMAIL = 1;
    const USER_OPTIONS = 230271;
    const PRIVMSGS_NO_BOX = -3;
    const NOTIFY_EMAIL = 0;
    const USER_NEW = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_users';
    }

    public static function findIdentity($id)
    {
        return static::findOne(['user_id'=>$id]);
    }

    public function getId()
    {
        return $this->user_id;
    }

    public static function findByUsername($username)
    {
        return Users::findOne(['username_clean' => $username]);
    }

    public static function createAuthKey($username)
    {
        $model = self::findByUsername($username);
        if(empty($model)){
            return false;
        }
        if($model->auth_key = ''){
            $model->auth_key = Yii::$app->security->generateRandomString();
            if(!$model->update(false)){
                Yii::info($model->getErrors());
                return false;
            }
        }
        return true;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public static function getLang(){
        return [
            'vi'=>'Việt Nam',
            'en' =>' English'
        ];
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type', 'group_id', 'user_perm_from', 'user_regdate', 'user_passchg', 'user_email_hash', 'user_lastvisit', 'user_lastmark', 'user_lastpost_time', 'user_last_search', 'user_warnings', 'user_last_warning', 'user_login_attempts', 'user_inactive_reason', 'user_inactive_time', 'user_posts', 'user_style', 'user_rank', 'user_new_privmsg', 'user_unread_privmsg', 'user_last_privmsg', 'user_message_rules', 'user_full_folder', 'user_emailtime', 'user_topic_show_days', 'user_post_show_days', 'user_notify', 'user_notify_pm', 'user_notify_type', 'user_allow_pm', 'user_allow_viewonline', 'user_allow_viewemail', 'user_allow_massemail', 'user_options', 'user_avatar_width', 'user_avatar_height', 'user_new', 'user_reminded', 'user_reminded_time'], 'integer'],
            [['user_permissions', 'user_sig'], 'required'],
            [['user_permissions', 'user_sig' , 'auth_key'], 'string'],
            [['user_ip'], 'string', 'max' => 40],
            [['username', 'username_clean', 'user_password', 'user_avatar', 'user_avatar_type', 'user_sig_bbcode_bitfield', 'user_jabber', 'user_newpasswd'], 'string', 'max' => 255],
            [['user_email', 'user_timezone'], 'string', 'max' => 100],
            [['user_birthday', 'user_last_confirm_key'], 'string', 'max' => 10],
            [['user_lastpage'], 'string', 'max' => 200],
            [['user_lang'], 'string', 'max' => 30],
            [['user_dateformat'], 'string', 'max' => 64],
            [['user_colour'], 'string', 'max' => 6],
            [['user_topic_sortby_type', 'user_topic_sortby_dir', 'user_post_sortby_type', 'user_post_sortby_dir'], 'string', 'max' => 1],
            [['user_sig_bbcode_uid'], 'string', 'max' => 8],
            [['user_actkey', 'user_form_salt'], 'string', 'max' => 32],
            [['username_clean'], 'unique'],
            [['user_email'], 'unique'],
            [['username'], 'required','message'=>Yii::t('app','Tên đăng nhập không được để trống!')],
            [['user_password'], 'required','message'=>Yii::t('app','Mật khẩu không được để trống!')],
            [['user_email'], 'required','message'=>Yii::t('app','Địa chỉ Email không được để trống!')],
            ['user_email', 'email','message'=>Yii::t('app','Địa chỉ Email không hợp lệ!')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_type' => 'Trạng thái',
            'group_id' => 'Thuộc nhóm',
            'user_permissions' => 'Quyền người dùng',
            'user_perm_from' => 'User Perm From',
            'user_ip' => 'Địa chỉ IP người dùng',
            'user_regdate' => 'Ngày đăng kí',
            'username' => 'Tên đăng nhập',
            'username_clean' => 'Tên đăng nhập clean',
            'user_password' => 'Mật khẩu',
            'user_passchg' => 'Thay đổi mật khẩu',
            'user_email' => 'Địa chỉ Email',
            'user_email_hash' => 'User Email Hash',
            'user_birthday' => 'Ngày sinh',
            'user_lastvisit' => 'Lần cuối đăng nhập',
            'user_lastmark' => 'User Lastmark',
            'user_lastpost_time' => 'Bài viết cuối',
            'user_lastpage' => 'Trang truy cập cuối',
            'user_last_confirm_key' => 'User Last Confirm Key',
            'user_last_search' => 'User Last Search',
            'user_warnings' => 'Cảnh báo',
            'user_last_warning' => 'Lần cảnh báo gần nhất',
            'user_login_attempts' => 'User Login Attempts',
            'user_inactive_reason' => 'Trạng thái đăng kí mới',
            'user_inactive_time' => 'Thời điểm đăng kí',
            'user_posts' => 'Số bài viết',
            'user_lang' => 'Ngôn ngữ',
            'user_timezone' => 'Timezone',
            'user_dateformat' => 'Định dạnh ngày',
            'user_style' => 'Sử dụng giao diện',
            'user_rank' => 'User Rank',
            'user_colour' => 'Sử dụng màu sắc',
            'user_new_privmsg' => 'User New Privmsg',
            'user_unread_privmsg' => 'User Unread Privmsg',
            'user_last_privmsg' => 'User Last Privmsg',
            'user_message_rules' => 'User Message Rules',
            'user_full_folder' => 'User Full Folder',
            'user_emailtime' => 'User Emailtime',
            'user_topic_show_days' => 'User Topic Show Days',
            'user_topic_sortby_type' => 'User Topic Sortby Type',
            'user_topic_sortby_dir' => 'User Topic Sortby Dir',
            'user_post_show_days' => 'User Post Show Days',
            'user_post_sortby_type' => 'User Post Sortby Type',
            'user_post_sortby_dir' => 'User Post Sortby Dir',
            'user_notify' => 'Notify',
            'user_notify_pm' => 'Notify Pm',
            'user_notify_type' => 'Notify Type',
            'user_allow_pm' => 'Cho phép nhận tin',
            'user_allow_viewonline' => 'Cho phép thấy online',
            'user_allow_viewemail' => 'Cho phép thấy email',
            'user_allow_massemail' => 'Cho phép gửi email',
            'user_options' => 'User Options',
            'user_avatar' => 'Ảnh đại diện',
            'user_avatar_type' => 'Loại ảnh đại diện',
            'user_avatar_width' => 'Chiều rộng ảnh đại diện',
            'user_avatar_height' => 'Chiều ngang ảnh đại diện',
            'user_sig' => 'User Sig',
            'user_sig_bbcode_uid' => 'User Sig Bbcode Uid',
            'user_sig_bbcode_bitfield' => 'User Sig Bbcode Bitfield',
            'user_jabber' => 'User Jabber',
            'user_actkey' => 'User Actkey',
            'user_newpasswd' => 'Mật khẩu mới',
            'user_form_salt' => 'User Form Salt',
            'user_new' => 'NGười dùng mới',
            'user_reminded' => 'User Reminded',
            'user_reminded_time' => 'User Reminded Time',
        ];
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->user_password);
    }

    public function approve($status)
    {
        if($status != self::USER_TYPE_DELETED){
            $check_activity_users_topics = TopicsPosted::findOne(['user_id'=>$this->user_id]);
            if(!empty($check_activity_users_topics)){
                return false;
            }
            $check_activity_users_post = Posts::findOne(['post_username'=>$this->username]);
            if(!empty($check_activity_users_post)){
                return false;
            }
            $this->user_type = $status;
            return $this->update(false);
        }else{
            if($this->user_inactive_reason == 1){
                $userGroup = UserGroup::findAll(['user_id'=>$this->user_id]);
                Yii::info($userGroup);
                if(!empty($userGroup)){
                    Yii::info($userGroup);
                    foreach($userGroup as $item){
                        if(!$item->delete()){
                            Yii::info($item->getErrors());
                            return false;
                        }
                    }
                }
                if(!$this->delete()){
                    Yii::info($this->getErrors());
                    return false;
                }
                return true;
            }else{
                return false;
            }
        }

    }

    public static function getStatus()
    {
        $ls = [
            self::USER_TYPE_ACTIVE => Yii::t('app','Đã Duyệt'),
            self::USER_TYPE_INACTIVE => Yii::t('app','Chưa Duyệt'),
            self::USER_TYPE_ADMIN => Yii::t('app','Người sáng lập'),
        ];
        return $ls;
    }

    public function getStatusName()
    {
        $lst = self::getStatus();
        if (array_key_exists($this->user_type, $lst)) {
            return $lst[$this->user_type];
        }
        return $this->user_type;
    }

    public static function emailHash($email)
    {
        return sprintf('%u', crc32(strtolower($email))) . strlen($email);
    }

    public static function unique_id()
    {
        return bin2hex(random_bytes(8));
    }

    public static function gen_rand_string($num_chars = 8)
    {
        return substr(strtoupper(base_convert(self::unique_id(), 16, 36)), 0, $num_chars);
    }

    public function setPassword($password)
    {
        $this->user_password = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function getAuthAclUser()
    {
        return new ActiveDataProvider([
            'query' => $this->getAclUser()
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAclUser()
    {
        return
            AclUsers::find()
                ->andWhere(['user_id'=>$this->user_id])
                ->andWhere(['auth_setting'=>AclUsers::AUTH_OPITON_ID]);
    }

    public function getAllOptionUser()
    {
        $roles = AclOptions::find()
            ->andWhere('auth_option_id NOT IN (SELECT auth_option_id FROM phpbb_acl_users where user_id = :id)', [':id' => $this->user_id])
            ->andWhere(['type'=>AclOptions::TYPE_USER]);

        return $roles->all();
    }

    public function getAuthRoleUser()
    {
        return new ActiveDataProvider([
            'query' => $this->getRoleUser()
        ]);
    }

    private function getRoleUser()
    {
        return AclUsers::find()
                ->andWhere(['user_id'=>$this->user_id])
                ->andWhere(['auth_setting'=>AclUsers::AUTH_ROLE_ID]);
    }

    public function getAllRolesUser()
    {
        $roles = AclRoles::find()
            ->andWhere('role_id NOT IN (SELECT auth_role_id FROM phpbb_acl_users where user_id = :id)', [':id' => $this->user_id])
            ->andWhere(['role_type'=>'u_']);

        return $roles->all();
    }
}
