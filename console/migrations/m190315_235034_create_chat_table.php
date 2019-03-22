<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat}}`.
 */
class m190315_235034_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat}}', [
            'id' => $this->primaryKey(),
            'channel' => $this->string(),
            'message' => $this->string(),
            'user_id' => $this->integer(),
            'created_at' => 'datetime DEFAULT NOW()', 
        ]);

        $this->addForeignKey('fk_chat_users_foreign', '{{%chat}}', 'user_id', 'users', 'id' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_users_foreign', '{{%chat}}');
        $this->dropTable('{{%chat}}');
    }
}
