<?php

use yii\db\Migration;

/**
 * Class m221208_144250_tokens
 */
class m221208_144250_tokens extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tokens', [
            'id' => $this->primaryKey(),
            'token' => $this->string(32),
            'user' => $this->string(10),
            'start' => $this->dateTime("Y-m-d H:i:s"),
            'stop' => $this->dateTime("Y-m-d H:i:s")
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221208_144250_tokens cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221208_144250_tokens cannot be reverted.\n";

        return false;
    }
    */
}
