<?php

use common\helpers\CUtils;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AclRolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách quyền của nhóm ';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Danh sách nhóm quyền</span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'grid-category-id',
//                    'filterModel' => $searchModel,
                        'responsive' => true,
                        'pjax' => true,
                        'hover' => true,
                        'columns' => [
                            [
                                'class'=>'kartik\grid\ExpandRowColumn',
                                'width'=>'50px',
                                'value'=>function ($model, $key, $index, $column) {
                                    return GridView::ROW_COLLAPSED;
                                },
                                'detail'=>function ($model, $key, $index, $column) {
                                    return Yii::$app->controller->renderPartial('_expand-activity-detail', ['model'=>$model]);
                                },
                                'headerOptions'=>['class'=>'kartik-sheet-style'] ,
                                'expandOneOnly'=>true
                            ],
                            [
                                'attribute'=>'role_id'
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'role_name',
                                'format' => 'html',
                                'label' => 'Tên quyền',
                                'value' => function ($model, $key, $index, $widget) {
                                    /** @var $model \common\models\AclRoles */
                                    return $model->role_name;
                                },
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'description',
                                'format' => 'html',
                                'label' => 'Mô tả',
                                'value' => function ($model, $key, $index, $widget) {
                                    /** @var $model \common\models\AclRoles */
                                    return $model->description;
                                },
                            ],
                            ['class' => 'kartik\grid\ActionColumn',
                                'template'=>'{view}{update}',
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

<?php
