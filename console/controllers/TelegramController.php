<?php

namespace console\controllers;

use SonkoDmitry\Yii\TelegramBot\Component;
use yii\console\Controller;
use common\models\tables\TelegramOffset;

class TelegramController extends Controller
{
  const PROJECT_CREATE_EVENT = 1;
  const PROJECT_UPDATE_EVENT = 2;

  private $bot;
  private $offset = 0;


  public function init()
  {
    parent::init();
    $this->bot = \Yii::$app->bot;
    $this->bot->setProxy('socks5://50.242.136.220:1080');
    /* $this->bot->setProxy('socks5://139.59.169.246:1080'); */
    
  }

  public function actionIndex() 
  {
      $updates = $this->bot->getUpdates($this->getOffset() + 1);
      $updCount = count($updates);
      if ($updCount > 0) {
        echo ("Новых сообщений {$updCount}\n" . PHP_EOL);
        foreach ($updates as $update) {
          $message = $update->getMessage(); 
          $messageText = $message->getText();
          $messageUserId = $message->getFrom()->getId();   
          $this->processCommand(
            $messageText,
            $messageUserId);
                 
          $this->updateOffset($update->getUpdateId(),$messageText, $messageUserId);
          
        }
      } else {
        echo ("Новых сообщений нет" . PHP_EOL);
      }

  }

  private function getOffset() {
    $max = TelegramOffset::find()
      ->select("id")
      ->max("id");
    if ($max > 0) {
      $this->offset = $max;
    }
    return $this->offset;
  }

  private function updateOffset(int $id, $message, $user_id) {
    (new TelegramOffset([
      'id' => $id,
      'timestamp' => date("Y-m-d h:i:s"),
      'message' => $message,
      'user_id' => $user_id,
    ]))->save();
    return $id;
  }

  private function processCommand(string $message, int $fromId) {
   // "/command Param1 Param2 Param3"
   $params = explode(" ", $message);
   $command = $params[0];
   unset($params[0]);
   $help ="Uknown command";
   switch($command) {
     case '/help':
      $help = "Доступные команды \n";
       $help .= "/subscribe_project_create %your login% - подписка на создание проектов \n";
       $help .= "/subscribe_project_update %your login% - подписка на обновления проектов \n";
       break;
   }
   \Yii::$app->bot->sendMessage($fromId, $help);
  }
}