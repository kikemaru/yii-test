<?php

use yii\db\Migration;

/**
 * Class m221208_134456_account
 */
class m221208_134456_account extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('account', [
            'id' => $this->primaryKey(),
            'login' => $this->string(10),
            'password' => $this->string(32)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221208_134456_account cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221208_134456_account cannot be reverted.\n";

        return false;
    }
    */
}
