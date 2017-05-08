<?php

use common\helpers\CUtils;
use common\models\Forums;
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
$approveUrl = \yii\helpers\Url::to(['topics/approve']);


$js = <<<JS
    function approveFeedback(status){
    feedbacks = $("#content-feedback-grid").yiiGridView("getSelectedRows");
    if(feedbacks.length <= 0){
    alert("Chưa chọn Topics! Xin vui lòng chọn ít nhất một Topics để duyệt.");
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
                    'id' => 'content-feedback-grid',
                    'responsive' => true,
                    'pjax' => true,
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => 'Danh sách Topics'
                    ],
                    'toolbar' => [
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-ok"></i> Mới Post', [
                                    'type' => 'button',
                                    'title' => 'Mới Post',
                                    'class' => 'btn btn-success',
                                    'onclick' => 'approveFeedback('.Topics::STATUS_NEW_POST.');'
                                ])

                        ],
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-minus"></i>Đang xử lý', [
                                    'type' => 'button',
                                    'title' => 'Đang xử lý',
                                    'class' => 'btn btn-info',
                                    'onclick' => 'approveFeedback('.Topics::STATUS_IN_PROCESS.');'
                                ])

                        ],
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-minus"></i> Đang giải quyết', [
                                    'type' => 'button',
                                    'title' => 'Đang giải quyết',
                                    'class' => 'btn btn-primary',
                                    'onclick' => 'approveFeedback('.Topics::STATUS_ANSWERED.');'
                                ])

                        ],
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-minus"></i> Chưa trả lời', [
                                    'type' => 'button',
                                    'title' => 'Chưa trả lời',
                                    'class' => 'btn btn-danger',
                                    'onclick' => 'approveFeedback('.Topics::STATUS_UNANSWERED.');'
                                ])

                        ],

                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute'=>'topic_title',
                            'value' => function ($model, $key, $index, $widget) {
                                return CUtils::substr($model->topic_title, 50);
                            }
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute'=>'forum_id',
                            'value' => function ($model, $key, $index, $widget) {
                                return CUtils::substr(Forums::findOne(['forum_id'=>$model->forum_id])->forum_name, 50);
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
