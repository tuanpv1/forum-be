<?php

use common\assets\ToastAsset;
use common\models\AclOptions;
use common\models\AclRoles;
use kartik\grid\GridView;
use yii\web\View;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use common\models\AuthItem;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

?>
<?php
ToastAsset::register($this);
ToastAsset::config($this, [
    'positionClass' => ToastAsset::POSITION_TOP_RIGHT
]);

$authAclUserGridId = "authAclUserGridId";
$formID= "add-permission-form";

$revokeOptionUrl = Url::to(['users/revoke-option-item']);

$js = <<<JS
function revokeItem(item){
    if(confirm("Bạn có thực sự muốn xóa quyền '" + item + "' khỏi user '" + "$model->username" + "' không?")){
    jQuery.post(
        '{$revokeOptionUrl}'
        ,{ users: "$model->user_id", item:item}
        )
        .done(function(result) {
            if(result.success){
                toastr.success(result.message);
                jQuery.pjax.reload({container:'#{$authAclUserGridId}'});
            }else{
                toastr.error(result.message);
            }
        })
        .fail(function() {
            toastr.error("server error");
    });
    }
}
JS;

$this->registerJs($js, View::POS_END);

$js = <<<JS
// get the form id and set the event
jQuery('#{$formID}').on('beforeSubmit', function(e) {
    \$form = jQuery('#{$formID}');
   $.post(
        \$form.attr("action"), // serialize Yii2 form
        \$form.serialize()
    )
        .done(function(result) {
            if(result.success){
                toastr.success(result.message);
                jQuery.pjax.reload({container:'#{$authAclUserGridId}'});
            }else{
                toastr.error(result.message);
            }
        })
        .fail(function() {
            toastr.error("server error");
        });
    return false;
}).on('submit', function(e){
    e.preventDefault();
});
JS;
$this->registerJs($js, View::POS_END);
/** @var  $model \common\models\Users */
?>

<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-globe"></i><?= \Yii::t('app', 'Quản lí phân quyền') ?></div>
    </div>

    <div class="portlet-body">
        <h3 class="form-section"><?= \Yii::t('app', 'Quyền User') ?></h3>
        <?= GridView::widget([
            'id' => $authAclUserGridId,
            'dataProvider' => $model->getAuthAclUser(),
            'responsive' => true,
            'pjax' => true,
            'hover' => true,
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' => 'auth_option_id',
                    'format' => 'html',
                    'vAlign' => 'middle',
                    'value' => function ($model, $key, $index, $widget) {
                        /**
                         * @var $model \common\models\AclUsers
                         */
                        $res = \common\models\AclOptions::findOne(['auth_option_id'=>$model->auth_option_id])->auth_option;
                        return $res;
                    },
                ],
                [
                    'attribute' => 'Mô tả',
                    'format' => 'html',
                    'vAlign' => 'middle',
                    'value' => function ($model, $key, $index, $widget) {
                        /**
                         * @var $model \common\models\AclOptions
                         */
                        $res = AclOptions::findOne(['auth_option_id'=>$model->auth_option_id])->description;
                        return $res;
                    },
                ],
                ['class' => 'kartik\grid\ActionColumn',
                    'template' => '{revoke}',
                    'buttons'=> [
                        'revoke' => function ($url, $model1, $key) {
                            return Html::button('<i class="glyphicon glyphicon-remove-circle"></i> '.\Yii::t('app', 'Xóa quyền'), [
                                'type' => 'button',
                                'title' => ''.\Yii::t('app', 'Xóa quyền'),
                                'class' => 'btn btn-danger',
                                'onclick' => "revokeItem('$model1->auth_option_id');"
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>

        <h3 class="form-section"><?= \Yii::t('app', 'Thêm quyền') ?></h3>
        <?php
        $form = ActiveForm::begin([
            'id' => $formID,
            'action' => ['users/add-acl-user', 'id' => $model->user_id]
        ]);
        ?>

        <div class="form-group">
            <?php
            $roles = ArrayHelper::map($model->getAllOptionUser(), "auth_option_id", "auth_option");
            //                                            $data = ["Nhóm quyền" => $roles];
            $data = $roles;
            echo Select2::widget([
                'name' => 'addItems',
                'data' => $data,
                'options' => [
                    'placeholder' => ''.\Yii::t('app', 'Chọn...'),
                    'multiple' => true,
                ],
            ]);
            ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(''.\Yii::t('app', 'Thêm quyền'),['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

