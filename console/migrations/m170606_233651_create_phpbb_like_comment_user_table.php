<?php

use yii\db\Migration;

/**
 * Handles the creation of table `phpbb_like_comment_user`.
 */
class m170606_233651_create_phpbb_like_comment_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('phpbb_like_comment_user', [
            'id' => $this->primaryKey(),
            'date_report'=>$this->integer(),
            'user_id' => $this->integer(),
            'like_count' => $this->integer(),
            'answer_true' => $this->integer(),
            'answer_false' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('phpbb_like_comment_user');
    }
}
