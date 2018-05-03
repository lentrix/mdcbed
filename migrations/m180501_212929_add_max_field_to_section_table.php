<?php

use yii\db\Migration;

/**
 * Class m180501_212929_add_max_field_to_section_table
 */
class m180501_212929_add_max_field_to_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('section', 'max', $this->integer()->notNull()->defaultValue(35));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('section', 'max');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180501_212929_add_max_field_to_section_table cannot be reverted.\n";

        return false;
    }
    */
}
