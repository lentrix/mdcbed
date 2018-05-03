<?php

use yii\db\Migration;

/**
 * Handles the creation of table `program`.
 */
class m180501_004412_create_program_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('program', [
            'id' => $this->primaryKey(),
            'shortName' => $this->string(25),
            'longName' => $this->string(191),
            'departmentId' => $this->integer()->notNull(),
            'remarks' => $this->string(191),
            'active' => $this->boolean()->defaultValue(1),
        ]);

        $this->createIndex('idx-program-departmentId','program','departmentId');
        $this->addForeignKey('fk-program-department','program','departmentId','department','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-program-department','program');
        $this->dropIndex('idx-program-departmentId','program');
        $this->dropTable('program');
    }
}
