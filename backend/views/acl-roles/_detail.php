<?php
use common\models\Content;
use kartik\detail\DetailView;

/**
 * @var \common\models\AclRoles $model
 */
?>
<?php
$grid = [
    [
        'attribute' => 'role_name',
    ],
    [
        'attribute' => 'description',
        'format' => 'html',
        'value' => $model->description
    ],
];


$grid = array_merge($grid, $model->viewAttr);

?>
<?= DetailView::widget([
    'model' => $model,
    'condensed' => true,
    'hover' => true,
    'mode' => DetailView::MODE_VIEW,
    'labelColOptions' => ['style' => 'width: 20%'],
    'attributes' => $grid
]) ?>
