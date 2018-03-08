<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m180304_134235_finance
 */
class m180304_134235_finance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('finance', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'stock' => Schema::TYPE_STRING . ' NOT NULL',
            'source' => Schema::TYPE_STRING,
            'sum' => Schema::TYPE_FLOAT,
            'currency' => Schema::TYPE_STRING . ' DEFAULT \'UAH\''
        ]);
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
