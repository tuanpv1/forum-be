<?php
use common\models\Content;
use kartik\detail\DetailView;

/**
 * @var \common\models\Posts $model
 */
?>
<?php
$grid = [
    [
        'attribute' => 'post_subject',
    ],
    [
        'attribute' => 'post_text',
        'format' => 'html',
        'value' => \common\models\Posts::find()->andWhere(['topic_id' => $model->topic_id])->orderBy(['post_id' => SORT_ASC])->one()->post_text
    ],
    [
        'attribute' => 'post_status_display',
        'format' => 'html',
        'value' => "<span class='" . $model->getCssStatus() . "'>" . $model->getStatusName() . "</span>"
    ],
    [
        'attribute' => 'post_time',
        // 'label' => 'Ngày tạo',
        'value' => date('d-m-Y H:i:s', $model->post_time)
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
