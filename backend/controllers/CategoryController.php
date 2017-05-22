<?php

namespace backend\controllers;

use common\models\Category;
use kartik\form\ActiveForm;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (isset($_POST['hasEditable'])) {
            // read your posted model attributes
            $post = Yii::$app->request->post();
            if ($post['editableKey']) {
                // read or convert your posted information
                $cat = Category::findOne($post['editableKey']);
                $index = $post['editableIndex'];
                if ($cat) {
                    $cat->load($post['Category'][$index], '');
                    if ($cat->update()) {
                        echo \yii\helpers\Json::encode(['output' => '', 'message' => '']);
                    } else {
                        echo \yii\helpers\Json::encode(['output' => '', 'message' => 'Dữ liệu không hợp lệ']);
                    }
                } else {
                    echo \yii\helpers\Json::encode(['output' => '', 'message' => 'Danh mục không tồn tại']);
                }
            } // else if nothing to do always return an empty JSON encoded output
            else {
                echo \yii\helpers\Json::encode(['output' => '', 'message' => '']);
            }

            return;
        }

        $categories = Category::getAllCategories(null, true);
        $dataProvider = new ArrayDataProvider([
            'key' => 'forum_id',
            'allModels' => $categories,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $model->setScenario('admin_create_update');
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['ajax']) && $model->load($post)) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->parent_id) {
                $model->forum_topics_per_page = 5;
                $model->forum_type = 1;
                $modelParent = Category::findOne(['forum_id' => (int)$model->parent_id]);
                $updateTable = Category::find()->andWhere('left_id >  :left_id', ['left_id' => (int)$modelParent->right_id])->all();
                foreach ($updateTable as $item) {
                    /** @var $item Category */
                    $item->left_id = (int)$item->left_id + 2;
                    $item->right_id = (int)$item->right_id + 2;
                    $item->update();
                }
                $updateTable = Category::find()->andWhere('left_id <= :left_id', ['left_id' => (int)$modelParent->left_id])
                    ->andWhere('right_id >= :right_id', ['right_id' => (int)$model->left_id])->all();
                foreach ($updateTable as $item) {
                    /** @var $item Category */
                    $item->right_id = (int)$item->right_id + 2;
                    $item->update();
                }
                $right_id = (int)$modelParent->right_id + 1;
                $left_id = (int)$modelParent->right_id;
            } else {
                $model->forum_topics_per_page = 0;
                $model->parent_id = 0;
                $model->forum_type = 0;
                $modelRight = Category::find()->orderBy(['right_id' => SORT_DESC])->one();
                /** @var  $modelRight Category */
                $left_id = (int)$modelRight->right_id + 1;
                $right_id = (int)$modelRight->right_id + 2;
            }
            $model->left_id = $left_id;
            $model->right_id = $right_id;
            $model->forum_desc_options = 7;
            $model->forum_style = 0;
            $model->forum_rules_options = 7;
            $model->forum_status = 0;
            $model->forum_flags = 48;
            $model->enable_indexing = 1;
            $model->display_on_index = 0;
            $model->prune_days = 7;
            $model->prune_viewed = 7;
            $model->prune_freq = 1;
            $model->display_subforum_list = 1;
            $model->prune_shadow_days = 7;
            $model->prune_shadow_freq = 1;
            $model->rh_topictags_enabled = 1;

            $model->save(false);

            Yii::info($model->getErrors());

            \Yii::$app->getSession()->setFlash('success', 'Thêm mới thành công');

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('admin_create_update');
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['ajax']) && $model->load($post)) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->parent_id) {
                $modelParent = Category::findOne(['forum_id' => $model->parent_id]);
                $updateTable = Category::find()->andWhere('left_id >  :left_id', ['left_id' => (int)$modelParent->right_id])->all();
                foreach ($updateTable as $item) {
                    /** @var $item Category */
                    $item->left_id = (int)$item->left_id + 3;
                    $item->right_id = (int)$item->right_id + 3;
                    $item->update();
                }
                $modelParent->right_id = (int)$modelParent->right_id + 3;
                $modelParent->save();
                $model->left_id = (int)$modelParent->right_id - 2;
                $model->right_id = (int)$modelParent->right_id - 1;
            } else {
                $modelRight = Category::find()->orderBy(['right_id' => SORT_DESC])->one();
                /** @var  $modelRight Category */
                $model->left_id = (int)$modelRight->right_id + 1;
                $model->right_id = (int)$modelRight->right_id + 2;
            }
            $model->save(false);
            \Yii::$app->getSession()->setFlash('success', 'Cập nhật thành công');

            return $this->redirect(['index']);
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public
    function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Category::findOne(['forum_id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
