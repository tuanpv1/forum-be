<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PhpbbGroups */

$this->title = 'Create Phpbb Groups';
$this->params['breadcrumbs'][] = ['label' => 'Phpbb Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phpbb-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
