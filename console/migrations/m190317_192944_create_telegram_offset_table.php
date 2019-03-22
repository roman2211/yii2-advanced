<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%telegram_offset}}`.
 */
class m190317_192944_create_telegram_offset_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%telegram_offset}}', [
            'id' => $this->integer(),
            'timestamp' => $this->timestamp(),
            'message' => $this->text(),
            'user_id' => $this->integer(),            

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%telegram_offset}}');
    }
}
