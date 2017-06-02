<?php

use yii\db\Migration;

class m170530_134644_add_column_group extends Migration
{
    public function up()
    {
        $this->addColumn('phpbb_groups','group_display_name','varchar(255)');
    }

    public function down()
    {
        echo "m170530_134644_add_column_group cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
