<?php

use yii\db\Migration;

/**
 * Handles the creation of table `phpbb_report_user_positive`.
 */
class m170606_225608_create_phpbb_report_user_positive_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('phpbb_report_user_positive', [
            'id' => $this->primaryKey(),
            'date_report' => $this->integer(),
            'user_positive_id' => $this->text(),
            'user_negative_id' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('phpbb_report_user_positive');
    }
}
