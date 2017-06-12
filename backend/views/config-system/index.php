<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ConfigSystemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Config Systems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-system-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Config System', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number_like_postive',
            'number_answer_postive',
            'number_answer_negative',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
