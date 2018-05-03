<?php

use yii\db\Migration;

/**
 * Handles the creation of table `enrol`.
 */
class m180501_004823_create_enrol_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('enrol', [
            'id' => $this->primaryKey(),
            'studentId' => $this->integer()->notNull(),
            'levelId' => $this->integer()->notNull(),
            'periodId' => $this->integer()->notNull(),
            'sectionId' => $this->integer(),
            'dateEnrolled' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'status' => $this->integer()->defaultValue(1)
        ]);

        $this->createIndex(
            'idx-enrol-studentId','enrol','studentId'
        );
        $this->addForeignKey(
            'fk-enrol-student','enrol','studentId','student','id'
        );

        $this->createIndex(
            'idx-enrol-levelId','enrol','levelId'
        );
        $this->addForeignKey(
            'fk-enrol-level','enrol','levelId','level','id'
        );

        $this->createIndex(
            'idx-enrol-periodId','enrol','periodId'
        );
        $this->addForeignKey(
            'fk-enrol-period','enrol','periodId','period','id'
        );

        $this->createIndex(
            'idx-enrol-sectionId','enrol','sectionId'
        );
        $this->addForeignKey(
            'fk-enrol-section','enrol','sectionId','section','id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-enrol-section', 'enrol');
        $this->dropForeignKey('fk-enrol-period', 'enrol');
        $this->dropForeignKey('fk-enrol-level', 'enrol');
        $this->dropForeignKey('fk-enrol-student', 'enrol');
        $this->dropIndex('idx-enrol-sectionId', 'enrol');
        $this->dropIndex('idx-enrol-periodId', 'enrol');
        $this->dropIndex('idx-enrol-levelId', 'enrol');
        $this->dropIndex('idx-enrol-studentId', 'enrol');
        
        $this->dropTable('enrol');
    }
}
