<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Topics */

$this->title = $model->topic_id;
$this->params['breadcrumbs'][] = ['label' => 'Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topics-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->topic_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->topic_id], [
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
            'topic_id',
            'forum_id',
            'icon_id',
            'topic_attachment',
            'topic_reported',
            'topic_title',
            'topic_poster',
            'topic_time',
            'topic_time_limit',
            'topic_views',
            'topic_status',
            'topic_type',
            'topic_first_post_id',
            'topic_first_poster_name',
            'topic_first_poster_colour',
            'topic_last_post_id',
            'topic_last_poster_id',
            'topic_last_poster_name',
            'topic_last_poster_colour',
            'topic_last_post_subject',
            'topic_last_post_time',
            'topic_last_view_time',
            'topic_moved_id',
            'topic_bumped',
            'topic_bumper',
            'poll_title',
            'poll_start',
            'poll_length',
            'poll_max_options',
            'poll_last_vote',
            'poll_vote_change',
            'topic_visibility',
            'topic_delete_time',
            'topic_delete_reason',
            'topic_delete_user',
            'topic_posts_approved',
            'topic_posts_unapproved',
            'topic_posts_softdeleted',
        ],
    ]) ?>

</div>
