<?php

use common\helpers\CUtils;
use common\models\Forums;
use common\models\Topics;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TopicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chủ đề';
$this->params['breadcrumbs'][] = '/ '.$this->title;

\common\assets\ToastAsset::register($this);
\common\assets\ToastAsset::config($this, [
    'positionClass' => \common\assets\ToastAsset::POSITION_TOP_RIGHT
]);
?>


<?php
$approveUrl = \yii\helpers\Url::to(['topics/approve']);


$js = <<<JS
    function approveTopics(status){
    feedbacks = $("#topic-index-grid").yiiGridView("getSelectedRows");
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
    jQuery.pjax.reload({container:'#topic-index-grid'});
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
                <p>
                    <?php  echo Html::a("Tạo chủ đề ", Yii::$app->urlManager->createUrl(['/topics/create']), ['class' => 'btn btn-primary']) ?>
                </p>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'id' => 'topic-index-grid',
                    'responsive' => true,
                    'pjax' => true,
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => 'Danh sách chủ đề'
                    ],
                    'toolbar' => [
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-ok"></i> Mới Post', [
                                    'type' => 'button',
                                    'title' => 'Mới Post',
                                    'class' => 'btn btn-success',
                                    'onclick' => 'approveTopics('.Topics::STATUS_NEW_POST.');'
                                ])

                        ],
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-refresh"></i>Đã xử lý', [
                                    'type' => 'button',
                                    'title' => 'Đã xử lý',
                                    'class' => 'btn btn-info',
                                    'onclick' => 'approveTopics('.Topics::STATUS_IN_PROCESS.');'
                                ])

                        ],
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-transfer"></i> Đang giải quyết', [
                                    'type' => 'button',
                                    'title' => 'Đang giải quyết',
                                    'class' => 'btn btn-primary',
                                    'onclick' => 'approveTopics('.Topics::STATUS_ANSWERED.');'
                                ])

                        ],
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-exclamation-sign"></i> Chưa trả lời', [
                                    'type' => 'button',
                                    'title' => 'Chưa trả lời',
                                    'class' => 'btn btn-danger',
                                    'onclick' => 'approveTopics('.Topics::STATUS_UNANSWERED.');'
                                ])

                        ],

                    ],
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                            'attribute'=>'topic_title',
                            'value' => function ($model, $key, $index, $widget) {
                                return CUtils::substr($model->topic_title, 50);
                            }
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute'=>'forum_name',
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
                        [
                            'attribute'=>'topic_last_post_time',
                            'value' => function ($model, $key, $index, $widget) {
                                return date('d/m/Y H:i:s', $model->topic_last_post_time);
                            }
                        ],
                        ['class' => 'kartik\grid\ActionColumn',
                            'template'=>'{view}{update}',
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
