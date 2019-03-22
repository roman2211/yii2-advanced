<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?=Html::encode($this->title)?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=Html::a('Create Tasks', ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <? Pjax::begin();?>
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'name',
        'description:ntext',
        'responsible_id',
        'date',
        //'status_id',
        //'created_at',
        //'updated_at',

        ['class' => 'yii\grid\ActionColumn'],
    ],
    ]);?>
    <? Pjax::end();?>
</div>
