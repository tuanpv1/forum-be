<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\ConfigSystem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-body">

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'action'=>$model->isNewRecord ?Url::to(['config-system/create']):Url::to(['config-system/update','id'=>$model->id]),
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 12,
        'formConfig' => [
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'showLabels' => true,
            'labelSpan' => 6,
            'deviceSize' => ActiveForm::SIZE_SMALL,
        ],
    ]); ?>

    <?= $form->field($model, 'number_like_postive')->textInput() ?>

    <?= $form->field($model, 'number_answer_postive')->textInput() ?>

    <?= $form->field($model, 'number_answer_negative')->textInput() ?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Hủy', ['view'], ['class' => 'btn btn-default', 'data-dismiss'=> 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
