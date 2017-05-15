<?php

use yii\db\Migration;

class m170515_103227_create_table_kpi_sum extends Migration
{
    public function up()
    {
        $sql = <<<SQL
CREATE TABLE `kpi_sum` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `forum_id` INT NULL COMMENT '',
  `topic_id` INT NULL COMMENT '',
  `type` INT NOT NULL COMMENT '',
  `status` INT NOT NULL COMMENT '',
  `created_at` INT NULL COMMENT '',
  `updated_at` INT NULL COMMENT '',
  `post_id` INT NULL COMMENT '',
  `rate` INT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '');


SQL;
        $this->execute($sql);
    }

    public function down()
    {
        echo "m170515_103227_create_table_kpi_sum cannot be reverted.\n";

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
