<?php

namespace backend\controllers;

use common\models\AclGroups;
use common\models\AclRoles;
use common\models\AclRolesData;
use common\models\AclRolesSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * AclRolesController implements the CRUD actions for AclRoles model.
 */
class AclRolesController extends Controller
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
     * Lists all AclRoles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AclRolesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $role = new AclGroups();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'role' => $role
        ]);
    }

    /**
     * Displays a single AclRoles model.
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
     * Creates a new AclRoles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AclRoles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->role_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AclRoles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->list_id = ArrayHelper::getColumn(AclRolesData::find()
            ->select(['phpbb_acl_options.auth_option_id'])
            ->innerJoin('phpbb_acl_options', 'phpbb_acl_options.auth_option_id = phpbb_acl_roles_data.auth_option_id')
            ->andWhere(['phpbb_acl_roles_data.role_id' => $id])->all(), 'auth_option_id');
        if ($model->load(Yii::$app->request->post())) {
            $aclRoleDataDel = AclRolesData::deleteAll(['role_id' => $id]);
            if (is_array($model->list_id)) {
                foreach ($model->list_id as $value) {
                    $aclRoleData = new AclRolesData();
                    $aclRoleData->role_id = $id;
                    $aclRoleData->auth_option_id = (int)$value;
                    $aclRoleData->auth_setting = 1;
                    $aclRoleData->save();
                }
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->role_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AclRoles model.
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
     * Finds the AclRoles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AclRoles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AclRoles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionIndexCategory()
    {
        $ch = curl_init();

//        curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/phpbb/ucp.php?mode=login");
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS,
//            "username=admin&password=admin123");
//
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
//
//        $server_output = curl_exec($ch);
//
//        curl_close($ch);
//        header('http://localhost:8080/phpbb/ucp.php?mode=login');

        return $this->redirect('http://localhost:8080/phpbb/ucp.php?mode=login');

    }
}
