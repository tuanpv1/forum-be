<?php

use yii\db\Migration;

/**
 * Handles adding status_topic to table `phpbb_topics`.
 */
class m170508_012935_add_status_topic_column_to_phpbb_topics_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('phpbb_topics', 'topic_status_display', "int(11) default 0");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('phpbb_topics', 'topic_status_display');
    }
}
