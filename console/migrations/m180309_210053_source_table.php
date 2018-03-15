<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m180309_210053_source_table
 */
class m180309_210053_source_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'source',
            [
                'id' => Schema::TYPE_PK,
                'user_id' => Schema::TYPE_INTEGER,
                'stock_id' => Schema::TYPE_INTEGER,
                'name' => Schema::TYPE_STRING,
            ]
        );

        $this->addForeignKey('stock_to_source', 'source', 'stock_id', 'stock', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('source');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180309_210053_source_table cannot be reverted.\n";

        return false;
    }
    */
}
