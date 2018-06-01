<?php

use yii\db\Migration;

/**
 * Handles the creation of table `student_classes`.
 */
class m180531_114625_create_student_classes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('student_classes', [
            'id' => $this->primaryKey(),
            'studentId' => $this->integer()->notNull(),
            'classId' => $this->integer()->notNull(),
            'gp1' => $this->integer(2)->notNull(),
            'gp2' => $this->integer(2)->notNull(),
            'gp3' => $this->integer(2),
            'gp4' => $this->integer(2),
            'remarks' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('student_classes');
    }
}
