<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PhpbbGroups */

$this->title = 'Update Phpbb Groups: ' . $model->group_id;
$this->params['breadcrumbs'][] = ['label' => 'Phpbb Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->group_id, 'url' => ['view', 'id' => $model->group_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="phpbb-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
