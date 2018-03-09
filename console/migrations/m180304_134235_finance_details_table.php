<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m180304_134235_finance
 */
class m180304_134235_finance_details_table extends Migration
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
                'stock' => Schema::TYPE_STRING . ' NOT NULL',
                'source' => Schema::TYPE_STRING,
                'sum' => Schema::TYPE_FLOAT,
                'currency' => "ENUM('UAH', 'USD', 'EUR') DEFAULT UAH",
                'is_active' => Schema::TYPE_BOOLEAN . ' DEFAULT \'0\'',
            ]
        );
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
