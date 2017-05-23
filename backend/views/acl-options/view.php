<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AclOptions */
/* @var $cat_selected array */
/* @var $imageProvider \yii\data\ArrayDataProvider */

$this->title = $model->auth_option;
$this->params['breadcrumbs'][] = ['label' => 'Chi tiết quyền', 'url' => Yii::$app->urlManager->createUrl(['acl-options/index'])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">Chi tiết quyền</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body">

                <div class="tabbable-custom nav-justified">
                    <ul class="nav nav-tabs nav-justified">
                        <div class="tab-pane" id="tab_info">
                            <?= $this->render('_detail', [
                                'model' => $model,
                            ]) ?>
                        </div>

                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
