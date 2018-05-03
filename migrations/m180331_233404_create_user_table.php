<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180331_233404_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(45)->unique()->notNull(),
            'password' => $this->string()->notNull(),
            'fullName' => $this->string(191)->notNull(),
            'authKey' => $this->string(100),
            'accessToken' => $this->string(100),
            'role' => $this->integer(3)->notNull(),
            'active' => $this->boolean()->defaultValue(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
