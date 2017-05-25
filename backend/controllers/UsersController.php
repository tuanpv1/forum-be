<?php

namespace backend\controllers;

use common\components\ActionAdmin;
use common\helpers\Message;
use common\models\AclOptions;
use common\models\AclRoles;
use common\models\AclUsers;
use common\models\Groups;
use common\models\UserGroup;
use common\models\UserNotifications;
use Yii;
use common\models\Users;
use common\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\User;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => ActionAdmin::className(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'active'=>1
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->user_password);
            $model->generateAuthKey();
            $model->username_clean = trim(strtolower($model->username));
            $model->user_reminded_time = time();
            $model->user_passchg = time();
            $model->user_timezone = 'Asia/Ho_Chi_Minh';
            $model->user_dateformat = 'D M d, Y g:i a';
            $model->user_style = Users::STYLE_DEFAULT;
            $model->user_full_folder = Users::PRIVMSGS_NO_BOX;
            $model->user_notify_type = Users::NOTIFY_EMAIL;
            $model->user_allow_pm = Users::NOTIFY_EMAIL;
            $model->user_permissions = '';
            if($model->user_type == Users::USER_TYPE_INACTIVE){
                $model->user_inactive_reason = Users::USER_TYPE_INACTIVE;
                $model->user_inactive_time = time();
                $model->user_actkey = Users::gen_rand_string(mt_rand(6,10));
            }elseif($model->user_type == Users::USER_TYPE_ACTIVE){
                $model->user_actkey = '';
                $model->user_inactive_reason = Users::USER_TYPE_ACTIVE;
                $model->user_inactive_time = 0;
            }
            $model->user_style = Users::STYLE_DEFAULT;
            $model->user_email_hash = Users::emailHash($model->user_email);
            $model->user_options = Users::USER_OPTIONS;
            $model->user_new = Users::USER_NEW;
            if(!$model->save(false)){
                Yii::$app->session->setFlash('error', Message::MSG_ADD_ERROR);
                Yii::info($model->getErrors());
                return $this->render('create', [
                    'model' => $model,
                ]);
            }else{
                $creatUserGroupAsm = UserGroup::createNew($model->group_id,$model->user_id);
                if($creatUserGroupAsm){
                    Yii::$app->session->setFlash('success', Message::MSG_ADD_SUCCESS);
                    return $this->redirect(['view', 'id' => $model->user_id]);
                }
                if($model->user_type == Users::USER_TYPE_INACTIVE){
                    $notifyUserTopic = UserNotifications::createNewRecord($model->user_id,'notification.method.email','notification.type.topic');
                    $notifyUserPost = UserNotifications::createNewRecord($model->user_id,'notification.method.email','notification.type.post');
                    if(!$notifyUserPost || !$notifyUserTopic){
                        Yii::$app->session->setFlash('error', Message::MSG_ADD_ERROR);
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_type = $model->user_type;
        $old_group = $model->group_id;
        $old_pass = $model->user_password;
        if ($model->load(Yii::$app->request->post())) {
            if($old_type != Users::USER_TYPE_INACTIVE && $model->user_type == Users::USER_TYPE_INACTIVE){
                Yii::$app->session->setFlash('error', Message::MSG_ADD_ERROR_INACTIVE_TO);
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            if(isset($model->user_password) && $model->user_password != $old_pass){
                $model->setPassword($model->user_password);
                $model->generateAuthKey();
            }else{
                $model->user_password = $old_pass;
            }
            $model->username_clean = trim(strtolower($model->username));
            $model->user_reminded_time = time();
            $model->user_passchg = time();
            $model->user_timezone = 'Asia/Ho_Chi_Minh';
            $model->user_dateformat = 'D M d, Y g:i a';
            $model->user_style = Users::STYLE_DEFAULT;
            $model->user_full_folder = Users::PRIVMSGS_NO_BOX;
            $model->user_notify_type = Users::NOTIFY_EMAIL;
            $model->user_allow_pm = Users::NOTIFY_EMAIL;
            $model->user_permissions = '';
            if($model->user_type == Users::USER_TYPE_INACTIVE){
                $model->user_inactive_reason = Users::USER_TYPE_INACTIVE;
                $model->user_inactive_time = time();
                $model->user_actkey = Users::gen_rand_string(mt_rand(6,10));
            }elseif($model->user_type == Users::USER_TYPE_ACTIVE){
                $model->user_actkey = '';
                $model->user_inactive_reason = Users::USER_TYPE_ACTIVE;
                $model->user_inactive_time = 0;
            }
            $model->user_style = Users::STYLE_DEFAULT;
            $model->user_email_hash = Users::emailHash($model->user_email);
            $model->user_options = Users::USER_OPTIONS;
            $model->user_new = Users::USER_NEW;
            if(!$model->save(false)){
                Yii::$app->session->setFlash('error', Message::MSG_ADD_ERROR);
                Yii::info($model->getErrors());
                return $this->render('create', [
                    'model' => $model,
                ]);
            }else{
                if($old_group == Groups::GROUP_GLOBAL_MODERATORS && $model->group_id != Groups::GROUP_GLOBAL_MODERATORS){
                    $removeUserGroup = UserGroup::removeGroupUser($old_group,$model->user_id);
                    if(!$removeUserGroup){
                        Yii::$app->session->setFlash('error', Message::MSG_ADD_ERROR);
                        return $this->render('create', ['model' => $model]);
                    }
                }
                $creatUserGroupAsm = UserGroup::createNew($model->group_id,$model->user_id);
                if($creatUserGroupAsm){
                    Yii::$app->session->setFlash('success', Message::MSG_UPDATE_SUCCESS);
                    return $this->redirect(['view', 'id' => $model->user_id]);
                }
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionApprove()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        if (isset($post['ids'])) {
            $ids = $post['ids'];
            $status = $post['status'];
            if($status != Users::USER_TYPE_INACTIVE && $status == Users::USER_TYPE_DELETED ){
                return [
                    'success' => false,
                    'message' => 'Không được xóa user đang hoạt động, Vui lòng cho vào Banlist'
                ];
            }
            $users = Users::findAll($ids);
            $userApprove = 0;
            foreach ($users as $user) {
                if ($user->approve($status)) {
                    $userApprove++;
                }
            }
            return [
                'success' => true,
                'message' => $status==Users::USER_TYPE_DELETED?"Xóa ". $userApprove . " Users thành công!":"Duyệt " . $userApprove . " Users thành công!"
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Không tìm thấy Users trên hệ thống'
            ];
        }
    }

    // TuanPV

    public function actionAddAclUser($id){
    /* @var $model Users */
    $model = Users::findOne(['user_id' => $id]);

    Yii::$app->response->format = Response::FORMAT_JSON;

    $success = false;
    $message = Yii::t('app','Users/Quyền không tồn tại');

    if ($model) {
        $post = Yii::$app->request->post();

        if (isset($post['addItems'])) {
            $items = $post['addItems'];

            $count = 0;

            foreach ($items as $item) {
                $role = AclOptions::findOne(['auth_option_id' => $item]);
                $mapping = new AclUsers();
                $mapping->auth_option_id = $item;
                $mapping->user_id = $id;
                if ($mapping->save()) {
                    $count ++;
                }
            }


            if ($count >0) {
                $success = true;
                $message = Yii::t('app','Đã thêm ').$count.Yii::t('app',' quyền cho người dùng ').$model->username;

            }
        }
    }

    return [
        'success' => $success,
        'message' => $message
    ];
}

    //TuanPV
    public function actionRevokeOptionItem()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();

        $success = false;
        $message = Yii::t('app','Tham số không đúng');

        if (isset($post['users']) && isset($post['item'])) {
            $user = $post['users'];
            $item = $post['item'];

            $mapping = AclUsers::find()->andWhere(['user_id' => $user, 'auth_option_id' => $item])->one();
            if ($mapping) {
                if ($mapping->delete()) {
                    $success = true;
                    $message = Yii::t('app','Đã xóa quyền ').$item.Yii::t('app','khỏi user ').$user.'!';
                } else {
                    $message = Yii::t('app','Lỗi hệ thống, vui lòng thử lại sau');
                }
            } else {
                $message = Yii::t('app','Quyền').$item.Yii::t('app','chưa được cấp cho user').$user.'!';
            }

        }

        return [
            'success' => $success,
            'message' => $message
        ];
    }

    public function actionAddRoleUser($id){
        /* @var $model Users */
        $model = Users::findOne(['user_id' => $id]);

        Yii::$app->response->format = Response::FORMAT_JSON;

        $success = false;
        $message = Yii::t('app','Users/Nhóm quyền không tồn tại');

        if ($model) {
            $post = Yii::$app->request->post();

            if (isset($post['addItems'])) {
                $items = $post['addItems'];

                $count = 0;

                foreach ($items as $item) {
                    $role = AclRoles::findOne(['role_id' => $item]);
                    $mapping = new AclUsers();
                    $mapping->auth_role_id = $item;
                    $mapping->user_id = $id;
                    if ($mapping->save()) {
                        $count ++;
                    }
                }


                if ($count >0) {
                    $success = true;
                    $message = Yii::t('app','Đã thêm ').$count.Yii::t('app',' nhóm quyền cho người dùng ').$model->username;

                }
            }
        }

        return [
            'success' => $success,
            'message' => $message
        ];
    }

    //TuanPV
    public function actionRevokeRoleItem()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();

        $success = false;
        $message = Yii::t('app','Tham số không đúng');

        if (isset($post['users']) && isset($post['item'])) {
            $user = $post['users'];
            $item = $post['item'];

            $mapping = AclUsers::find()->andWhere(['user_id' => $user, 'auth_role_id' => $item])->one();
            if ($mapping) {
                if ($mapping->delete()) {
                    $success = true;
                    $message = Yii::t('app','Đã xóa quyền ').$item.Yii::t('app','khỏi user ').$user.'!';
                } else {
                    $message = Yii::t('app','Lỗi hệ thống, vui lòng thử lại sau');
                }
            } else {
                $message = Yii::t('app','Quyền').$item.Yii::t('app','chưa được cấp cho user').$user.'!';
            }

        }

        return [
            'success' => $success,
            'message' => $message
        ];
    }

}
