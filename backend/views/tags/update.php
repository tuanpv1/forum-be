<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tags */

$this->title = Yii::t('app','Cập nhật tag: ' ). ' ' . $model->tag;
$this->params['breadcrumbs'][] = ['label' => '/ Tag / ', 'url' => Yii::$app->urlManager->createUrl(['tags/index'])];

$this->params['breadcrumbs'][] = ['label' => $model->tag, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>



<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase"><?= Yii::t('app','Thông tin tag') ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>

        </div>
    </div>
</div>
