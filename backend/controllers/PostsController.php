<?php

namespace backend\controllers;

use common\models\KpiSum;
use common\models\Posts;
use common\models\PostsSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
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
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (isset($_POST['hasEditable'])) {
            // read your posted model attributes
            $post = Yii::$app->request->post();
            if ($post['editableKey']) {
                // read or convert your posted information

            } // else if nothing to do always return an empty JSON encoded output
            else {
                echo \yii\helpers\Json::encode(['output' => '', 'message' => '']);
            }
            return;
        }
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Posts model.
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
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Posts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->post_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->post_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Posts model.
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
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
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
            $feedbacks = Posts::findAll($ids);
            $feedbacksApprove = 0;
            foreach ($feedbacks as $feedback) {
                if ($feedback->approve($status)) {
                    if ($status == Posts::STATUS_ANSWER_WRONG) {
                        $kpi_sum = new KpiSum();
                        $kpi_sum->forum_id = $feedback->forum_id;
                        $kpi_sum->topic_id = $feedback->topic_id;
                        $kpi_sum->user_id = $feedback->poster_id;
                        $kpi_sum->type = KpiSum::TYPE_ANSWER_WRONG;
                        $kpi_sum->status = KpiSum::STATUS_ACTIVE;
                        $kpi_sum->created_at = time();
                        $kpi_sum->updated_at = time();
                        $kpi_sum->post_id = $feedback->post_id;
                        $kpi_sum->save(false);
                    } elseif ($status == Posts::STATUS_ANSWER_RIGHT) {
                        $kpi_sum = KpiSum::find()->andWhere(['forum_id' => $feedback->forum_id, 'topic_id' => $feedback->topic_id, 'post_id' => $feedback->post_id, 'type' => KpiSum::TYPE_ANSWER_WRONG])->one();
                        if ($kpi_sum) {
                            $kpi_sum->delete();
                        }
                    }
                    $feedbacksApprove++;
                }
            }
            return [
                'success' => true,
                'message' => "Duyệt " . $feedbacksApprove . " bình luận thành công!"
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Không tìm thấy bình luận trên hệ thống'
            ];
        }
    }
}
