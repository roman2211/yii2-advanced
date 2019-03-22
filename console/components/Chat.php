<?php
namespace console\components;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Yii;
use common\models\tables\Users;


class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        echo "Server started\n";
    }

    public function onOpen(ConnectionInterface $conn)
    {

        $queryString = $conn->httpRequest->getUri()->getQuery();
        $channel = explode("=", $queryString)[1];

        $this->clients[$channel][$conn->resourceId] = $conn;
        echo "New connection: ({$conn->resourceId})\n"; 
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {

        $data = json_decode($msg, true);
        

        echo "{$from->resourceId} : {$data['message']}\n";
        try {
            $chatItem = new \common\models\tables\Chat($data);
            $isSaved = $chatItem->save();
            if ($isSaved) {
                echo "information saved\n";
            }             
        } catch (\Exception $e) {
            echo "ошибка при записи в базу данных\n";
            var_dump($e->getMessage());
        }


        foreach ($this->clients[$data['channel']] as $client) {
             $data['username'] = Users::findOne($data['user_id'])['username'];
            $data['created_at'] = \common\models\tables\Chat::findOne($chatItem['id'])['created_at'];
            var_dump($data['created_at']);

            $dataSend = json_encode($data);
            var_dump($dataSend);
            $client->send($dataSend);

        }

    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        unset($this->clients[$conn->resourceId]);
        echo "Connection {$conn->resourceId} closed\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: {$e->getMessage()}\n";

        $conn->close();
    }
}
