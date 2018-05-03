<?php

use yii\db\Migration;

/**
 * Class m180429_133951_add_departmentId_to_section_table
 */
class m180429_133951_add_departmentId_to_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('section', 'departmentId', $this->integer()->notNull());

        $this->createIndex(
            'idx-section-departmentId',
            'section','departmentId'
        );
        $this->addForeignKey(
            'fk-section-department',
            'section','departmentId',
            'department','id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-section-department', 'section');
        $this->dropIndex('idx-section-departmentId', 'section');
        $this->dropColumn('section', 'departmentId');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180429_133951_add_departmentId_to_section_table cannot be reverted.\n";

        return false;
    }
    */
}
