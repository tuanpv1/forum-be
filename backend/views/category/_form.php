<?php

use common\models\Site;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
$showPreview = !$model->isNewRecord && !empty($model->images);
?>

<?php $form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 8,
    'options' => ['enctype' => 'multipart/form-data'],
    'formConfig' => [
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'labelSpan' => 3,
        'deviceSize' => ActiveForm::SIZE_SMALL,
    ],
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
]); ?>
<div class="form-body">

    <?= $form->field($model, 'forum_name')->textInput(['maxlength' => 200, 'class' => 'input-circle']) ?>
    <?php if (!$model->isNewRecord) { ?>
        <?= $form->field($model, 'forum_topics_per_page')->textInput(['maxlength' => 2, 'class' => 'input-circle']) ?>
    <?php } ?>

    <?= $form->field($model, 'forum_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'forum_status_display')->dropDownList(
        \common\models\Category::getListStatus(), ['class' => 'input-circle']
    ) ?>
    <?php
    $dataList = \common\models\Category::getTreeCategories();
    $disableId = false;
    if (!$model->isNewRecord) {
        $disableId = $model->forum_id;
    }
    echo $form->field($model, 'parent_id')->dropDownList($dataList,
        [
            'prompt' => '-Chọn nhóm cha-',
            'options' => \common\models\Category::getAllChildCats( $model->forum_id) + [$model->forum_id => ['disabled' => true]]
        ]);
    ?>


</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <?= Html::submitButton($model->isNewRecord ? 'Tạo danh mục' : 'Cập nhật',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a('Quay lại', ['index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
