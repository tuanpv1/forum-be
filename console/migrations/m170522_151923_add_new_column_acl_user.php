<?php

use yii\db\Migration;

class m170522_151923_add_new_column_acl_user extends Migration
{
    public function up()
    {
        $this->addColumn('phpbb_acl_roles','description','text default null');
    }

    public function down()
    {
        echo "m170522_151923_add_new_column_acl_user cannot be reverted.\n";

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
