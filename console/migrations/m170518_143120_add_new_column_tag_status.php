<?php

use yii\db\Migration;

class m170518_143120_add_new_column_tag_status extends Migration
{
    public function up()
    {
        $this->addColumn('phpbb_rh_topictags_tag','tag_status','int(11) default 0');
    }

    public function down()
    {
        echo "m170518_143120_add_new_column_tag_status cannot be reverted.\n";

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
