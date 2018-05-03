<?php

use yii\db\Migration;

/**
 * Class m180429_130357_add_departmentId_field_to_teacher_table
 */
class m180429_130357_add_departmentId_field_to_teacher_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('teacher', 'departmentId', $this->integer());

        $this->createIndex(
            'idx-teacher-departmentId',
            'teacher', 'departmentId'
        );
        $this->addForeignKey(
            'fk-teacher-department',
            'teacher','departmentId',
            'department', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-teacher-department', 'teacher');
        $this->dropIndex('idx-teacher-departmentId', 'teacher');
        $this->dropColumn('teacher', 'departmentId');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180429_130357_add_departmentId_field_to_teacher_table cannot be reverted.\n";

        return false;
    }
    */
}
