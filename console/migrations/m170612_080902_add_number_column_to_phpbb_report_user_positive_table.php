<?php

use yii\db\Migration;

/**
 * Handles adding number to table `phpbb_report_user_positive`.
 */
class m170612_080902_add_number_column_to_phpbb_report_user_positive_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('phpbb_report_user_positive', 'total_number_positive', $this->integer());
        $this->addColumn('phpbb_report_user_positive', 'total_number_negattive', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('phpbb_report_user_positive', 'total_number_positive');
        $this->dropColumn('phpbb_report_user_positive', 'total_number_negattive');
    }
}
