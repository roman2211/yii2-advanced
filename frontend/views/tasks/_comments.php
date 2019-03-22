<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\tables\Users;
use yii\helpers\Url;
use frontend\assets\TaskOneAsset;
use yii\widgets\Pjax;

TaskOneAsset::register($this);


/* @var $this yii\web\View */
/* @var $model common\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="form_comments">
    <h3>Комментарии</h3>
    <?php Pjax::begin(['id' => 'comments']);?>
    <?php $formComments = ActiveForm::begin(
        [
        'action' => Url::to(['tasks/add-comment']),
        'options' => ['data' => ['pjax' => true]],
        ]        
        );?>
    <?= $formComments->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false);?>
    <?= $formComments->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false); ?>
    <?= $formComments->field($taskCommentForm, 'comment')->textInput(); ?>
    <?= Html::submitButton("Add", ['class' => 'btn btn-default']); ?>
    <?php ActiveForm::end() ?>
   
   
    <hr>
    <div class="comment-history">
       
   
        <?php foreach($model->comments as $comment): ?>
            <p><strong><?= $comment->user->username?></strong>: <?= $comment->comment ?> </p>
        <?php endforeach;?>
    </div> 

    <?php Pjax::end();?>
    
    
  


</div>
