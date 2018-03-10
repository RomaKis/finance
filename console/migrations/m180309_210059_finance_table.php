<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m180309_210059_finance_table
 */
class m180309_210059_finance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'finance',
            [
                'id' => Schema::TYPE_PK,
                'date' => Schema::TYPE_DATE,
                'sum' => Schema::TYPE_FLOAT,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('finance');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180304_134235_finance cannot be reverted.\n";

        return false;
    }
    */
}
