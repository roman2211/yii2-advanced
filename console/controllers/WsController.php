<?php

namespace console\controllers;

use yii\console\Controller;
use console\components\Chat;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;


class WsController extends Controller
{
  public function actionIndex()
  {
    $server = IoServer::factory(
      new HttpServer(
          new WsServer(
              new Chat()
          )
      ),8080
  );

  $server->run();
  }

}