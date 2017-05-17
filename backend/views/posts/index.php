<?php

use common\helpers\CUtils;
use common\models\Posts;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TopicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bình luận';
$this->params['breadcrumbs'][] = '/ ' . $this->title;

\common\assets\ToastAsset::register($this);
\common\assets\ToastAsset::config($this, [
    'positionClass' => \common\assets\ToastAsset::POSITION_TOP_RIGHT
]);
?>


<?php
$approveUrl = \yii\helpers\Url::to(['posts/approve']);


$js = <<<JS
    function approveTopics(status){
    feedbacks = $("#posts-index-grid").yiiGridView("getSelectedRows");
    if(feedbacks.length <= 0){
    alert("Chưa chọn chủ đề! Xin vui lòng chọn ít nhất một chủ đề để duyệt.");
    return;
    }

    jQuery.post(
        '{$approveUrl}',
        {
            ids:feedbacks,
            status:status
            }
    )
    .done(function(result) {
    if(result.success){
    toastr.success(result.message);
    jQuery.pjax.reload({container:'#posts-index-grid'});
    }else{
    toastr.error(result.message);
    }
    })
    .fail(function() {
    toastr.error("server error");
    });
    }
JS;


$this->registerJs($js, \yii\web\View::POS_END);
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span
                        class="caption-subject font-green-sharp bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'id' => 'posts-index-grid',
                    'responsive' => true,
                    'pjax' => true,
                    'hover' => true,
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => 'Danh sách bình luận'
                    ],
                    'toolbar' => [
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-ok"></i> Trả lời sai', [
                                    'type' => 'button',
                                    'title' => 'Trả lời sai',
                                    'class' => 'btn btn-danger',
                                    'onclick' => 'approveTopics(' . Posts::STATUS_ANSWER_WRONG . ');'
                                ])

                        ],
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-ok"></i> Trả lời đúng', [
                                    'type' => 'button',
                                    'title' => 'Trả lời đúng',
                                    'class' => 'btn btn-success',
                                    'onclick' => 'approveTopics(' . Posts::STATUS_ANSWER_RIGHT . ');'
                                ])

                        ],
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-ok"></i> Nội dung tiêu cực', [
                                    'type' => 'button',
                                    'title' => 'Nội dung tiêu cực',
                                    'class' => 'btn btn-danger',
                                    'onclick' => 'approveTopics(' . Posts::STATUS_ANSWER_NEGATIVE . ');'
                                ])

                        ],

                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'post_subject',
                            'value' => function ($model, $key, $index, $widget) {
                                return CUtils::substr($model->post_subject, 50);
                            }
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'post_text',
                            'format' => 'html',
                            'value' => function ($model, $key, $index, $widget) {
                                return CUtils::substr($model->post_text, 50);
                            }
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'poster_id',
                            'format' => 'html',
                            'value' => function ($model, $key, $index, $widget) {
                                return \common\models\Users::findOne(['user_id'=>$model->poster_id])->username;
                            }
                        ],
                        [
                            'attribute' => 'post_visibility',
                            'class' => '\kartik\grid\DataColumn',
                            'width' => '200px',
                            'value' => function ($model, $key, $index, $widget) {
                                /**
                                 * @var $model Posts
                                 */
                                return $model->getStatusName();
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => Posts::getStatus(),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Tất cả')],
                        ],
                        [
                            'attribute' => 'post_status_display',
                            'class' => '\kartik\grid\DataColumn',
                            'width' => '200px',
                            'value' => function ($model, $key, $index, $widget) {
                                /**
                                 * @var $model Posts
                                 */
                                return $model->getStatusAnswerName();
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => Posts::getStatusAnswer(),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Tất cả')],
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'post_time',
                            'value' => function ($model, $key, $index, $widget) {
                                return date('d/m/Y H:i:s', $model->post_time);
                            }
                        ],
                        ['class' => 'kartik\grid\ActionColumn',
                            'template' => '{view}',
                        ],
                        [
                            'class' => 'kartik\grid\CheckboxColumn',
                            'headerOptions' => ['class' => 'kartik-sheet-style'],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
