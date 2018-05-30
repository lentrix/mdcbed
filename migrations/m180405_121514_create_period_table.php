<?php

use yii\db\Migration;

/**
 * Handles the creation of table `period`.
 */
class m180405_121514_create_period_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('period', [
            'id' => $this->primaryKey(),
            'shortName' => $this->string(45)->notNull(),
            'longName' => $this->string(200)->notNull(),
            'start' => $this->date()->notNull(),
            'end' => $this->date()->notNull(),
            'type' => $this->boolean()->notNull(),//0->Annual, 1->semestral
            'phase' => $this->integer(1)->notNull()->defaultValue(0), // 0->enrolment, 1->q1,2->q2,3->q3,4->q4
            'active' => $this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('period');
    }
}
