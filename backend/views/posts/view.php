<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->title = $model->post_id;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->post_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->post_id], [
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
            'post_id',
            'topic_id',
            'forum_id',
            'poster_id',
            'icon_id',
            'poster_ip',
            'post_time',
            'post_reported',
            'enable_bbcode',
            'enable_smilies',
            'enable_magic_url:url',
            'enable_sig',
            'post_username',
            'post_subject',
            'post_text:ntext',
            'post_checksum',
            'post_attachment',
            'bbcode_bitfield',
            'bbcode_uid',
            'post_postcount',
            'post_edit_time',
            'post_edit_reason',
            'post_edit_user',
            'post_edit_count',
            'post_edit_locked',
            'post_visibility',
            'post_delete_time',
            'post_delete_reason',
            'post_delete_user',
        ],
    ]) ?>

</div>
