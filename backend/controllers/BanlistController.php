<?php

namespace backend\controllers;

use common\components\ActionAdmin;
use common\helpers\Message;
use Yii;
use common\models\Banlist;
use common\models\BanlistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BanlistController implements the CRUD actions for Banlist model.
 */
class BanlistController extends Controller
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
     * Lists all Banlist models.
     * @return mixed
     */
    public function actionIndex($type)
    {
        $searchModel = new BanlistSearch();
        $param = Yii::$app->request->queryParams;
        $param['BanlistSearch']['type'] = $type;
        $dataProvider = $searchModel->search($param);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'type'=>$type
        ]);
    }

    /**
     * Displays a single Banlist model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id,$type)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'type'=>$type
        ]);
    }

    /**
     * Creates a new Banlist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type)
    {
        $model = new Banlist();

        if ($model->load(Yii::$app->request->post())) {
            if(isset($model->select_time)){
                $result_time = Banlist::getToTime($model->select_time,$model->input_until_time);
                if($result_time == false){
                    Yii::$app->session->setFlash('error', Message::MSG_MISSING_DATE);
                    return $this->render('create', [
                        'model' => $model,
                        'type' => $type
                    ]);
                }else{
                    $model->ban_start = time();
                    $model->ban_end = $result_time;
                }
            }
            if(empty($model->all_user_id)){
                Yii::$app->session->setFlash('error', Message::MSG_MISSING_DATE);
                return $this->render('create', [
                    'model' => $model,
                    'type' => $type
                ]);
            }
            foreach($model->all_user_id as $item){
                $add_ban = Banlist::addUserToBanList($item,null,null,$model->ban_start,$model->ban_end,$model->ban_reason,$model->ban_give_reason);
                if(!$add_ban){
                    Yii::$app->session->setFlash('error', Message::MSG_ADD_ERROR);
                    return $this->render('create', [
                        'model' => $model,
                        'type' => $type
                    ]);
                }else{
                    Yii::$app->session->setFlash('success', Message::MSG_ADD_SUCCESS);
                    return $this->redirect(['view', 'ban_id' => $model->ban_id]);
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'type' => $type
            ]);
        }
    }

    /**
     * Updates an existing Banlist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ban_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Banlist model.
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
     * Finds the Banlist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Banlist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banlist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
