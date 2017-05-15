<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BanlistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banlist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ban_id') ?>

    <?= $form->field($model, 'ban_userid') ?>

    <?= $form->field($model, 'ban_ip') ?>

    <?= $form->field($model, 'ban_email') ?>

    <?= $form->field($model, 'ban_start') ?>

    <?php // echo $form->field($model, 'ban_end') ?>

    <?php // echo $form->field($model, 'ban_exclude') ?>

    <?php // echo $form->field($model, 'ban_reason') ?>

    <?php // echo $form->field($model, 'ban_give_reason') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
