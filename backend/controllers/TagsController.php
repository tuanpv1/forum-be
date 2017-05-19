<?php

namespace backend\controllers;

use common\models\Tags;
use common\models\TagsSearch;
use kartik\form\ActiveForm;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * TagsController implements the CRUD actions for Tags model.
 */
class TagsController extends Controller
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
     * Lists all Tags models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new TagsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tags model.
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
     * Creates a new Tags model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tags();
        $model->loadDefaultValues();
        $model->setScenario('adminModify');
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['ajax']) && $model->load($post)) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->tag = preg_replace('/\s+/', '-', $model->tag);
            $model->tag_lowercase = strtolower(preg_replace('/\s+/', '-', $model->tag));
            if ($model->save()) {
                \Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Thêm mới tags thành công'));
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::info($model->getErrors());
                \Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Thêm mới tag thất bại'));
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tags model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tags model.
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
     * Finds the Tags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Tags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tags::findOne($id)) !== null) {
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
            $feedbacks = Tags::findAll($ids);
            $feedbacksApprove = 0;
            foreach ($feedbacks as $feedback) {
                if ($feedback->approve($status)) {
                    $feedbacksApprove++;
                }
            }
            return [
                'success' => true,
                'message' => "Duyệt " . $feedbacksApprove . " tags thành công!"
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Không tìm thấy tag trên hệ thống'
            ];
        }
    }

    public function actionUpdateStatus($id)
    {
        $model = Tags::findOne(['id' => $id]);


        if (isset($_POST['hasEditable'])) {
            // read your posted model attributes
            $post = Yii::$app->request->post();
            if ($post['editableKey']) {
                // read or convert your posted information
                $tag = Tags::findOne(['id' => $post['editableKey']]);
                $index = $post['editableIndex'];
                if ($tag || $model->id != $tag->id) {
                    $tag->load($post['Tags'][$index], '');
                    if ($tag->update()) {
                        // tao log

                        echo \yii\helpers\Json::encode(['output' => '', 'message' => '']);
                    } else {
                        // tao log

                        echo \yii\helpers\Json::encode(['output' => '', 'message' => \Yii::t('app', 'Dữ liệu không hợp lệ')]);
                    }
                } else {
                    echo \yii\helpers\Json::encode(['output' => '', 'message' => \Yii::t('app', 'Dữ liệu không tồn tại')]);
                }
            } // else if nothing to do always return an empty JSON encoded output
            else {
                echo \yii\helpers\Json::encode(['output' => '', 'message' => '']);
            }

            return;
        }
    }
}
