<?php

use yii\db\Migration;

/**
 * Handles the creation of table `phpbb_report_user`.
 */
class m170606_224957_create_phpbb_report_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('phpbb_report_user', [
            'id' => $this->primaryKey(),
            'date_report' => $this->integer(),
            'total_user' => $this->integer(),
            'user_ban' => $this->integer(),
            'user_register' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('phpbb_report_user');
    }
}
