<?php

use common\models\Banlist;
use common\models\Users;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Banlist */

$this->title = $model->ban_id;
$this->params['breadcrumbs'][] = ['label' => 'Banlists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase"> <?= $this->title;?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>

                </div>
            </div>
            <div class="portlet-body">
                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->ban_id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->ban_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?php
                if($type == Banlist::TYPE_USER){
                   $attribute = [
                       'ban_id',
                       [
                           'attribute' => 'ban_userid',
                           'value' => $model->ban_userid!=0?Users::findOne($model->ban_userid)->username:'',
                       ],
                       [
                           'attribute' => 'ban_start',
                           'value' => date('d/m/Y H:i:s', $model->ban_start),
                       ],
                       [
                           'attribute' => 'ban_end',
                           'value' => date('d/m/Y H:i:s', $model->ban_end),
                       ],
                       'ban_exclude',
                       'ban_reason',
                       'ban_give_reason',
                   ];
                }
                if($type == Banlist::TYPE_EMAIL){
                   $attribute = [
                       'ban_id',
                       'ban_email:email',
                       [
                           'attribute' => 'ban_start',
                           'value' => date('d/m/Y H:i:s', $model->ban_start),
                       ],
                       [
                           'attribute' => 'ban_end',
                           'value' => date('d/m/Y H:i:s', $model->ban_end),
                       ],
                       'ban_exclude',
                       'ban_reason',
                       'ban_give_reason',
                   ];
                }
                if($type == Banlist::TYPE_IP){
                   $attribute = [
                       'ban_id',
                       'ban_ip',
                       [
                           'attribute' => 'ban_start',
                           'value' => date('d/m/Y H:i:s', $model->ban_start),
                       ],
                       [
                           'attribute' => 'ban_end',
                           'value' => date('d/m/Y H:i:s', $model->ban_end),
                       ],
                       'ban_exclude',
                       'ban_reason',
                       'ban_give_reason',
                   ];
                }
                ?>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => $attribute,
                ]) ?>
            </div>
        </div>
    </div>
</div>
