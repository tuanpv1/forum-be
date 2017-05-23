<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AclOptionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acl-options-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'auth_option_id') ?>

    <?= $form->field($model, 'auth_option') ?>

    <?= $form->field($model, 'is_global') ?>

    <?= $form->field($model, 'is_local') ?>

    <?= $form->field($model, 'founder_only') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
