<?php

use common\helpers\CommonUtils;
use common\models\Forums;
use common\models\ReportUsers;
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

/* @var $report ReportUsers */
/* @var $this yii\web\View */

$this->title = ''.\Yii::t('app', 'Báo cáo thống kê thành viên');
$this->params['breadcrumbs'][] = $this->title;
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
                                    'action' => Url::to(['report/report-user']),]
                            ); ?>

                            <div class="row">
                                <div class="col-md-12">

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
                                        <?php
                                        $gridColumns =[
                                            [
                                                'class' => '\kartik\grid\DataColumn',
                                                'attribute' => 'date_report',
                                                'width' => '150px',
                                                'value' => function ($model) {
                                                    /**  @var $model \common\models\ReportUsers */
                                                    return date('d/m/Y', $model->date_report);
                                                },
//                                                'pageSummary' => "".\Yii::t('app', 'Tổng số')
                                            ],
                                            [
                                                'class' => '\kartik\grid\DataColumn',
                                                'attribute' => 'total_user',
                                                'value' => function ($model) {
                                                    /**  @var $model \common\models\ReportUsers */
                                                    return $model->total_user;
                                                },
                                                'pageSummary' => true,
                                                'pageSummary' => CommonUtils::formatNumber($dataProvider->query->sum('user_ban')?$dataProvider->query->sum('user_ban'):0)
                                            ],
                                            [
                                                'class' => '\kartik\grid\DataColumn',
                                                'attribute' => 'user_ban',
                                                'value' => function ($model) {
                                                    /**  @var $model \common\models\ReportUsers */
                                                    return $model->user_ban;
                                                },
                                                'pageSummary' => true,
                                                'pageSummary' => CommonUtils::formatNumber($dataProvider->query->sum('user_ban')?$dataProvider->query->sum('user_ban'):0)
                                            ],
                                            [
                                                'class' => '\kartik\grid\DataColumn',
                                                'attribute' => 'user_register',
                                                'value' => function ($model) {
                                                    /**  @var $model \common\models\ReportUsers */
                                                    return $model->user_register;
                                                },
                                                'pageSummary' => true,
                                                'pageSummary' => CommonUtils::formatNumber($dataProvider->query->sum('user_register')?$dataProvider->query->sum('user_register'):0)
                                            ],
                                        ]
                                        ?>

                                        <?=
                                        ExportMenu::widget([
                                            'dataProvider' => $dataProvider,
                                            'columns' => $gridColumns,
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
                                            'filename' => "Report_Users"
                                        ])
                                        ?>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

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