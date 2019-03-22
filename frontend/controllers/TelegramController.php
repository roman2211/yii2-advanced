<?php
namespace frontend\controllers;

use yii\base\Controller;
use Yii;

class TelegramController extends Controller
{

  public function actionIndex()
    {
      $data = "";
      try {
        $updates = Yii::$app->bot->getUpdates();
        foreach($updates as $update) {
          $user_id = $update->getMessage()->getFrom()->getId();
          Yii::$app->bot->sendMessage($user_id, 'Index action was requested!');
        }


      }
      catch (Exception $e) {
        $data = $e->getMessage();
      }

      var_dump($data);
    }

    public function actionSend()
    {
      \Yii::$app->bot->setProxy('socks5://50.242.136.220:1080');
      \Yii::$app->bot->sendMessage(465187094, 'Hello world!');
    }
}