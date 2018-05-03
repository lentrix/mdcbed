<?php

use yii\db\Migration;

/**
 * Handles the creation of table `section`.
 */
class m180406_122040_create_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('section', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->notNull(),
            'levelId' => $this->integer()->notNull(),
            'teacherId' => $this->integer(),
            'periodId' => $this->integer(),
            'homeRoom' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-section-homeRoom',
            'section','homeRoom'
        );
        $this->addForeignKey(
            'fk-section-venue',
            'section','homeRoom',
            'venue','id'
        );

        $this->createIndex(
            'idx-section-periodId',
            'section','periodId'
        );
        $this->addForeignKey(
            'fk-section-period',
            'section','periodId',
            'period','id'
        );

        $this->createIndex(
            'idx-section-levelId',
            'section',
            'levelId'
        );
        $this->addForeignKey(
            'fk-section-level',
            'section',
            'levelId',
            'level',
            'id'
        );

        $this->createIndex(
            'idx-section-teacherId',
            'section',
            'teacherId'
        );
        $this->addForeignKey(
            'fk-section-teacher',
            'section',
            'teacherId',
            'teacher',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-section-level', 'section');
        $this->dropForeignKey('fk-section-teacher', 'section');
        $this->dropForeignKey('fk-section-period', 'section');
        $this->dropForeignKey('fk-section-venue', 'section');
        $this->dropIndex('idx-section-levelId', 'section');
        $this->dropIndex('idx-section-teacherId', 'section');
        $this->dropIndex('idx-section-periodId', 'section');
        $this->dropIndex('idx-section-homeRoom', 'section');
        $this->dropTable('section');
    }
}
