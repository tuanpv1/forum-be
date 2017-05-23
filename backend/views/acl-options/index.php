<?php

use common\helpers\CUtils;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AclOptionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách quyền chi tiết ';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Danh sách quyền chi tiết</span>
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
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'role_name',
                                'format' => 'html',
                                'label' => 'Tên quyền',
                                'value' => function ($model, $key, $index, $widget) {
                                    /** @var $model \common\models\AclOptions */
                                    return $model->auth_option;
                                },
                            ],
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'description',
                                'format' => 'html',
                                'label' => 'Mô tả',
                                'value' => function ($model, $key, $index, $widget) {
                                    /** @var $model \common\models\AclOptions */
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
