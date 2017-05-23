<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AclRoles */

$this->title = 'Create Acl Roles';
$this->params['breadcrumbs'][] = ['label' => 'Acl Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acl-roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
