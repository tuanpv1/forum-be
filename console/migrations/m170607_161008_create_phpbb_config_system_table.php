<?php

use yii\db\Migration;

/**
 * Handles the creation of table `phpbb_config_system`.
 */
class m170607_161008_create_phpbb_config_system_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('phpbb_config_system', [
            'id' => $this->primaryKey(),
            'number_like_postive' => $this->integer(),
            'number_answer_postive' => $this->integer(),
            'number_answer_negative' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('phpbb_config_system');
    }
}
