<?php

use frontend\models\resource\finance\Rate;
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
                'currency' => "ENUM('" . Rate::UAH . "', '" . Rate::USD . "', '" . Rate::EUR . "')" . " UNIQUE",
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
