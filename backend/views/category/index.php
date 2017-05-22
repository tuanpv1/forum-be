<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý danh mục ';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Quản lý danh mục</span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <p>
                        <?php  echo Html::a("Tạo danh mục ", Yii::$app->urlManager->createUrl(['/category/create']), ['class' => 'btn btn-success']) ?>
                    </p>

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
                                'attribute' => 'path_name',
                                'label' => 'Tên danh mục',
                                'value'=>function ($model, $key, $index, $widget) {
                                    /** @var $model \common\models\Category */
                                    return $model->forum_name;
                                },
                            ],
//                            [
//                                'class' => '\kartik\grid\DataColumn',
//                                'format'=>'raw',
//                                'label'=>'Ảnh đại diện',
//                                'attribute' => 'images',
//                                'value'=>function ($model, $key, $index, $widget) {
//                                    /** @var $model \common\models\Category */
//                                    $cat_image=  Yii::getAlias('@cat_image');
//                                    return $model->images ? Html::img('@web/'.$cat_image.'/'.$model->images, ['alt' => 'Thumbnail','width'=>'50','height'=>'50']) : '';
//                                },
//                            ],
                            [
                                'class' => 'kartik\grid\EditableColumn',
                                'attribute' => 'forum_status_display',
                                'label'=>'Trạng thái',
                                'refreshGrid' => true,
                                'editableOptions' => function ($model, $key, $index) {
                                    return [
                                        'header' => 'Trạng thái',
                                        'size' => 'md',
                                        'displayValueConfig' => $model->listStatus,
                                        'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                                        'data' => $model->listStatus,
                                        'placement' => \kartik\popover\PopoverX::ALIGN_LEFT
                                    ];
                                },
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => [0 => 'Ẩn', 10 => 'Hoạt động',1=>'Khóa'],
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                                'filterInputOptions' => ['placeholder' => 'Tất cả'],
                            ],
                            ['class' => 'kartik\grid\ActionColumn',
                                'template'=>'{view}{update}',
                            ],
//                            [
//                                'class' => 'kartik\grid\ActionColumn',
//                                'buttons'=> [
//                                    'delete' => function ($url, $model) {
//                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', Yii::$app->urlManager->createUrl(['category/delete','id'=>$model->forum_id]), [
//                                            'title' => Yii::t('yii', 'Delete'),
//                                            'data-confirm' => Yii::t('yii', 'Bạn có chắc chắn xóa danh mục này?'),
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                        ]);
//                                    }
//                                ],
//                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

<?php
