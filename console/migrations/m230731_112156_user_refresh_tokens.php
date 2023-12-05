<?php

use yii\db\Migration;

/**
 * Class m230731_112156_user_refresh_tokens
 */
class m230731_112156_user_refresh_tokens extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->createTable('user_refresh_tokens',[
        'user_refresh_tokenID' => $this->primaryKey(10)->unsigned(),
        'urf_userID' => $this->integer(10)->unsigned()->notNull(),
        'urf_token' => $this->string(1000)->notNull(),
        'urf_ip' => $this->string(50)->notNull(),
        'urf_user_agent' => $this->string(1000)-> notNull(),
        'urf_created' => $this->dateTime()->notNull()->comment('UTC'),

       ]);
       
        /*CREATE TABLE `user_refresh_tokens` (
            `user_refresh_tokenID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `urf_userID` INT(10) UNSIGNED NOT NULL,
            `urf_token` VARCHAR(1000) NOT NULL,
            `urf_ip` VARCHAR(50) NOT NULL,
            `urf_user_agent` VARCHAR(1000) NOT NULL,
            `urf_created` DATETIME NOT NULL COMMENT 'UTC',
            PRIMARY KEY (`user_refresh_tokenID`)
        )
        COMMENT='For JWT authentication process';*/
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_refresh_tokens');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230731_112156_user_refresh_tokens cannot be reverted.\n";

        return false;
    }
    */
}
