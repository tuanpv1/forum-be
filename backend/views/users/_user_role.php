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
$formIdRole= "add-role-form";

$revokeUrl = Url::to(['users/revoke-role-item']);

$js = <<<JS
function revokeItemRole(item,name_item){
    if(confirm("Bạn có thực sự muốn xóa nhóm quyền '" + name_item + "' khỏi user '" + "$model->username" + "' không?")){
    jQuery.post(
        '{$revokeUrl}'
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
jQuery('#{$formIdRole}').on('beforeSubmit', function(e) {
    \$form = jQuery('#{$formIdRole}');
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
            'dataProvider' => $model->getAuthRoleUser(),
            'responsive' => true,
            'pjax' => true,
            'hover' => true,
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' => 'auth_role_id',
                    'format' => 'html',
                    'vAlign' => 'middle',
                    'value' => function ($model, $key, $index, $widget) {
                        /**
                         * @var $model \common\models\AclUsers
                         */
                        $res =$model->auth_role_id?AclRoles::findOne(['role_id'=>$model->auth_role_id])->role_name:'';
                        return $res;
                    },
                ],
                [
                    'attribute' => 'Mô tả',
                    'format' => 'html',
                    'vAlign' => 'middle',
                    'value' => function ($model, $key, $index, $widget) {
                        /**
                         * @var $model \common\models\AclUsers
                         */
                        return $model->auth_role_id?AclRoles::findOne(['role_id'=>$model->auth_role_id])->description:'';
                    },
                ],
                ['class' => 'kartik\grid\ActionColumn',
                    'template' => '{revoke}',
                    'buttons'=> [
                        'revoke' => function ($url, $model1, $key) {
                            $name_item = AclRoles::findOne(['role_id'=>$model1->auth_role_id])->role_name;
                            return Html::button('<i class="glyphicon glyphicon-remove-circle"></i> '.\Yii::t('app', 'Xóa quyền'), [
                                'type' => 'button',
                                'title' => ''.\Yii::t('app', 'Xóa nhóm quyền'),
                                'class' => 'btn btn-danger',
                                'onclick' => "revokeItemRole('$model1->auth_role_id','$name_item');"
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>

        <h3 class="form-section"><?= \Yii::t('app', 'Thêm nhóm quyền') ?></h3>
        <?php
        $form = ActiveForm::begin([
            'id' => $formIdRole,
            'action' => ['users/add-role-user', 'id' => $model->user_id]
        ]);
        ?>

        <div class="form-group">
            <?php
            $roles = ArrayHelper::map($model->getAllRolesUser(), "role_id", "role_name");
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
            <?= Html::submitButton(''.\Yii::t('app', 'Thêm nhóm quyền'),['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

