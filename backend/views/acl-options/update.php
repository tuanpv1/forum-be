<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AclOptions */

$this->title = 'Cập nhật chi tiết';
$this->params['breadcrumbs'][] = ['label' => 'Quyền ', 'url' => Yii::$app->urlManager->createUrl(['/acl-options/index'])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Cập nhật chi tiết quyền
                </div>
            </div>
            <div class="portlet-body form">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>
