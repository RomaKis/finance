<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m180309_210044_stock_table
 */
class m180309_210044_stock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'stock',
            [
                'id' => Schema::TYPE_PK,
                'user_id' => Schema::TYPE_INTEGER,
                'name' => Schema::TYPE_STRING,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('stock');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180309_210044_stock_table cannot be reverted.\n";

        return false;
    }
    */
}
