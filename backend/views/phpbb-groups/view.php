<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PhpbbGroups */

$this->title = $model->group_id;
$this->params['breadcrumbs'][] = ['label' => 'Phpbb Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phpbb-groups-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->group_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->group_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'group_id',
            'group_type',
            'group_founder_manage',
            'group_skip_auth',
            'group_name',
            'group_desc:ntext',
            'group_desc_bitfield',
            'group_desc_options',
            'group_desc_uid',
            'group_display',
            'group_avatar',
            'group_avatar_type',
            'group_avatar_width',
            'group_avatar_height',
            'group_rank',
            'group_colour',
            'group_sig_chars',
            'group_receive_pm',
            'group_message_limit',
            'group_legend',
            'group_max_recipients',
        ],
    ]) ?>

</div>
