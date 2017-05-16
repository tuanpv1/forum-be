<?php

use yii\db\Migration;

class m170516_042733_add_new_column_post_status_display extends Migration
{
    public function up()
    {
        $this->addColumn('phpbb_posts','post_status_display','int(11) default 0');
    }

    public function down()
    {
        echo "m170516_042733_add_new_column_post_status_display cannot be reverted.\n";

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
