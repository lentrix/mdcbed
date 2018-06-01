<?php

use yii\db\Migration;

/**
 * Handles the creation of table `student_classes`.
 * Has foreign keys to the tables:
 *
 * - `student`
 * - `classes`
 */
class m180601_003333_create_junction_table_for_student_and_classes_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('student_classes', [
            'student_id' => $this->integer(),
            'classes_id' => $this->integer(),
            'gp1' => $this->decimal(2),
            'gp2' => $this->decimal(2),
            'gp3' => $this->decimal(2),
            'gp4' => $this->decimal(2),
            'notes' => $this->text(),
            'remarks' => $this->string(45),
            'PRIMARY KEY(student_id, classes_id)',
        ]);

        // creates index for column `student_id`
        $this->createIndex(
            'idx-student_classes-student_id',
            'student_classes',
            'student_id'
        );

        // add foreign key for table `student`
        $this->addForeignKey(
            'fk-student_classes-student_id',
            'student_classes',
            'student_id',
            'student',
            'id',
            'CASCADE'
        );

        // creates index for column `classes_id`
        $this->createIndex(
            'idx-student_classes-classes_id',
            'student_classes',
            'classes_id'
        );

        // add foreign key for table `classes`
        $this->addForeignKey(
            'fk-student_classes-classes_id',
            'student_classes',
            'classes_id',
            'classes',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `student`
        $this->dropForeignKey(
            'fk-student_classes-student_id',
            'student_classes'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            'idx-student_classes-student_id',
            'student_classes'
        );

        // drops foreign key for table `classes`
        $this->dropForeignKey(
            'fk-student_classes-classes_id',
            'student_classes'
        );

        // drops index for column `classes_id`
        $this->dropIndex(
            'idx-student_classes-classes_id',
            'student_classes'
        );

        $this->dropTable('student_classes');
    }
}
