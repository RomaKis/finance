<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m180309_210070_finance_details_table
 */
class m180309_210070_finance_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'finance_details',
            [
                'id' => Schema::TYPE_PK,
                'finance_id' => Schema::TYPE_INTEGER,
                'user_id' => Schema::TYPE_INTEGER,
                'stock_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'source_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'sum' => Schema::TYPE_FLOAT,
                'currency' => "ENUM('UAH', 'USD', 'EUR') DEFAULT 'UAH'",
                'is_active' => Schema::TYPE_BOOLEAN . ' DEFAULT \'0\'',
            ]
        );

        $this->addForeignKey('finance_details_user', 'finance_details', 'finance_id', 'finance', 'id');
        $this->addForeignKey('finance_details_stock', 'finance_details', 'stock_id', 'stock', 'id');
        $this->addForeignKey('finance_details_source', 'finance_details', 'source_id', 'source', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('finance_details');

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
