<?php
/**
 * Created by PhpStorm.
 * User: qhuy
 * Date: 21/05/2015
 * Time: 09:42
 */
namespace common\components;;

use common\models\Groups;
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
         * @var \common\models\Users $user
         */
        $user_check = \common\models\Users::findOne($user->id);
        $group_mod = Groups::findOne(['group_name'=>'GLOBAL_MODERATORS']);
        $group_admin = Groups::findOne(['group_name'=>'ADMINISTRATORS']);
        if($user_check->group_id == $group_mod->group_id){
            return parent::beforeAction($action);
        }elseif($user_check->group_id == $group_admin->group_id){
            return parent::beforeAction($action);
        }else{
            return false;
        }

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
