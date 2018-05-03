<?php

use yii\db\Migration;

/**
 * Handles the creation of table `classes`.
 */
class m180407_134802_create_classes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('classes', [
            'id' => $this->primaryKey(),
            'subject' => $this->string(45)->notNull(),
            'start' => $this->time(),
            'end' => $this->time(),
            'day' => $this->string(15),
            'sectionId' => $this->integer()->notNull(),
            'venueId' => $this->integer()->notNull(),
            'teacherId' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-classes-sectionId',
            'classes',
            'sectionId'
        );
        $this->addForeignKey(
            'fk-classes-section',
            'classes', 'sectionId',
            'section','id'
        );

        $this->createIndex(
            'idx-classes-venueId',
            'classes',
            'venueId'
        );
        $this->addForeignKey(
            'fk-classes-venue',
            'classes', 'venueId',
            'venue','id'
        );

        $this->createIndex(
            'idx-classes-teacherId',
            'classes',
            'teacherId'
        );
        $this->addForeignKey(
            'fk-classes-teacher',
            'classes', 'teacherId',
            'teacher','id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-classes-venue', 'classes');
        $this->dropForeignKey('fk-classes-teacher', 'classes');
        $this->dropForeignKey('fk-classes-section', 'classes');
        $this->dropIndex('idx-classes-teacherId', 'classes');
        $this->dropIndex('idx-classes-venueId', 'classes');
        $this->dropIndex('idx-classes-sectionId', 'classes');
        $this->dropTable('classes');
    }
}

