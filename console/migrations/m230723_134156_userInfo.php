<?php

use yii\db\Migration;

/**
 * Class m230723_134156_userInfo
 */
class m230723_134156_userInfo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
  {
        $this->createTable('{{%user_info}}', [
            'id' => $this->primaryKey(),
            'surname' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'patronymic' => $this->string()->notNull(),
            'iin' => $this->string()->unique(),
            'birth_data' => $this->string()->notNull(),
            'photo_url' => $this->string(),
            'auth_id' => $this->integer(),
            ]);
        $this->addForeignKey(
                'auth_id',  // это "условное имя" ключа
                '{{%user_info}}', // это название текущей таблицы
                'auth_id', // это имя поля в текущей таблице, которое будет ключом
                'user', // это имя таблицы, с которой хотим связаться
                'id', // это поле таблицы, с которым хотим связаться
                'CASCADE'
            );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230723_134156_userInfo cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230723_134156_userInfo cannot be reverted.\n";

        return false;
    }
    */
}
