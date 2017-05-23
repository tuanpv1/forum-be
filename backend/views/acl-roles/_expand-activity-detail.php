<?php

use common\models\UserActivity;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AclRoles */

?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'role_description',
            'format' => 'html',
            'value' => $model->getAclRolesOptionData()

        ],
    ],
]) ?>
