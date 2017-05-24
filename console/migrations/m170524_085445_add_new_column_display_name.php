<?php

use yii\db\Migration;

class m170524_085445_add_new_column_display_name extends Migration
{
    public function up()
    {
        $this->addColumn('phpbb_acl_roles','display_name','varchar(250) default null');
    }

    public function down()
    {
        echo "m170524_085445_add_new_column_display_name cannot be reverted.\n";

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
