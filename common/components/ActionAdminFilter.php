<?php
/**
 * Created by PhpStorm.
 * User: qhuy
 * Date: 21/05/2015
 * Time: 09:42
 */
namespace common\components;;

use common\models\ConstGeneral;
use common\models\Groups;
use common\models\UserGroup;
use Yii;
use yii\base\ActionFilter;
use yii\di\Instance;
use yii\web\ForbiddenHttpException;
use yii\web\User;

class ActionAdminFilter extends ActionFilter
{

    /**
     * @var User $user
     */
    public $user = 'user';

    /**
     * Initializes the [[rules]] array by instantiating rule objects from configurations.
     */
    public function init()
    {
        parent::init();
        $this->user = Instance::ensure($this->user, User::className());
    }

    public function beforeAction($action)
    {
        $user = $this->user;
        if ($user->getIsGuest()) {
            $this->denyAccess($user);
            return false;
        }

        /**
         * @var \common\models\Users $user_check
         */
        $user_check = Yii::$app->user->identity;
        $check = self::getPermissionUser($user_check);
        if(!$check){
            $this->denyAccess($user);
            return false;
        }

        return parent::beforeAction($action);

    }

    public static function getPermissionUser($user){
        $sql_mod = 'SELECT * FROM phpbb_user_group
                INNER JOIN phpbb_groups WHERE phpbb_groups.group_id = phpbb_user_group.group_id
                AND phpbb_groups.group_name = "'.ConstGeneral::MOD.'" AND phpbb_user_group.user_id = '.$user->id;
        $connection = Yii::$app->getDb();
        $command    = $connection->createCommand($sql_mod);
        $result_mod = $command->queryAll();
        if(!empty($result_mod) && count($result_mod) !=0 ){
            return true;
        }
        $sql_admin = 'SELECT * FROM phpbb_user_group
                INNER JOIN phpbb_groups WHERE phpbb_groups.group_id = phpbb_user_group.group_id
                AND phpbb_groups.group_name = "'.ConstGeneral::ADMIN.'" AND phpbb_user_group.user_id = '.$user->id;
        $connection = Yii::$app->getDb();
        $command    = $connection->createCommand($sql_admin);
        $result_admin = $command->queryAll();
        if(!empty($result_admin) && count($result_admin) !=0 ){
            return true;
        }
        return false;
    }

    /**
     * Denies the access of the user.
     * The default implementation will redirect the user to the login page if he is a guest;
     * if the user is already logged, a 403 HTTP exception will be thrown.
     * @param User $user the current user
     * @throws ForbiddenHttpException if the user is already logged in.
     */
    protected function denyAccess($user)
    {
        if ($user->getIsGuest()) {
            $user->loginRequired();
        } else {
            throw new ForbiddenHttpException(Yii::t('yii', 'Bạn không có quyền truy cập.'));
        }
    }

}
