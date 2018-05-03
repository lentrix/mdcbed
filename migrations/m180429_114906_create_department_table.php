<?php

use yii\db\Migration;

/**
 * Handles the creation of table `department`.
 */
class m180429_114906_create_department_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('department', [
            'id' => $this->primaryKey(),
            'shortName' => $this->string(20)->notNull(),
            'longName' => $this->string(191)->notNull(),
            'remarks' => $this->string(191)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('department');
    }
}
