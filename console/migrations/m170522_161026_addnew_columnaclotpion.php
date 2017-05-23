<?php

use yii\db\Migration;

class m170522_161026_addnew_columnaclotpion extends Migration
{
    public function up()
    {
        $this->addColumn('phpbb_acl_options','description','text default null');
    }

    public function down()
    {
        echo "m170522_161026_addnew_columnaclotpion cannot be reverted.\n";

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
