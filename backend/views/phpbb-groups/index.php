<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PhpbbGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách nhóm người dùng ';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Danh sách nhóm</span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
<!--                    <p>-->
<!--                        --><?php // echo Html::a("Tạo danh mục ", Yii::$app->urlManager->createUrl(['/category/create']), ['class' => 'btn btn-success']) ?>
<!--                    </p>-->

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id'=>'grid-category-id',
//                    'filterModel' => $searchModel,
                        'responsive' => true,
                        'pjax' => true,
                        'hover' => true,
                        'columns' => [
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'group_id',
                                'label' => 'Tên nhóm',
                                'value'=>function ($model, $key, $index, $widget) {
                                    /** @var $model \common\models\Groups */
                                    return $model->setGroupName($model->group_id);
                                },
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

<?php
