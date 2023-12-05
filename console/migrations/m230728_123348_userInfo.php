<?php

use yii\db\Migration;

/**
 * Class m230728_123348_userInfo
 */
class m230728_123348_userInfo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('userInfo','IIN',$this->string(12));
        $this->alterColumn('userInfo','birth_data',$this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230728_123348_userInfo cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230728_123348_userInfo cannot be reverted.\n";

        return false;
    }
    */
}
