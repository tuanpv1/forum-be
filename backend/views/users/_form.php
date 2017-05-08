<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_type')->textInput() ?>

    <?= $form->field($model, 'group_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_permissions')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_perm_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_regdate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username_clean')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_passchg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_email_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_birthday')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_lastvisit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_lastmark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_lastpost_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_lastpage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_last_confirm_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_last_search')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_warnings')->textInput() ?>

    <?= $form->field($model, 'user_last_warning')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_login_attempts')->textInput() ?>

    <?= $form->field($model, 'user_inactive_reason')->textInput() ?>

    <?= $form->field($model, 'user_inactive_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_posts')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_lang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_timezone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_dateformat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_style')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_rank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_colour')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_new_privmsg')->textInput() ?>

    <?= $form->field($model, 'user_unread_privmsg')->textInput() ?>

    <?= $form->field($model, 'user_last_privmsg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_message_rules')->textInput() ?>

    <?= $form->field($model, 'user_full_folder')->textInput() ?>

    <?= $form->field($model, 'user_emailtime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_topic_show_days')->textInput() ?>

    <?= $form->field($model, 'user_topic_sortby_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_topic_sortby_dir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_post_show_days')->textInput() ?>

    <?= $form->field($model, 'user_post_sortby_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_post_sortby_dir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_notify')->textInput() ?>

    <?= $form->field($model, 'user_notify_pm')->textInput() ?>

    <?= $form->field($model, 'user_notify_type')->textInput() ?>

    <?= $form->field($model, 'user_allow_pm')->textInput() ?>

    <?= $form->field($model, 'user_allow_viewonline')->textInput() ?>

    <?= $form->field($model, 'user_allow_viewemail')->textInput() ?>

    <?= $form->field($model, 'user_allow_massemail')->textInput() ?>

    <?= $form->field($model, 'user_options')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_avatar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_avatar_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_avatar_width')->textInput() ?>

    <?= $form->field($model, 'user_avatar_height')->textInput() ?>

    <?= $form->field($model, 'user_sig')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_sig_bbcode_uid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_sig_bbcode_bitfield')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_jabber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_actkey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_newpasswd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_form_salt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_new')->textInput() ?>

    <?= $form->field($model, 'user_reminded')->textInput() ?>

    <?= $form->field($model, 'user_reminded_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
