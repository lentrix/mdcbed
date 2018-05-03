<?php

use yii\db\Migration;

/**
 * Handles the creation of table `level`.
 */
class m180402_203350_create_level_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('level', [
            'id' => $this->primaryKey(),
            'longName' => $this->string(45)->notNull(),
            'shortName' => $this->string(200)->notNull(),
            'category' => $this->string(5)->notNull(),
            'nextLevelId'=> $this->integer(),
            'previousLevelId' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('level');
    }
}
