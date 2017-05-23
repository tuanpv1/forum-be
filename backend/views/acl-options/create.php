<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AclOptions */

$this->title = 'Create Acl Options';
$this->params['breadcrumbs'][] = ['label' => 'Acl Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acl-options-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
