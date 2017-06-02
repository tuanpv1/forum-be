<?php

use common\models\AclGroups;
use common\models\Groups;
use common\models\Users;
use kartik\form\ActiveForm;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $role \common\models\AclGroups */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý danh mục ';
$this->params['breadcrumbs'][] = $this->title;
$pleaseChooseLeastOneContent = \Yii::t('app', 'Chưa chọn danh mục! Xin vui lòng chọn ít nhất một danh mục để phân quyền.');

$js = <<<JS
        function openModal(){
        feedbacks = $("#grid-category-id").yiiGridView("getSelectedRows");
        if(feedbacks.length <= 0){
         alert("$pleaseChooseLeastOneContent");
         return;
        }

     $('#list_category_id').val(feedbacks);

    $('#modal_profile_forms').modal({
        backdrop: "static",
        keyboard:false

    });
   }

   function openDetail(){
     $('#auth_role_id').val(0);
    $('#modal_detail').modal({
        backdrop: "static",
        keyboard:false

    });
   }
JS;
$this->registerJs($js, View::POS_END);


?>
    <div class="modal fade" id="modal_profile_forms" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Phân quyền</h4>
                </div>
                <div class="modal-body ">
                    <?php $form = ActiveForm::begin([
                        'type' => ActiveForm::TYPE_HORIZONTAL,
                        'options' => ['enctype' => 'multipart/form-data'],
                        'action' => \yii\helpers\Url::to(['']),
                        'fullSpan' => 11,
                        'formConfig' => [
                            'type' => ActiveForm::TYPE_HORIZONTAL,
                            'labelSpan' => 2,
                            'deviceSize' => ActiveForm::SIZE_SMALL,
                        ],
                    ]); ?>
                    <?= $form->field($role, 'category')->hiddenInput(['id' => 'list_category_id'])->label(false) ?>
                    <?php
                    $roles = ArrayHelper::map(Users::findAll(['user_type' => Users::USER_TYPE_ACTIVE]), "user_id", "username");
                    echo $form->field($role, 'user_arr[]')->widget(Select2::className(), [
                        'data' => $roles,
                        'options' => [
                            'placeholder' => '' . \Yii::t('app', 'Chọn...'),
                            'multiple' => true,
                        ],
                    ]);
                    ?>

                    <?php
                    $roles = ArrayHelper::map(Groups::find()->andWhere(['IN', 'group_id', [Groups::GROUP_ADMINISTRATORS, Groups::GROUP_GLOBAL_MODERATORS, Groups::GROUP_REGISTERED, Groups::GROUP_NEWLY_REGISTEREDLY]])->all(), "group_id", "group_display_name");
                    echo $form->field($role, 'listGroup[]')->widget(Select2::className(), [
                        'data' => $roles,
                        'options' => [
                            'placeholder' => '' . \Yii::t('app', 'Chọn...'),
                            'multiple' => true,
                        ],
                    ]);
                    ?>
                    <?= $form->field($role, 'auth_role_id')->dropDownList(AclGroups::getListRoles(), ['class' => 'input','id'=>'auth_role_id']) ?>
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-offset-2 col-md-3">
                        <?= Html::a('Thiết lập nâng cao',null,['onclick'=>'openDetail();']) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <?= Html::submitButton($role->isNewRecord ? 'Phân quyền' : 'Update',
                                ['class' => $role->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            <?= Html::a(\Yii::t('app', 'Quay lại'), ['index'], ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>


            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <div class="modal fade" id="modal_detail" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Quyền chi tiết</h4>
                </div>
                <div class="modal-body ">
                    <?php $form = ActiveForm::begin([
                        'type' => ActiveForm::TYPE_HORIZONTAL,
                        'options' => ['enctype' => 'multipart/form-data'],
                        'action' => \yii\helpers\Url::to(['']),
                        'fullSpan' => 11,
                        'formConfig' => [
                            'type' => ActiveForm::TYPE_HORIZONTAL,
                            'labelSpan' => 2,
                            'deviceSize' => ActiveForm::SIZE_SMALL,
                        ],
                    ]); ?>
                    <?= $form->field($role, 'list_id')->checkboxList(\common\models\AclRolesData::getRoleOptionId(1)) ?>

                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <?= Html::submitButton($role->isNewRecord ? 'Phân quyền' : 'Update',
                                ['class' => $role->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            <?= Html::a(\Yii::t('app', 'Quay lại'), ['index'], ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>


            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Cấp quyền danh mục</span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <p>
                        <?php echo Html::button(\Yii::t('app', 'Phân quyền'),
                            [
                                'class' => 'btn btn-primary',
                                'onclick' => 'openModal()'
                            ]); ?>
                    </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'grid-category-id',
//                    'filterModel' => $searchModel,
                        'responsive' => true,
                        'pjax' => true,
                        'hover' => true,
                        'columns' => [
                            [
                                'class' => '\kartik\grid\DataColumn',
                                'attribute' => 'path_name',
                                'label' => 'Tên danh mục',
                                'value' => function ($model, $key, $index, $widget) {
                                    /** @var $model \common\models\Category */
                                    return $model->forum_name;
                                },
                            ],
                            [
                                'class' => 'kartik\grid\EditableColumn',
                                'attribute' => 'forum_status_display',
                                'label' => 'Trạng thái',
                                'refreshGrid' => true,
                                'editableOptions' => function ($model, $key, $index) {
                                    return [
                                        'header' => 'Trạng thái',
                                        'size' => 'md',
                                        'displayValueConfig' => $model->listStatus,
                                        'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                                        'data' => $model->listStatus,
                                        'placement' => \kartik\popover\PopoverX::ALIGN_LEFT
                                    ];
                                },
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => [0 => 'Ẩn', 10 => 'Hoạt động', 1 => 'Khóa'],
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                                'filterInputOptions' => ['placeholder' => 'Tất cả'],
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

<?php
