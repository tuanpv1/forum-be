<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->forum_id;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->forum_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->forum_id], [
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
            'forum_id',
            'parent_id',
            'left_id',
            'right_id',
            'forum_parents:ntext',
            'forum_name',
            'forum_desc:ntext',
            'forum_desc_bitfield',
            'forum_desc_options',
            'forum_desc_uid',
            'forum_link',
            'forum_password',
            'forum_style',
            'forum_image',
            'forum_rules:ntext',
            'forum_rules_link',
            'forum_rules_bitfield',
            'forum_rules_options',
            'forum_rules_uid',
            'forum_topics_per_page',
            'forum_type',
            'forum_status',
            'forum_last_post_id',
            'forum_last_poster_id',
            'forum_last_post_subject',
            'forum_last_post_time',
            'forum_last_poster_name',
            'forum_last_poster_colour',
            'forum_flags',
            'display_on_index',
            'enable_indexing',
            'enable_icons',
            'enable_prune',
            'prune_next',
            'prune_days',
            'prune_viewed',
            'prune_freq',
            'display_subforum_list',
            'forum_options',
            'forum_posts_approved',
            'forum_posts_unapproved',
            'forum_posts_softdeleted',
            'forum_topics_approved',
            'forum_topics_unapproved',
            'forum_topics_softdeleted',
            'enable_shadow_prune',
            'prune_shadow_days',
            'prune_shadow_freq',
            'prune_shadow_next',
            'rh_topictags_enabled',
        ],
    ]) ?>

</div>
