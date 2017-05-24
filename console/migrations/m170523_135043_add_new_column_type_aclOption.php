<?php

use yii\db\Migration;

class m170523_135043_add_new_column_type_aclOption extends Migration
{
    public function up()
    {
        $this->addColumn('phpbb_acl_options','type','int(11) default 0');
    }

    public function down()
    {
        echo "m170523_135043_add_new_column_type_aclOption cannot be reverted.\n";

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
