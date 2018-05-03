<?php

use yii\db\Migration;

/**
 * Handles the creation of table `venue`.
 */
class m180405_114829_create_venue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('venue', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->notNull(),
            'capacity' => $this->integer(2)->notNull(),
            'active' => $this->boolean()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('venue');
    }
}
