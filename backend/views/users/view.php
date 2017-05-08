<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'user_type',
            'group_id',
            'user_permissions:ntext',
            'user_perm_from',
            'user_ip',
            'user_regdate',
            'username',
            'username_clean',
            'user_password',
            'user_passchg',
            'user_email:email',
            'user_email_hash:email',
            'user_birthday',
            'user_lastvisit',
            'user_lastmark',
            'user_lastpost_time',
            'user_lastpage',
            'user_last_confirm_key',
            'user_last_search',
            'user_warnings',
            'user_last_warning',
            'user_login_attempts',
            'user_inactive_reason',
            'user_inactive_time',
            'user_posts',
            'user_lang',
            'user_timezone',
            'user_dateformat',
            'user_style',
            'user_rank',
            'user_colour',
            'user_new_privmsg',
            'user_unread_privmsg',
            'user_last_privmsg',
            'user_message_rules',
            'user_full_folder',
            'user_emailtime:email',
            'user_topic_show_days',
            'user_topic_sortby_type',
            'user_topic_sortby_dir',
            'user_post_show_days',
            'user_post_sortby_type',
            'user_post_sortby_dir',
            'user_notify',
            'user_notify_pm',
            'user_notify_type',
            'user_allow_pm',
            'user_allow_viewonline',
            'user_allow_viewemail:email',
            'user_allow_massemail:email',
            'user_options',
            'user_avatar',
            'user_avatar_type',
            'user_avatar_width',
            'user_avatar_height',
            'user_sig:ntext',
            'user_sig_bbcode_uid',
            'user_sig_bbcode_bitfield',
            'user_jabber',
            'user_actkey',
            'user_newpasswd',
            'user_form_salt',
            'user_new',
            'user_reminded',
            'user_reminded_time',
            'user_password_yii',
            'auth_key',
        ],
    ]) ?>

</div>
