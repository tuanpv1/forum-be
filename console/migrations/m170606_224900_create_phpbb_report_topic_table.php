<?php

use yii\db\Migration;

/**
 * Handles the creation of table `phpbb_report_topic`.
 */
class m170606_224900_create_phpbb_report_topic_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('phpbb_report_topic', [
            'id' => $this->primaryKey(),
            'date_report' => $this->integer(),
            'forum_id' => $this->integer(),
            'topic_id' => $this->integer(),
            'like_count' => $this->integer(),
            'total_post' => $this->integer(),
            'view_count' => $this->integer(),
            'rate_count' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('phpbb_report_topic');
    }
}
