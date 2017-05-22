<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'forum_id') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'left_id') ?>

    <?= $form->field($model, 'right_id') ?>

    <?= $form->field($model, 'forum_parents') ?>

    <?php // echo $form->field($model, 'forum_name') ?>

    <?php // echo $form->field($model, 'forum_desc') ?>

    <?php // echo $form->field($model, 'forum_desc_bitfield') ?>

    <?php // echo $form->field($model, 'forum_desc_options') ?>

    <?php // echo $form->field($model, 'forum_desc_uid') ?>

    <?php // echo $form->field($model, 'forum_link') ?>

    <?php // echo $form->field($model, 'forum_password') ?>

    <?php // echo $form->field($model, 'forum_style') ?>

    <?php // echo $form->field($model, 'forum_image') ?>

    <?php // echo $form->field($model, 'forum_rules') ?>

    <?php // echo $form->field($model, 'forum_rules_link') ?>

    <?php // echo $form->field($model, 'forum_rules_bitfield') ?>

    <?php // echo $form->field($model, 'forum_rules_options') ?>

    <?php // echo $form->field($model, 'forum_rules_uid') ?>

    <?php // echo $form->field($model, 'forum_topics_per_page') ?>

    <?php // echo $form->field($model, 'forum_type') ?>

    <?php // echo $form->field($model, 'forum_status') ?>

    <?php // echo $form->field($model, 'forum_last_post_id') ?>

    <?php // echo $form->field($model, 'forum_last_poster_id') ?>

    <?php // echo $form->field($model, 'forum_last_post_subject') ?>

    <?php // echo $form->field($model, 'forum_last_post_time') ?>

    <?php // echo $form->field($model, 'forum_last_poster_name') ?>

    <?php // echo $form->field($model, 'forum_last_poster_colour') ?>

    <?php // echo $form->field($model, 'forum_flags') ?>

    <?php // echo $form->field($model, 'display_on_index') ?>

    <?php // echo $form->field($model, 'enable_indexing') ?>

    <?php // echo $form->field($model, 'enable_icons') ?>

    <?php // echo $form->field($model, 'enable_prune') ?>

    <?php // echo $form->field($model, 'prune_next') ?>

    <?php // echo $form->field($model, 'prune_days') ?>

    <?php // echo $form->field($model, 'prune_viewed') ?>

    <?php // echo $form->field($model, 'prune_freq') ?>

    <?php // echo $form->field($model, 'display_subforum_list') ?>

    <?php // echo $form->field($model, 'forum_options') ?>

    <?php // echo $form->field($model, 'forum_posts_approved') ?>

    <?php // echo $form->field($model, 'forum_posts_unapproved') ?>

    <?php // echo $form->field($model, 'forum_posts_softdeleted') ?>

    <?php // echo $form->field($model, 'forum_topics_approved') ?>

    <?php // echo $form->field($model, 'forum_topics_unapproved') ?>

    <?php // echo $form->field($model, 'forum_topics_softdeleted') ?>

    <?php // echo $form->field($model, 'enable_shadow_prune') ?>

    <?php // echo $form->field($model, 'prune_shadow_days') ?>

    <?php // echo $form->field($model, 'prune_shadow_freq') ?>

    <?php // echo $form->field($model, 'prune_shadow_next') ?>

    <?php // echo $form->field($model, 'rh_topictags_enabled') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
