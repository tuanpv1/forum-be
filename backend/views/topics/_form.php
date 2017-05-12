<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Topics */
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

        <?= $form->field($model, 'topic_title')->textInput(['maxlength' => 256, 'class' => 'form-control  input-circle']) ?>

        <?= $form->field($model, 'post_text')->widget(\dosamigos\ckeditor\CKEditor::className(), [
            'options' => ['rows' => 4],
            'preset' => 'full'
        ]) ?>

        <?= $form->field($model, 'topic_status_display')->dropDownList(
            \common\models\Topics::getListStatus('filter'), ['class' => 'input-circle']
        ) ?>
        <div class="row">

            <div class="form-group field-content-price">
                <label class="control-label col-md-2" for="content-price"><?= Yii::t('app', 'Forum') ?></label>

                <div class="col-md-10">
                    <?= \common\widgets\Jstree::widget([
                        'clientOptions' => [
                            "checkbox" => ["keep_selected_style" => false],
                            "plugins" => ["checkbox"]
                        ],
                        'type' => 1,
                        'data' => isset($selectedCats) ? $selectedCats : [],
                        'eventHandles' => [
                            'changed.jstree' => "function(e,data) {
                            jQuery('#list-cat-id').val('');
                            var i, j, r = [];
                            var catIds='';
                            for(i = 0, j = data.selected.length; i < j; i++) {
                                var item = $(\"#\" + data.selected[i]);
                                var value = item.attr(\"id\");
                                if(i==j-1){
                                    catIds += value;
                                } else{
                                    catIds += value +',';

                                }
                            }
                            jQuery(\"#default_category_id\").val(data.selected[0])
                            jQuery(\"#list-cat-id\").val(catIds);
                            console.log(jQuery(\"#list-cat-id\").val());
                         }"
                        ]
                    ]) ?>
                </div>
                <div class="col-md-offset-2 col-md-10"></div>
                <div class="col-md-offset-2 col-md-10">
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <!--    --><?php //endif; ?>
        <?= $form->field($model, 'list_cat_id')->hiddenInput(['id' => 'list-cat-id'])->label(false) ?>
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