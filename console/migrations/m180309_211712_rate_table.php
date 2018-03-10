<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m180309_211712_rate_table
 */
class m180309_211712_rate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'rate',
            [
                'id' => Schema::TYPE_PK,
                'currency' => Schema::TYPE_STRING,
                'coefficient' => Schema::TYPE_FLOAT,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rate');

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
