<?php

use common\models\Topics;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TopicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Topics';
$this->params['breadcrumbs'][] = $this->title;

\common\assets\ToastAsset::register($this);
\common\assets\ToastAsset::config($this, [
    'positionClass' => \common\assets\ToastAsset::POSITION_TOP_RIGHT
]);
?>


<?php
$approveUrl = \yii\helpers\Url::to(['content-feedback/approve']);
$rejectUrl = \yii\helpers\Url::to(['content-feedback/reject']);


$js = <<<JS
    function approveFeedback(){
    feedbacks = $("#content-feedback-grid").yiiGridView("getSelectedRows");
    if(feedbacks.length <= 0){
    alert("Chưa chọn feedback! Xin vui lòng chọn ít nhất một feedback để duyệt.");
    return;
    }

    jQuery.post(
        '{$approveUrl}',
        { ids:feedbacks }
    )
    .done(function(result) {
    if(result.success){
    toastr.success(result.message);
    jQuery.pjax.reload({container:'#content-feedback-grid'});
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

$js = <<<JS
    function rejectFeedback(){
    feedbacks = $("#content-feedback-grid").yiiGridView("getSelectedRows");
    if(feedbacks.length <= 0){
    alert("Chưa chọn feedback! Xin vui lòng chọn ít nhất một feedback để duyệt.");
    return;
    }

    jQuery.post(
    '{$rejectUrl}',
    { ids:feedbacks }
    )
    .done(function(result) {
    if(result.success){
    toastr.success(result.message);
    jQuery.pjax.reload({container:'#content-feedback-grid'});
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
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => 'Danh sách Topics'
                    ],
                    'toolbar' => [
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-ok"></i> Approve', [
                                    'type' => 'button',
                                    'title' => 'Duyệt feedback',
                                    'class' => 'btn btn-success',
                                    'onclick' => 'approveFeedback();'
                                ])

                        ],
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-minus"></i> Reject', [
                                    'type' => 'button',
                                    'title' => 'Từ chối feedback',
                                    'class' => 'btn btn-danger',
                                    'onclick' => 'rejectFeedback();'
                                ])

                        ],

                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute'=>'topic_title',
                            'value' => function ($model, $key, $index, $widget) {
                                return $model->topic_title;
                            }
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute'=>'forum_id',
                            'value' => function ($model, $key, $index, $widget) {
                                return $model->forum_id;
                            }
                        ],
                        [
                            'attribute' => 'topic_status_display',
                            'class' => '\kartik\grid\DataColumn',
                            'width'=>'200px',
                            'value' => function ($model, $key, $index, $widget) {
                                /**
                                 * @var $model Topics
                                 */
                                return $model->getStatusName();
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => Topics::getStatus(),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Tất cả')],
                        ],
//                        'topic_reported',
                        // 'topic_title',
                        // 'topic_poster',
                        // 'topic_time',
                        // 'topic_time_limit',
                        // 'topic_views',
                        // 'topic_status',
                        // 'topic_type',
                        // 'topic_first_post_id',
                        // 'topic_first_poster_name',
                        // 'topic_first_poster_colour',
                        // 'topic_last_post_id',
                        // 'topic_last_poster_id',
                        // 'topic_last_poster_name',
                        // 'topic_last_poster_colour',
                        // 'topic_last_post_subject',
                        // 'topic_last_post_time',
                        // 'topic_last_view_time',
                        // 'topic_moved_id',
                        // 'topic_bumped',
                        // 'topic_bumper',
                        // 'poll_title',
                        // 'poll_start',
                        // 'poll_length',
                        // 'poll_max_options',
                        // 'poll_last_vote',
                        // 'poll_vote_change',
                        // 'topic_visibility',
                        // 'topic_delete_time',
                        // 'topic_delete_reason',
                        // 'topic_delete_user',
                        // 'topic_posts_approved',
                        // 'topic_posts_unapproved',
                        // 'topic_posts_softdeleted',
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute'=>'topic_last_post_time',
                            'value' => function ($model, $key, $index, $widget) {
                                return date('d/m/Y H:i:s', $model->topic_last_post_time);
                            }
                        ],
                        ['class' => 'yii\grid\ActionColumn'],
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
