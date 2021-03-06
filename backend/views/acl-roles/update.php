<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AclRoles */

$this->title = 'Cập nhật nhóm quyền';
$this->params['breadcrumbs'][] = ['label' => 'Nhóm quyền ', 'url' => Yii::$app->urlManager->createUrl(['/acl-roles/index'])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Cập nhật nhóm quyền
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
