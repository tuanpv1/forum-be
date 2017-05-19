<?php

use common\helpers\CUtils;
use common\models\Tags;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TopicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = '/ '.$this->title;

\common\assets\ToastAsset::register($this);
\common\assets\ToastAsset::config($this, [
    'positionClass' => \common\assets\ToastAsset::POSITION_TOP_RIGHT
]);
?>


<?php
$approveUrl = \yii\helpers\Url::to(['tags/approve']);


$js = <<<JS
    function approveTags(status){
    feedbacks = $("#tags-index-grid").yiiGridView("getSelectedRows");
    if(feedbacks.length <= 0){
    alert("Chưa chọn tag! Xin vui lòng chọn ít nhất một tag để duyệt.");
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
    jQuery.pjax.reload({container:'#tags-index-grid'});
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
                    <?php  echo Html::a("Tạo tag mới ", Yii::$app->urlManager->createUrl(['/tags/create']), ['class' => 'btn btn-primary']) ?>
                </p>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'id' => 'tags-index-grid',
                    'responsive' => true,
                    'pjax' => true,
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => 'Danh sách tags'
                    ],
                    'toolbar' => [
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-ok"></i> Hiển thị', [
                                    'type' => 'button',
                                    'title' => 'Mới Post',
                                    'class' => 'btn btn-success',
                                    'onclick' => 'approveTags('.Tags::STATUS_ACTIVE.');'
                                ])

                        ],
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-transfer"></i>Khóa', [
                                    'type' => 'button',
                                    'title' => 'Đang xử lý',
                                    'class' => 'btn btn-danger',
                                    'onclick' => 'approveTags('.Tags::STATUS_BLOCK.');'
                                ])

                        ],
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute'=>'tag',
                            'value' => function ($model, $key, $index, $widget) {
                                return CUtils::substr($model->tag, 30);
                            }
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute'=>'count',
                            'value' => function ($model, $key, $index, $widget) {
                                return $model->count;
                            }
                        ],
                        [
                            'attribute' => 'tag_status',
                            'class' => '\kartik\grid\DataColumn',
                            'width'=>'200px',
                            'value' => function ($model, $key, $index, $widget) {
                                /**
                                 * @var $model Tags
                                 */
                                return $model->getStatusName();
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => Tags::getStatus(),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Tất cả')],
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
