<?php

use frontend\assets\TaskAsset;

TaskAsset::register($this);

echo $this->render('_search', ['model' => $searchModel]); 

echo yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function($model) {
        return \frontend\widgets\TaskPreview::widget(['model' => $model]);
    },
    'summary' => false,
    'options' => [
        'class' => 'preview-container'
    ]
]);


