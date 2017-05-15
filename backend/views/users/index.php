<?php

use common\models\Groups;
use common\models\Topics;
use common\models\Users;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý Users';
$this->params['breadcrumbs'][] = $this->title;
$status_delete = Users::USER_TYPE_DELETED;
\common\assets\ToastAsset::register($this);
\common\assets\ToastAsset::config($this, [
    'positionClass' => \common\assets\ToastAsset::POSITION_TOP_RIGHT
]);
?>


<?php
$approveUrl = \yii\helpers\Url::to(['users/approve']);


$js = <<<JS
    function approveUsers(status){
    feedbacks = $("#user-index-grid").yiiGridView("getSelectedRows");
    if(feedbacks.length <= 0){
    alert("Chưa chọn Topics! Xin vui lòng chọn ít nhất một User để duyệt.");
    return;
    }

    if(status == '{$status_delete}'){
    if(!confirm("Thao tác không thể phục hồi, bạn vẫn muốn xóa.")){
        return;
    }
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
    jQuery.pjax.reload({container:'#user-index-grid'});
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
                    <?= Html::a(Yii::t('app', 'Thêm mới'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'id' => 'user-index-grid',
                    'responsive' => true,
                    'pjax' => true,
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => 'Danh sách Users'
                    ],
                    'toolbar' => [
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-ok"></i> Duyệt User', [
                                    'type' => 'button',
                                    'title' => 'Duyệt User',
                                    'class' => 'btn btn-success',
                                    'onclick' => 'approveUsers(' . Users::USER_TYPE_ACTIVE . ');'
                                ])

                        ],
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-pause"></i>Chờ Duyệt', [
                                    'type' => 'button',
                                    'title' => 'Chờ Duyệt',
                                    'class' => 'btn btn-info',
                                    'onclick' => 'approveUsers(' . Users::USER_TYPE_INACTIVE . ');'
                                ])

                        ],
                        [
                            'content' =>
                                Html::button('<i class="glyphicon glyphicon-trash"></i>Xóa User', [
                                    'type' => 'button',
                                    'title' => 'Xóa User',
                                    'class' => 'btn btn-danger',
                                    'onclick' => 'approveUsers(' . Users::USER_TYPE_DELETED . ');'
                                ])

                        ],

                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'username',
                            'format' => 'raw',
                            'value' => function ($model, $key, $index, $widget) {
                                /**
                                 * @var $model \common\models\Users
                                 */
                                $action = "users/view";
                                $res = Html::a('<kbd>' . $model->username . '</kbd>', [$action, 'id' => $model->id]);
                                return $res;
                            },
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'width' => '200px',
                            'attribute' => 'group_id',
                            'value' => function ($model, $key, $index, $widget) {
                                return Groups::findOne(['group_id' => $model->group_id])->group_name;
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => Groups::getGroups(),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Tất cả')],

                        ],
                        [
                            'attribute' => 'user_type',
                            'class' => '\kartik\grid\DataColumn',
                            'width' => '200px',
                            'value' => function ($model, $key, $index, $widget) {
                                /**
                                 * @var $model Users
                                 */
                                return $model->getStatusName();
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => Users::getStatus(),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => Yii::t('app', 'Tất cả')],
                        ],
                        'user_email:email',
                        'user_lang',
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

