<?php

use yii\db\Migration;

class m170524_090013_add_new_column_status extends Migration
{
    public function up()
    {
        $this->addColumn('phpbb_acl_roles','status','int(11) default 0');
    }

    public function down()
    {
        echo "m170524_090013_add_new_column_status cannot be reverted.\n";

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
