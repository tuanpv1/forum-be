<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Topics */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="topics-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'forum_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_attachment')->textInput() ?>

    <?= $form->field($model, 'topic_reported')->textInput() ?>

    <?= $form->field($model, 'topic_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_poster')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_time_limit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_views')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_status')->textInput() ?>

    <?= $form->field($model, 'topic_type')->textInput() ?>

    <?= $form->field($model, 'topic_first_post_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_first_poster_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_first_poster_colour')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_last_post_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_last_poster_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_last_poster_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_last_poster_colour')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_last_post_subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_last_post_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_last_view_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_moved_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_bumped')->textInput() ?>

    <?= $form->field($model, 'topic_bumper')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poll_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poll_start')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poll_length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poll_max_options')->textInput() ?>

    <?= $form->field($model, 'poll_last_vote')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poll_vote_change')->textInput() ?>

    <?= $form->field($model, 'topic_visibility')->textInput() ?>

    <?= $form->field($model, 'topic_delete_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_delete_reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_delete_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_posts_approved')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_posts_unapproved')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_posts_softdeleted')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
