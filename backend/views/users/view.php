<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Quản lý Users', 'url' => ['index']];
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
                <div class="tabbable-custom ">
                    <ul class="nav nav-tabs ">
                        <li class="<?= ($active == 1) ? 'active' : '' ?>">
                            <a href="#tab1" data-toggle="tab" >
                                <?= Yii::t('app','Thông tin chung') ?></a>
                        </li>
                        <li class=" <?= ($active == 2) ? 'active' : '' ?>">
                            <a href="#tab2" data-toggle="tab" >
                                Phân nhóm quyền </a>
                        </li>
                        <li class=" <?= ($active == 3) ? 'active' : '' ?>">
                            <a href="#tab3" data-toggle="tab" >
                                Phân quyền chi tiết </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane <?= ($active == 1) ? 'active' : '' ?>" id="tab1">
                            <?=$this->render('_detail',['model'=>$model])?>
                        </div>
                        <div class="tab-pane <?= ($active == 2) ? 'active' : '' ?>" id="tab2">
                            <?=$this->render('_user_role',['model'=>$model])?>
                        </div>
                        <div class="tab-pane <?= ($active == 3) ? 'active' : '' ?>" id="tab3">
                            <?=$this->render('_user_option',['model'=>$model])?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
