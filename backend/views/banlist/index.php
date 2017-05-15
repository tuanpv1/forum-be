<?php

use common\models\Banlist;
use common\models\Users;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BanlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thành viên';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span
                        class="caption-subject font-green-sharp bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <p>
                    <?= Html::a('Thêm Banlist', ['create','type'=>$type], ['class' => 'btn btn-success']) ?>
                </p>
                <?php
                if($type == Banlist::TYPE_USER){
                    $column = [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'ban_userid',
                            'format' => 'raw',
                            'value' => function ($model, $key, $index, $widget) {
                                /**
                                 * @var $model \common\models\Banlist
                                 */
                                $username = $model->ban_userid?Users::findOne(['user_id'=>$model->ban_userid])->username:'';
                                $action = "users/view";
                                $res = Html::a('<kbd>' . $username . '</kbd>', [$action, 'id' => $model->ban_userid]);
                                return $res;
                            },
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'ban_start',
                            'value' => function ($model, $key, $index, $widget) {
                                return date('d/m/Y H:i:s', $model->ban_start);
                            }
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'ban_end',
                            'value' => function ($model, $key, $index, $widget) {
                                return date('d/m/Y H:i:s', $model->ban_end);
                            }
                        ],
                        ['class' => 'kartik\grid\ActionColumn',
                            'template' => '{view}',
                            'buttons'=>[
                                'view' => function ($url,$model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::toRoute(['banlist/view','id'=>$model->ban_id,'type'=>Banlist::TYPE_USER]), [
                                        'title' => ''.\Yii::t('app', 'Thông tin user'),
                                    ]);

                                },
                            ]
                        ],
                    ];
                }

                if($type == Banlist::TYPE_EMAIL){
                    $column = [
                        ['class' => 'yii\grid\SerialColumn'],
                        'ban_email:email',
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'ban_start',
                            'value' => function ($model, $key, $index, $widget) {
                                return date('d/m/Y H:i:s', $model->ban_start);
                            }
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'ban_end',
                            'value' => function ($model, $key, $index, $widget) {
                                return date('d/m/Y H:i:s', $model->ban_end);
                            }
                        ],
                        ['class' => 'kartik\grid\ActionColumn',
                            'template' => '{view}',
                            'buttons'=>[
                                'view' => function ($url,$model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::toRoute(['banlist/view','id'=>$model->ban_id,'type'=>Banlist::TYPE_USER]), [
                                        'title' => ''.\Yii::t('app', 'Thông tin user'),
                                    ]);

                                },
                            ]
                        ],
                    ];
                }
                if($type == Banlist::TYPE_IP){
                    $column = [
                        ['class' => 'yii\grid\SerialColumn'],
                        'ban_ip',
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'ban_start',
                            'value' => function ($model, $key, $index, $widget) {
                                return date('d/m/Y H:i:s', $model->ban_start);
                            }
                        ],
                        [
                            'class' => '\kartik\grid\DataColumn',
                            'attribute' => 'ban_end',
                            'value' => function ($model, $key, $index, $widget) {
                                return date('d/m/Y H:i:s', $model->ban_end);
                            }
                        ],
                        ['class' => 'kartik\grid\ActionColumn',
                            'template' => '{view}',
                            'buttons'=>[
                                'view' => function ($url,$model) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::toRoute(['banlist/view','id'=>$model->ban_id,'type'=>Banlist::TYPE_USER]), [
                                        'title' => ''.\Yii::t('app', 'Thông tin user'),
                                    ]);

                                },
                            ]
                        ],
                    ];
                }

                ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $column
                ]); ?>
            </div>
        </div>
    </div>
</div>

