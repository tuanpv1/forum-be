<?php
use kartik\detail\DetailView;

/**
 * @var \common\models\Tags $model
 */
?>
<?php
$grid = [
    [
        'attribute' => 'tag',
    ],
    [
        'attribute' => 'tag_status',
        'format' => 'html',
        'value' => "<span class='" . $model->getCssStatus() . "'>" . $model->getStatusName() . "</span>"
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
