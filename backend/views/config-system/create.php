<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ConfigSystem */

$this->title = 'Khởi tạo thông số';
$this->params['breadcrumbs'][] = ['label' => 'Config Systems', 'url' => ['index']];
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
                ]) ?>
            </div>
        </div>
    </div>
</div>
