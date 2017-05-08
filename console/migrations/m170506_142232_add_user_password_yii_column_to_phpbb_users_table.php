<?php

use yii\db\Migration;

/**
 * Handles adding user_password_yii to table `phpbb_users`.
 */
class m170506_142232_add_user_password_yii_column_to_phpbb_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('phpbb_users', 'user_password_yii', $this->string());
        $this->addColumn('phpbb_users', 'auth_key', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('phpbb_users', 'user_password_yii');
    }
}
