<?php
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 5/12/2017
 * Time: 6:33 AM
 */
use common\models\Groups;
use common\models\Users;
use kartik\detail\DetailView;
use kartik\helpers\Html;

/* @var $model common\models\Users */

?>
<div class="portlet-body form">
    <div class="form-actions">
        <div class="row" style="margin-left: 20px">
            <?= Html::a(Yii::t('app', 'Cập nhật'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Ban'), ['update', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
            <?= Html::a(Yii::t('app', 'Hủy thao tác'), ['index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'username',
            'user_email:email',
            [
                'attribute' => 'user_type',
                'format' => 'raw',
                'value' => ($model->status == Users::USER_TYPE_ACTIVE) ?
                    '<span class="label label-success">' . $model->getStatusName() . '</span>' :
                    '<span class="label label-danger">' . $model->getStatusName() . '</span>',
                'type' => DetailView::INPUT_SWITCH,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'onText' => 'Active',
                        'offText' => 'Delete',
                    ]
                ]
            ],
            [
                'attribute' => 'group_id',
                'value' => Groups::findOne($model->group_id)->group_name,
            ],
            'user_ip',
            [
                'attribute' => 'user_regdate',
                'value' => date('d/m/Y H:i:s', $model->user_regdate),
            ],
            [
                'attribute' => 'user_lastvisit',
                'value' => date('d/m/Y H:i:s', $model->user_lastvisit),
            ],
            [
                'attribute' => 'user_birthday',
                'value' => $model->user_birthday ? date('d/m/Y H:i:s', $model->user_birthday) : 'Chưa cập nhật',
            ],
            [
                'attribute' => 'user_lastpost_time',
                'value' => date('d/m/Y H:i:s', $model->user_lastpost_time),
            ],
            'user_lastpage',
            [
                'attribute' => 'user_warnings',
                'value' => $model->user_warnings ? $model->user_warnings : 'Chưa bị cảnh báo',
            ],
            [
                'attribute' => 'user_lastpost_time',
                'value' => date('d/m/Y H:i:s', $model->user_lastpost_time),
            ],
            'user_warnings',
            'user_last_warning',
            'user_inactive_reason',
            [
                'attribute' => 'user_inactive_time',
                'value' => date('d/m/Y H:i:s', $model->user_inactive_time),
            ],
            'user_posts',
            'user_lang',
            'user_timezone',
            'user_dateformat',
            'user_notify',
            'user_notify_pm',
            'user_notify_type',
            'user_allow_pm',
            'user_allow_viewonline',
            'user_allow_viewemail:email',
            'user_allow_massemail:email',
            'user_sig:ntext',
            'user_new',
        ],
    ]) ?>
</div>
