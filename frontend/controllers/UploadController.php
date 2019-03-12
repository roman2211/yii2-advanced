<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Upload;
use yii\web\UploadedFile;

class UploadController extends Controller 
{

  public function actionIndex($model)
  {
     $model = new Upload();

    if (Yii::$app->request->isPost) {
      $model->file = UploadedFile::getInstance($model, 'file');
      if ($model->run()) {
        return true;
      }
      else {
        return false;
      };

    }

     return $this->render('index', ['model' => $model]);
 
  }

  public function actionLang()
  {
    \Yii::$app->language = 'en';
    echo \Yii::t("app", "error", ['number' => 404]);
  
    exit;
  }




}