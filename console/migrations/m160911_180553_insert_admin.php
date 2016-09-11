<?php

use yii\db\Migration;

class m160911_180553_insert_admin extends Migration
{
    public function up()
    {
        $this->insert('{{%user}}', [
          'username' => 'admin',
          'auth_key' => \Yii::$app->security->generateRandomString(),
          'password_hash' => \Yii::$app->security->generatePasswordHash('admin'),
          'password_reset_token' => \Yii::$app->security->generateRandomString() . '_' . time(),
          'email' => 'admin@example.com',
          'status' => 10,
          'created_at' => time(),
          'updated_at' => time()
        ]);
    }

    public function down()
    {
        echo "m160911_180553_insert_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
