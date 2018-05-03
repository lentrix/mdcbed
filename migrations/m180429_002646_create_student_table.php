<?php

use yii\db\Migration;

/**
 * Handles the creation of table `student`.
 */
class m180429_002646_create_student_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('student', [
            'id' => $this->primaryKey(),
            'lrn' => $this->integer(),
            'lastName' => $this->string(60)->notNull(),
            'firstName' => $this->string(60)->notNull(),
            'middleName' => $this->string(60),
            'gender' => $this->string(1)->notNull(),
            'birthDate' => $this->date()->notNull(),
            'nationality' => $this->string(60),
            'religion' => $this->string(191),
            'fName' => $this->string(191), //fathers's name
            'fOccup' => $this->string(191), //father's occupation
            'fContact' => $this->string(60), //father's contact number
            'mName' => $this->string(191), //mother's name
            'mOccup' => $this->string(191), //mother's occupation
            'mContact' => $this->string(60), //mother's contact number
            'barangay' => $this->string(60),
            'town' => $this->string(60),
            'province' => $this->string(60),
            'prevSchool' => $this->string(255), //previous school attended
            'prvSchlAddr' => $this->string(255),
            'honors' => $this->string(191),
            'foodAllergies' => $this->string(191),
            'rc' => $this->boolean()->defaultValue(0), //Report Card
            'gmc' => $this->boolean()->defaultValue(0), //Good Moral Character
            'bc' => $this->boolean()->defaultValue(0), //Birth Certificate
            'pic' => $this->boolean()->defaultValue(0), //2pcs. 2x2 picture
            'entryDate' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('student');
    }
}
