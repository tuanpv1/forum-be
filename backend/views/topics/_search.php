<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TopicsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="topics-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'topic_id') ?>

    <?= $form->field($model, 'forum_id') ?>

    <?= $form->field($model, 'icon_id') ?>

    <?= $form->field($model, 'topic_attachment') ?>

    <?= $form->field($model, 'topic_reported') ?>

    <?php // echo $form->field($model, 'topic_title') ?>

    <?php // echo $form->field($model, 'topic_poster') ?>

    <?php // echo $form->field($model, 'topic_time') ?>

    <?php // echo $form->field($model, 'topic_time_limit') ?>

    <?php // echo $form->field($model, 'topic_views') ?>

    <?php // echo $form->field($model, 'topic_status') ?>

    <?php // echo $form->field($model, 'topic_type') ?>

    <?php // echo $form->field($model, 'topic_first_post_id') ?>

    <?php // echo $form->field($model, 'topic_first_poster_name') ?>

    <?php // echo $form->field($model, 'topic_first_poster_colour') ?>

    <?php // echo $form->field($model, 'topic_last_post_id') ?>

    <?php // echo $form->field($model, 'topic_last_poster_id') ?>

    <?php // echo $form->field($model, 'topic_last_poster_name') ?>

    <?php // echo $form->field($model, 'topic_last_poster_colour') ?>

    <?php // echo $form->field($model, 'topic_last_post_subject') ?>

    <?php // echo $form->field($model, 'topic_last_post_time') ?>

    <?php // echo $form->field($model, 'topic_last_view_time') ?>

    <?php // echo $form->field($model, 'topic_moved_id') ?>

    <?php // echo $form->field($model, 'topic_bumped') ?>

    <?php // echo $form->field($model, 'topic_bumper') ?>

    <?php // echo $form->field($model, 'poll_title') ?>

    <?php // echo $form->field($model, 'poll_start') ?>

    <?php // echo $form->field($model, 'poll_length') ?>

    <?php // echo $form->field($model, 'poll_max_options') ?>

    <?php // echo $form->field($model, 'poll_last_vote') ?>

    <?php // echo $form->field($model, 'poll_vote_change') ?>

    <?php // echo $form->field($model, 'topic_visibility') ?>

    <?php // echo $form->field($model, 'topic_delete_time') ?>

    <?php // echo $form->field($model, 'topic_delete_reason') ?>

    <?php // echo $form->field($model, 'topic_delete_user') ?>

    <?php // echo $form->field($model, 'topic_posts_approved') ?>

    <?php // echo $form->field($model, 'topic_posts_unapproved') ?>

    <?php // echo $form->field($model, 'topic_posts_softdeleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
