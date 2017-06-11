<?php
/**
 * Created by PhpStorm.
 * User: TuanPV
 * Date: 6/8/2017
 * Time: 7:24 PM
 */
use common\models\Forums;
use common\models\Topics;
use kartik\grid\GridView;

/**  @var $model \common\models\ReportTopics */
$gridColumns =[
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'forum_id',
        'label'=>'Tên danh mục',
        'value' => function ($model) {
            return Forums::findOne(['forum_id'=>$model->forum_id])->forum_name;
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'topic_id',
        'label'=>'Tên bài viết',
        'value' => function ($model) {
            return Topics::findOne(['topic_id'=>$model->topic_id])->topic_title;
        },
    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'total_post',
        'value' => function ($model) {
            return $model->total_post;
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'like_count',
        'value' => function ($model) {
            return $model->like_count;
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'view_count',
        'value' => function ($model) {
            return $model->view_count;
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'rate_count',
        'value' => function ($model) {
            return $model->rate_count;
        },
    ],
];
?>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'responsive' => true,
    'pjax' => true,
    'hover' => true,
    'columns' => $gridColumns,
]);
?>

