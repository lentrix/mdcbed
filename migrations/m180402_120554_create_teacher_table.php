<?php

use yii\db\Migration;

/**
 * Handles the creation of table `teacher`.
 */
class m180402_120554_create_teacher_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('teacher', [
            'id' => $this->primaryKey(),
            'lastName' => $this->string(90)->notNull(),
            'firstName' => $this->string(90)->notNull(),
            'phone' => $this->string(15),
            'specialization' => $this->string(90),
            'userId' => $this->integer(),
            'active' => $this->boolean()->defaultValue(1),
        ]);

        $this->createIndex(
            'idx-teacher-userId',
            'teacher',
            'userId'
        );
        $this->addForeignKey(
            'fk-teacher-user',
            'teacher',
            'userId',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-teacher-user', 'teacher');
        $this->dropIndex('idx-teacher-userId', 'teacher');
        $this->dropTable('teacher');
    }
}
