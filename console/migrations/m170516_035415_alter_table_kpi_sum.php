<?php

use yii\db\Migration;

class m170516_035415_alter_table_kpi_sum extends Migration
{
    public function up()
    {
        $this->addColumn('kpi_sum','user_id','integer(11)');
    }

    public function down()
    {
        echo "m170516_035415_alter_table_kpi_sum cannot be reverted.\n";

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
