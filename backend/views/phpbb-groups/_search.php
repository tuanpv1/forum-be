<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PhpbbGroupsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phpbb-groups-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'group_id') ?>

    <?= $form->field($model, 'group_type') ?>

    <?= $form->field($model, 'group_founder_manage') ?>

    <?= $form->field($model, 'group_skip_auth') ?>

    <?= $form->field($model, 'group_name') ?>

    <?php // echo $form->field($model, 'group_desc') ?>

    <?php // echo $form->field($model, 'group_desc_bitfield') ?>

    <?php // echo $form->field($model, 'group_desc_options') ?>

    <?php // echo $form->field($model, 'group_desc_uid') ?>

    <?php // echo $form->field($model, 'group_display') ?>

    <?php // echo $form->field($model, 'group_avatar') ?>

    <?php // echo $form->field($model, 'group_avatar_type') ?>

    <?php // echo $form->field($model, 'group_avatar_width') ?>

    <?php // echo $form->field($model, 'group_avatar_height') ?>

    <?php // echo $form->field($model, 'group_rank') ?>

    <?php // echo $form->field($model, 'group_colour') ?>

    <?php // echo $form->field($model, 'group_sig_chars') ?>

    <?php // echo $form->field($model, 'group_receive_pm') ?>

    <?php // echo $form->field($model, 'group_message_limit') ?>

    <?php // echo $form->field($model, 'group_legend') ?>

    <?php // echo $form->field($model, 'group_max_recipients') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
