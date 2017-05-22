<?php

use yii\db\Migration;

class m170521_052928_add_new_coulm_status_category extends Migration
{
    public function up()
    {
        $this->addColumn('phpbb_forums','forum_status_display','int(11) default 0');
    }

    public function down()
    {
        echo "m170521_052928_add_new_coulm_status_category cannot be reverted.\n";

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
