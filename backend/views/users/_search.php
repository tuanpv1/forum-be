<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'user_type') ?>

    <?= $form->field($model, 'group_id') ?>

    <?= $form->field($model, 'user_permissions') ?>

    <?= $form->field($model, 'user_perm_from') ?>

    <?php // echo $form->field($model, 'user_ip') ?>

    <?php // echo $form->field($model, 'user_regdate') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'username_clean') ?>

    <?php // echo $form->field($model, 'user_password') ?>

    <?php // echo $form->field($model, 'user_passchg') ?>

    <?php // echo $form->field($model, 'user_email') ?>

    <?php // echo $form->field($model, 'user_email_hash') ?>

    <?php // echo $form->field($model, 'user_birthday') ?>

    <?php // echo $form->field($model, 'user_lastvisit') ?>

    <?php // echo $form->field($model, 'user_lastmark') ?>

    <?php // echo $form->field($model, 'user_lastpost_time') ?>

    <?php // echo $form->field($model, 'user_lastpage') ?>

    <?php // echo $form->field($model, 'user_last_confirm_key') ?>

    <?php // echo $form->field($model, 'user_last_search') ?>

    <?php // echo $form->field($model, 'user_warnings') ?>

    <?php // echo $form->field($model, 'user_last_warning') ?>

    <?php // echo $form->field($model, 'user_login_attempts') ?>

    <?php // echo $form->field($model, 'user_inactive_reason') ?>

    <?php // echo $form->field($model, 'user_inactive_time') ?>

    <?php // echo $form->field($model, 'user_posts') ?>

    <?php // echo $form->field($model, 'user_lang') ?>

    <?php // echo $form->field($model, 'user_timezone') ?>

    <?php // echo $form->field($model, 'user_dateformat') ?>

    <?php // echo $form->field($model, 'user_style') ?>

    <?php // echo $form->field($model, 'user_rank') ?>

    <?php // echo $form->field($model, 'user_colour') ?>

    <?php // echo $form->field($model, 'user_new_privmsg') ?>

    <?php // echo $form->field($model, 'user_unread_privmsg') ?>

    <?php // echo $form->field($model, 'user_last_privmsg') ?>

    <?php // echo $form->field($model, 'user_message_rules') ?>

    <?php // echo $form->field($model, 'user_full_folder') ?>

    <?php // echo $form->field($model, 'user_emailtime') ?>

    <?php // echo $form->field($model, 'user_topic_show_days') ?>

    <?php // echo $form->field($model, 'user_topic_sortby_type') ?>

    <?php // echo $form->field($model, 'user_topic_sortby_dir') ?>

    <?php // echo $form->field($model, 'user_post_show_days') ?>

    <?php // echo $form->field($model, 'user_post_sortby_type') ?>

    <?php // echo $form->field($model, 'user_post_sortby_dir') ?>

    <?php // echo $form->field($model, 'user_notify') ?>

    <?php // echo $form->field($model, 'user_notify_pm') ?>

    <?php // echo $form->field($model, 'user_notify_type') ?>

    <?php // echo $form->field($model, 'user_allow_pm') ?>

    <?php // echo $form->field($model, 'user_allow_viewonline') ?>

    <?php // echo $form->field($model, 'user_allow_viewemail') ?>

    <?php // echo $form->field($model, 'user_allow_massemail') ?>

    <?php // echo $form->field($model, 'user_options') ?>

    <?php // echo $form->field($model, 'user_avatar') ?>

    <?php // echo $form->field($model, 'user_avatar_type') ?>

    <?php // echo $form->field($model, 'user_avatar_width') ?>

    <?php // echo $form->field($model, 'user_avatar_height') ?>

    <?php // echo $form->field($model, 'user_sig') ?>

    <?php // echo $form->field($model, 'user_sig_bbcode_uid') ?>

    <?php // echo $form->field($model, 'user_sig_bbcode_bitfield') ?>

    <?php // echo $form->field($model, 'user_jabber') ?>

    <?php // echo $form->field($model, 'user_actkey') ?>

    <?php // echo $form->field($model, 'user_newpasswd') ?>

    <?php // echo $form->field($model, 'user_form_salt') ?>

    <?php // echo $form->field($model, 'user_new') ?>

    <?php // echo $form->field($model, 'user_reminded') ?>

    <?php // echo $form->field($model, 'user_reminded_time') ?>

    <?php // echo $form->field($model, 'user_password_yii') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
