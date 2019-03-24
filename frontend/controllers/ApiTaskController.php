<?php

namespace frontend\controllers;

use yii\rest\ActiveController;
use common\models\tables\Tasks;
use \yii\filters\auth\HttpBasicAuth;
use common\models\User;
use yii\data\ActiveDataProvider;

class ApiTaskController extends ActiveController
{
  public $modelClass = Tasks::class;

public function behaviors()
{
  $behaviors = parent::behaviors();
/*   $behaviors['authentificator'] = [
    'class' => HttpBasicAuth::class,
    'auth' => function($username, $password) {
      $user = User::findByUsername($username);
      if ($user && $user->validatePassword($password)) {
        return $user;
      }
      return null;
    }
  ]; */
  return $behaviors;
}

public function actions()
{
  $actions = parent::actions();
  unset($actions['index']);
  return $actions;
}

public function actionIndex()
{

  $query = Tasks::find();
  return new ActiveDataProvider([
    'query' => $query,
  ]);
}

public function actionResponsible($id)
{
  var_dump($id);
  $query = Tasks::find()->with('user')->where(['responsible_id'=>$id])->one();
  return new ActiveDataProvider([
    'query' => $query,
  ]);
}


}