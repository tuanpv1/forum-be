<?php

namespace backend\controllers;

use common\components\ActionAdminFilter;
use common\components\ActionLogTracking;
use common\helpers\CUtils;
use common\models\Forums;
use common\models\Posts;
use common\models\Topics;
use common\models\TopicsSearch;
use kartik\form\ActiveForm;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * TopicsController implements the CRUD actions for Topics model.
 */
class TopicsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => ActionAdminFilter::className(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            [
                'class' => ActionLogTracking::className(),
                'user' => Yii::$app->user,
                'post_action' => [
                    ['action' => 'create', 'accept_ajax' => false],
                    ['action' => 'update', 'accept_ajax' => false],
                    ['action' => 'delete', 'accept_ajax' => true],
                    ['action' => 'approve', 'accept_ajax' => true],
                    ['action' => 'reject', 'accept_ajax' => true],
                ],
                'only' => ['create', 'update', 'delete', 'approve', 'reject']
            ],
        ];
    }

    /**
     * Lists all Topics models.
     * @return mixed
     */
    public function actionIndex()
    {
//        if (isset($_POST['hasEditable'])) {
//            // read your posted model attributes
//            $post = Yii::$app->request->post();
//            if ($post['editableKey']) {
//                // read or convert your posted information
//                $feedback = Topics::findOne($post['editableKey']);
//                $index = $post['editableIndex'];
//
//            } // else if nothing to do always return an empty JSON encoded output
//            else {
//                echo \yii\helpers\Json::encode(['output' => '', 'message' => '']);
//            }
//            return;
//        }
        $searchModel = new TopicsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Topics model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Topics model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Topics();
        $modelPosts = new Posts();
        $model->loadDefaultValues();
        $model->setScenario('adminModify');
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['ajax']) && $model->load($post)) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            $selectedCats = explode(',', $model->list_cat_id);
            if (sizeof($selectedCats) >= 3) {
                Yii::info($model->getErrors());
                \Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Chủ đề không được thuộc nhiều forum'));
                return $this->render('create', [
                    'model' => $model,
                ]);
            } else {
                $i = 0;
                foreach ($selectedCats as $item) {
                    $forum = Forums::findOne(['forum_id' => (int)$item, 'parent_id' => 0]);
                    if (!$forum) {
                        $model->forum_id = $item;
                        $i++;
                    }
                }
                if ($i >= 2) {
                    \Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Chủ đề không được thuộc nhiều forum'));
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
            $model->icon_id = 0;
            $model->topic_attachment = 0;
            $model->topic_reported = 0;
            $model->topic_poster = Yii::$app->user->id;
            $model->topic_time = time();
            $model->topic_time_limit = 0;
            $model->topic_views = 1;
            $model->topic_last_poster_id = Yii::$app->user->id;
            $model->topic_status = 0;
            $model->topic_first_poster_name = Yii::$app->user->getIdentity()->username;
            $model->topic_last_poster_name = Yii::$app->user->getIdentity()->username;
            $model->topic_first_poster_colour = 'AA0000';
            $model->topic_last_poster_colour = 'AA0000';
            $model->topic_last_post_subject = $model->topic_title;
            $model->topic_last_post_time = time();
            $model->topic_last_view_time = time();
            $model->topic_moved_id = 0;
            $model->topic_bumped = 0;
            $model->topic_bumper = 0;
            $model->poll_title = '';
            $model->poll_start = 0;
            $model->poll_length = 0;
            $model->topic_type = 0;
            $model->poll_max_options = 1;
            $model->poll_last_vote = 0;
            $model->poll_vote_change = 0;
            $model->topic_visibility = 1;
            $model->topic_delete_time = 0;
            $model->topic_delete_reason = '';
            $model->topic_delete_user = 0;
            $model->topic_posts_approved = 1;
            $model->topic_posts_unapproved = 0;
            $model->topic_posts_softdeleted = 0;
            $model->topic_first_post_id = '0';
            $model->topic_last_post_id = '0';
            if ($model->save()) {
                if ($modelPosts->createNewPost($model)) {
                } else {
                    Yii::info($model->getErrors());
                    \Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Lưu Chủ đề thất bại'));
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
                // tao log
                \Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Lưu Chủ đề thành công'));
                return $this->redirect(['view', 'id' => $model->topic_id]);
            } else {
                Yii::info($model->getErrors());
                \Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Lưu Chủ đề thất bại'));
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Topics model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('adminModify');
        $model->post_text = Posts::find()->andWhere(['topic_id' => $id])->orderBy(['post_id' => SORT_ASC])->one()->post_text;
        $selectedCats = $model->getListCatIds();
        $model->list_cat_id = $selectedCats[0];
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['ajax']) && $model->load($post)) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            $selectedCats = explode(',', $model->list_cat_id);
            if (sizeof($selectedCats) >= 3) {
                Yii::info($model->getErrors());
                \Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Chủ đề không được thuộc nhiều forum'));
                return $this->render('create', [
                    'model' => $model,
                ]);
            } else {
                $i = 0;
                foreach ($selectedCats as $item) {
                    $forum = Forums::findOne(['forum_id' => (int)$item, 'parent_id' => 0]);
                    if (!$forum) {
                        $model->forum_id = $item;
                        $i++;
                    }
                }
                if ($i >= 2) {
                    \Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Chủ đề không được thuộc nhiều forum'));
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
            $modelPost = Posts::findOne(['topic_id' => $id]);
            /** @var $modelPost Posts */
            $modelPost->post_text = $model->post_text;
            $modelPost->post_subject = $model->topic_title;
            $modelPost->post_checksum = md5($model->post_text);
            $modelPost->forum_id = $model->forum_id;
            $modelPost->poster_ip = CUtils::clientIP();
            $modelPost->save();
            if ($model->save()) {
                $forum = Forums::findOne(['forum_id' => $modelPost->forum_id]);
                /** @var $forum Forums */
                $forum->forum_last_post_id = $modelPost->post_id;
                $forum->forum_last_poster_id = Yii::$app->user->id;
                $forum->forum_last_post_subject = $modelPost->post_subject;
                $forum->forum_last_post_time = time();
                $forum->forum_last_poster_name = Yii::$app->user->getIdentity()->username;
                $forum->save(false);
                Yii::info($model->getErrors());
                return $this->redirect(['view', 'id' => $model->topic_id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'selectedCats' => $selectedCats,
        ]);

    }

    /**
     * Deletes an existing Topics model.
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
     * Finds the Topics model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Topics the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Topics::findOne($id)) !== null) {
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
            $feedbacks = Topics::findAll($ids);
            $feedbacksApprove = 0;
            foreach ($feedbacks as $feedback) {
                if ($feedback->approve($status)) {
                    $feedbacksApprove++;
                }
            }
            return [
                'success' => true,
                'message' => "Duyệt " . $feedbacksApprove . " Chủ đề thành công!"
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Không tìm thấy Chủ đề trên hệ thống'
            ];
        }
    }
}
