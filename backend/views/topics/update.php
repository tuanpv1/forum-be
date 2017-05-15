<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Topics */

$this->title = Yii::t('app','Cập nhật chủ đề: ' ). ' ' . $model->topic_title;
$this->params['breadcrumbs'][] = ['label' => '/ Chủ đề / ', 'url' => Yii::$app->urlManager->createUrl(['topics/index'])];

$this->params['breadcrumbs'][] = ['label' => $model->topic_title, 'url' => ['view', 'id' => $model->topic_id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>



<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase"><?= Yii::t('app','Thông tin chủ đề') ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <?= $this->render('_form', [
                    'model' => $model,
                    'selectedCats' => $selectedCats,
                ]) ?>
            </div>

        </div>
    </div>
</div>
