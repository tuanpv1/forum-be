<?php

use yii\db\Migration;

/**
 * Handles adding updated_at to table `phpbb_user`.
 */
class m170606_225721_add_updated_at_column_to_phpbb_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('phpbb_users', 'updated_at', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('phpbb_users', 'updated_at');
    }
}
