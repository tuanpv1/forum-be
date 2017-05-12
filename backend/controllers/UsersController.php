<?php

namespace backend\controllers;

use common\helpers\Message;
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
        if ($model->load(Yii::$app->request->post())) {
            if($old_type != Users::USER_TYPE_INACTIVE && $model->user_type == Users::USER_TYPE_INACTIVE){
                Yii::$app->session->setFlash('error', Message::MSG_ADD_ERROR_INACTIVE_TO);
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
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

}
