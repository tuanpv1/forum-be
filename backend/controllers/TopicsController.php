<?php

namespace backend\controllers;

use common\components\ActionAdminFilter;
use common\components\ActionLogTracking;
use Yii;
use common\models\Topics;
use common\models\TopicsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
        if (isset($_POST['hasEditable'])) {
            // read your posted model attributes
            $post = Yii::$app->request->post();
            if ($post['editableKey']) {
                // read or convert your posted information
                $feedback = Topics::findOne($post['editableKey']);
                $index = $post['editableIndex'];
                if ($feedback) {
                    $feedback->load($post['SubscriberFeedback'][$index], '');
                    if ($feedback->update()) {
                        echo \yii\helpers\Json::encode(['output' => '', 'message' => '']);
                    } else {
                        echo \yii\helpers\Json::encode(['output' => '', 'message' => 'Dữ liệu không hợp lệ']);
                    }
                } else {
                    echo \yii\helpers\Json::encode(['output' => '', 'message' => 'Feedback không tồn tại']);
                }

            } // else if nothing to do always return an empty JSON encoded output
            else {
                echo \yii\helpers\Json::encode(['output' => '', 'message' => '']);
            }
            return;
        }
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->topic_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->topic_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
                'message' => "Duyệt " . $feedbacksApprove . " Topics thành công!"
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Không tìm thấy Topics trên hệ thống'
            ];
        }
    }
}
