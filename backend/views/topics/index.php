<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TopicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Topics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topics-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Topics', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'topic_id',
            'forum_id',
            'icon_id',
            'topic_attachment',
            'topic_reported',
            // 'topic_title',
            // 'topic_poster',
            // 'topic_time',
            // 'topic_time_limit',
            // 'topic_views',
            // 'topic_status',
            // 'topic_type',
            // 'topic_first_post_id',
            // 'topic_first_poster_name',
            // 'topic_first_poster_colour',
            // 'topic_last_post_id',
            // 'topic_last_poster_id',
            // 'topic_last_poster_name',
            // 'topic_last_poster_colour',
            // 'topic_last_post_subject',
            // 'topic_last_post_time',
            // 'topic_last_view_time',
            // 'topic_moved_id',
            // 'topic_bumped',
            // 'topic_bumper',
            // 'poll_title',
            // 'poll_start',
            // 'poll_length',
            // 'poll_max_options',
            // 'poll_last_vote',
            // 'poll_vote_change',
            // 'topic_visibility',
            // 'topic_delete_time',
            // 'topic_delete_reason',
            // 'topic_delete_user',
            // 'topic_posts_approved',
            // 'topic_posts_unapproved',
            // 'topic_posts_softdeleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
