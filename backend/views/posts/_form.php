<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'topic_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'forum_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poster_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poster_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_reported')->textInput() ?>

    <?= $form->field($model, 'enable_bbcode')->textInput() ?>

    <?= $form->field($model, 'enable_smilies')->textInput() ?>

    <?= $form->field($model, 'enable_magic_url')->textInput() ?>

    <?= $form->field($model, 'enable_sig')->textInput() ?>

    <?= $form->field($model, 'post_username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'post_checksum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_attachment')->textInput() ?>

    <?= $form->field($model, 'bbcode_bitfield')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bbcode_uid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_postcount')->textInput() ?>

    <?= $form->field($model, 'post_edit_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_edit_reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_edit_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_edit_count')->textInput() ?>

    <?= $form->field($model, 'post_edit_locked')->textInput() ?>

    <?= $form->field($model, 'post_visibility')->textInput() ?>

    <?= $form->field($model, 'post_delete_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_delete_reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_delete_user')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
