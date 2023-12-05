<?php

use yii\db\Migration;

/**
 * Class m230728_150719_userInfo
 */
class m230728_150719_userInfo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('userInfo','birth_data','date using birth_data::date');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('userInfo','birth_data',$this->string()->notNull());

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230728_150719_userInfo cannot be reverted.\n";

        return false;
    }
    */
}
