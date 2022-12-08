<?php

use yii\db\Migration;

/**
 * Class m221208_160453_requestdata
 */
class m221208_160453_requestdata extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('requestdata', [
            'id' => $this->primaryKey(),
            'user' => $this->string(10),
            'data' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221208_160453_requestdata cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221208_160453_requestdata cannot be reverted.\n";

        return false;
    }
    */
}
