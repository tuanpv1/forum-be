<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PhpbbGroups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phpbb-groups-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'group_type')->textInput() ?>

    <?= $form->field($model, 'group_founder_manage')->textInput() ?>

    <?= $form->field($model, 'group_skip_auth')->textInput() ?>

    <?= $form->field($model, 'group_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'group_desc_bitfield')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_desc_options')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_desc_uid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_display')->textInput() ?>

    <?= $form->field($model, 'group_avatar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_avatar_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_avatar_width')->textInput() ?>

    <?= $form->field($model, 'group_avatar_height')->textInput() ?>

    <?= $form->field($model, 'group_rank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_colour')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_sig_chars')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_receive_pm')->textInput() ?>

    <?= $form->field($model, 'group_message_limit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_legend')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_max_recipients')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
