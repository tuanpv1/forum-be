<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PostsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'post_id') ?>

    <?= $form->field($model, 'topic_id') ?>

    <?= $form->field($model, 'forum_id') ?>

    <?= $form->field($model, 'poster_id') ?>

    <?= $form->field($model, 'icon_id') ?>

    <?php // echo $form->field($model, 'poster_ip') ?>

    <?php // echo $form->field($model, 'post_time') ?>

    <?php // echo $form->field($model, 'post_reported') ?>

    <?php // echo $form->field($model, 'enable_bbcode') ?>

    <?php // echo $form->field($model, 'enable_smilies') ?>

    <?php // echo $form->field($model, 'enable_magic_url') ?>

    <?php // echo $form->field($model, 'enable_sig') ?>

    <?php // echo $form->field($model, 'post_username') ?>

    <?php // echo $form->field($model, 'post_subject') ?>

    <?php // echo $form->field($model, 'post_text') ?>

    <?php // echo $form->field($model, 'post_checksum') ?>

    <?php // echo $form->field($model, 'post_attachment') ?>

    <?php // echo $form->field($model, 'bbcode_bitfield') ?>

    <?php // echo $form->field($model, 'bbcode_uid') ?>

    <?php // echo $form->field($model, 'post_postcount') ?>

    <?php // echo $form->field($model, 'post_edit_time') ?>

    <?php // echo $form->field($model, 'post_edit_reason') ?>

    <?php // echo $form->field($model, 'post_edit_user') ?>

    <?php // echo $form->field($model, 'post_edit_count') ?>

    <?php // echo $form->field($model, 'post_edit_locked') ?>

    <?php // echo $form->field($model, 'post_visibility') ?>

    <?php // echo $form->field($model, 'post_delete_time') ?>

    <?php // echo $form->field($model, 'post_delete_reason') ?>

    <?php // echo $form->field($model, 'post_delete_user') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
