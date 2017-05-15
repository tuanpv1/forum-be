<?php

use common\models\Banlist;
use kartik\widgets\DatePicker;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\models\Users;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Banlist */
/* @var $form yii\widgets\ActiveForm */
$time_select = Html::getInputId($model, 'select_time');
$time_until = Banlist::TIME_UNTIL;
$js = <<<JS
    $("#$time_select").change(function () {
        var time_select_change = $('#$time_select').val();
        if(time_select_change == {$time_until}){
            $('#id_time_input').show();
        }else {
            $('#id_time_input').hide();
        }
        //}
    });
JS;
$js_default = <<<JS
    var time_select_change = $('#$time_select').val();
    if(time_select_change == {$time_until}){
        $('#id_time_input').show();
    }else {
        $('#id_time_input').hide();
    }
JS;

$this->registerJs($js_default, \yii\web\View::POS_READY);
$this->registerJs($js, \yii\web\View::POS_READY);
?>

<div class="form-body">

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 12,
        'formConfig' => [
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'showLabels' => true,
            'labelSpan' => 2,
            'deviceSize' => ActiveForm::SIZE_SMALL,
        ],
    ]); ?>
    <?php if($type == Banlist::TYPE_EMAIL) { ?>
        <?= $form->field($model, 'ban_email')->textarea(['row'=>8]) ?>
    <?php } if($type == Banlist::TYPE_USER){ ?>
        <?= $form->field($model, 'all_user_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Users::find()->andWhere(['user_type'=>Users::USER_TYPE_ACTIVE])->all(), 'user_id', 'username'),
            'options' => [
                'placeholder' => 'Chọn thành viên','multiple' => true
            ],
            'pluginOptions' => [
                'allowClear' => true,

            ],
        ]);
        ?>
    <?php } if($type == Banlist::TYPE_IP){ ?>
        <?= $form->field($model, 'ban_ip')->textarea(['row'=>8]) ?>
    <?php } ?>


    <?= $form->field($model, 'select_time')->dropDownList(Banlist::selectTimeBan()) ?>

    <div id="id_time_input">
        <?= $form->field($model, 'input_until_time')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Chọn ngày'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-mm-yyyy',
                'todayHighlight' => true,
            ]
        ]);
        ?>
    </div>

    <?= $form->field($model, 'ban_reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ban_give_reason')->textInput(['maxlength' => true]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Hủy', ['index','type'=>$type], ['class' => 'btn btn-default', 'data-dismiss'=> 'modal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
