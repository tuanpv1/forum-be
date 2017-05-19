<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tags */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
    'id' => 'form-create-content',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,

]); ?>
    <div class="form-body">
        <?php if ($model->isNewRecord) { ?>
            <?= $form->field($model, 'tag')->textInput(['maxlength' => 30, 'class' => 'form-control  input-circle']) ?>
        <?php } else { ?>
            <?= $form->field($model, 'tag')->textInput(['maxlength' => 30, 'class' => 'form-control  input-circle', 'readOnly' => true]) ?>
        <?php } ?>


        <?= $form->field($model, 'tag_status')->dropDownList(
            \common\models\Tags::getListStatus('filter'), ['class' => 'input-circle']
        ) ?>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tạo bài viết') : Yii::t('app', 'Cập nhật'),
                    ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Quay lại'), ['index'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>