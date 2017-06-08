<?php

use common\helpers\CommonUtils;
use common\models\Forums;
use common\models\ReportTopics;
use common\models\Service;
use common\models\Site;
use common\models\Subscriber;
use common\models\SubscriberServiceAsm;
use kartik\export\ExportMenu;
use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\helpers\Html;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $report \backend\models\ReportUserDailyForm */
/* @var $this yii\web\View */

$this->title = ''.\Yii::t('app', 'Báo cáo thhonosh kê bài viết');
$this->params['breadcrumbs'][] = $this->title;

$js = <<<JS
    function onchangeTypeTime(){
        var value =$('#typeTime').val();
         if(value ==1){
            $("#date").show();
            $("#month").hide();
        }else if(value ==2){
            $("#date").hide();
            $("#month").show();
        }
    }
    $(document).ready(function () {
        onchangeTypeTime();
    });
JS;
$this->registerJs($js, \yii\web\View::POS_END);
$this->registerJs('onchangeTypeTime()');
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-body">

                <div class="report-user-daily-index">

                    <div class="row form-group">
                        <div class="col-md-12 col-md-offset-0">
                            <?php $form = ActiveForm::begin(
                                ['method' => 'get',
                                    'action' => Url::to(['report/report-topic']),]
                            ); ?>

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-2">
                                        <?= $form->field($report, 'forum_id')->dropDownList( ArrayHelper::merge(['' => ''.\Yii::t('app', 'Tất cả')],Forums::listForum()), ['id'=>'site-id']); ?>
                                    </div>

                                    <div class="col-md-2">
                                        <?= $form->field($report, 'from_date')->widget(\kartik\widgets\DatePicker::classname(), [
                                            'options' => ['placeholder' => ''.\Yii::t('app', 'Ngày bắt đầu')],
                                            'type' => \kartik\widgets\DatePicker::TYPE_INPUT,
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'todayHighlight' => true,
                                                'format' => 'dd/mm/yyyy'
                                            ]
                                        ]); ?>
                                    </div>

                                    <div class="col-md-2">
                                        <?= $form->field($report, 'to_date')->widget(\kartik\widgets\DatePicker::classname(), [
                                            'options' => ['placeholder' => ''.\Yii::t('app', 'Ngày kết thúc')],
                                            'type' => \kartik\widgets\DatePicker::TYPE_INPUT,
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'todayHighlight' => true,
                                                'format' => 'dd/mm/yyyy'
                                            ]
                                        ]); ?>
                                    </div>

                                    <div class="col-md-4">
                                        <div style="margin-top: 25px"></div>
                                        <?= \yii\helpers\Html::submitButton(''.\Yii::t('app', 'Xem báo cáo'), ['class' => 'btn btn-primary']) ?>
                                        <?php ActiveForm::end(); ?>
                                        <?php if ($dataProvider) { ?>

                                        <?=
                                        ExportMenu::widget([
                                            'dataProvider' => $dataProvider,
                                            'columns' => [
                                                [
                                                    'class' => '\kartik\grid\DataColumn',
                                                    'attribute' => 'date_report',
                                                    'width' => '150px',
                                                    'value' => function ($model) {
                                                        /**  @var $model \common\models\ReportTopics */
                                                        return date('d/m/Y', $model->date_report);
                                                    },
                                                    'pageSummary' => "".\Yii::t('app', 'Tổng số')
                                                ],

                                                [
                                                    'class' => '\kartik\grid\DataColumn',
                                                    'attribute' => 'topic_id',
                                                    //                                    'format'=>['decimal'],
                                                    'value' => function ($model) {
                                                        /**  @var $model \common\models\ReportTopics */
                                                        return $model->topic_id;
                                                    },
                                                    'pageSummary' => true,
                                                    'pageSummary' => CommonUtils::formatNumber($dataProvider->query->count('topic_id')?$dataProvider->query->count('topic_id'):0)
                                                ],

                                                [
                                                    'class' => '\kartik\grid\DataColumn',
                                                    'attribute' => 'total_post',
                                                    'value' => function ($model) {
                                                        /**  @var $model \common\models\ReportTopics */
                                                        return $model->total_post;
                                                    },
                                                    'pageSummary' => true,
                                                    'pageSummary' => CommonUtils::formatNumber($dataProvider->query->sum('total_post')?$dataProvider->query->sum('total_post'):0)
                                                ],
                                                [
                                                    'class' => '\kartik\grid\DataColumn',
                                                    'attribute' => 'like_count',
                                                    'value' => function ($model) {
                                                        /**  @var $model \common\models\ReportTopics */
                                                        return $model->like_count;
                                                    },
                                                    'pageSummary' => true,
                                                    'pageSummary' => CommonUtils::formatNumber($dataProvider->query->sum('like_count')?$dataProvider->query->sum('like_count'):0)
                                                ],
                                                [
                                                    'class' => '\kartik\grid\DataColumn',
                                                    'attribute' => 'view_count',
                                                    'value' => function ($model) {
                                                        /**  @var $model \common\models\ReportTopics */
                                                        return $model->view_count;
                                                    },
                                                    'pageSummary' => true,
                                                    'pageSummary' => CommonUtils::formatNumber($dataProvider->query->sum('view_count')?$dataProvider->query->sum('view_count'):0)
                                                ],
                                                [
                                                    'class' => '\kartik\grid\DataColumn',
                                                    'attribute' => 'rate_count',
                                                    'value' => function ($model) {
                                                        /**  @var $model \common\models\ReportTopics */
                                                        return $model->rate_count;
                                                    },
                                                    'pageSummary' => true,
                                                    'pageSummary' => CommonUtils::formatNumber($dataProvider->query->sum('rate_count')?$dataProvider->query->sum('rate_count'):0)
                                                ],
                                            ],
                                            'showConfirmAlert' => false,
                                            'fontAwesome' => true,
                                            'showColumnSelector' => false,
                                            'dropdownOptions' => [
                                                'label' => 'Xuất dữ liệu',
                                                'class' => 'btn btn-primary'
                                            ],
                                            'exportConfig' => [
                                                ExportMenu::FORMAT_CSV => false,
                                                ExportMenu::FORMAT_EXCEL_X => [
                                                    'label' => 'Excel',
                                                ],
                                                ExportMenu::FORMAT_HTML => false,
                                                ExportMenu::FORMAT_PDF => false,
                                                ExportMenu::FORMAT_TEXT => false,
                                                ExportMenu::FORMAT_EXCEL => false,
                                            ],
                                            'target' => ExportMenu::TARGET_SELF,
                                            'filename' => "Report_Topics"
                                        ])
                                        ?>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <?php $gridColumns =[
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'date_report',
                            'width' => '150px',
                            'value' => function ($model) {
                                /**  @var $model \common\models\ReportTopics */
                                return date('d/m/Y', $model->date_report);
                            },
                            'pageSummary' => "".\Yii::t('app', 'Tổng số')
                        ],

                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'topic_id',
                            //                                    'format'=>['decimal'],
                            'value' => function ($model) {
                                /**  @var $model \common\models\ReportTopics */
                                return $model->topic_id;
                            },
                            'pageSummary' => true,
                            'pageSummary' => CommonUtils::formatNumber($dataProvider->query->count('topic_id')?$dataProvider->query->count('topic_id'):0)
                        ],

                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'total_post',
                            'value' => function ($model) {
                                /**  @var $model \common\models\ReportTopics */
                                return $model->total_post;
                            },
                            'pageSummary' => true,
                            'pageSummary' => CommonUtils::formatNumber($dataProvider->query->sum('total_post')?$dataProvider->query->sum('total_post'):0)
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'like_count',
                            'value' => function ($model) {
                                /**  @var $model \common\models\ReportTopics */
                                return $model->like_count;
                            },
                            'pageSummary' => true,
                            'pageSummary' => CommonUtils::formatNumber($dataProvider->query->sum('like_count')?$dataProvider->query->sum('like_count'):0)
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'view_count',
                            'value' => function ($model) {
                                /**  @var $model \common\models\ReportTopics */
                                return $model->view_count;
                            },
                            'pageSummary' => true,
                            'pageSummary' => CommonUtils::formatNumber($dataProvider->query->sum('view_count')?$dataProvider->query->sum('view_count'):0)
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'rate_count',
                            'value' => function ($model) {
                                /**  @var $model \common\models\ReportTopics */
                                return $model->rate_count;
                            },
                            'pageSummary' => true,
                            'pageSummary' => CommonUtils::formatNumber($dataProvider->query->sum('rate_count')?$dataProvider->query->sum('rate_count'):0)
                        ],
                    ]
                    ?>

                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'responsive' => true,
                        'pjax' => true,
                        'hover' => true,
                        'showPageSummary' => true,
                        'columns' => $gridColumns,
                    ]);
                    ?>
                    <?php }else{ ?>
                        <div class="portlet-body">
                            <div class="well well-sm">
                                <p><?= \Yii::t('app', 'Không có dữ liệu') ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>