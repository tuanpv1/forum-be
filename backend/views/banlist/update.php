<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Banlist */

$this->title = 'Update Banlist: ' . $model->ban_id;
$this->params['breadcrumbs'][] = ['label' => 'Banlists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ban_id, 'url' => ['view', 'id' => $model->ban_id]];
$this->params['breadcrumbs'][] = 'Update';
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
