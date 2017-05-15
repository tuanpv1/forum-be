<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Banlist */

$this->title = 'Thêm Banlist';
$this->params['breadcrumbs'][] = ['label' => 'Thành Viên Banlist', 'url' => ['index','type'=>$type]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i><?= $this->title ?>
                </div>
            </div>
            <div class="portlet-body form">
                <?= $this->render('_form', [
                    'model' => $model,
                    'type' => $type
                ]) ?>
            </div>
        </div>
    </div>
</div>
