<?php

use yii\db\Migration;

/**
 * Handles the creation of table `friends`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user`
 */
class m160911_182711_create_friends_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('friends', [
            'user_id' => $this->integer()->notNull(),
            'friend_id' => $this->integer()->notNull(),
            'PRIMARY KEY (`user_id`, `friend_id`)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-friends-user_id',
            'friends',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-friends-user_id',
            'friends',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `friend_id`
        $this->createIndex(
            'idx-friends-friend_id',
            'friends',
            'friend_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-friends-friend_id',
            'friends',
            'friend_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-friends-user_id',
            'friends'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-friends-user_id',
            'friends'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-friends-friend_id',
            'friends'
        );

        // drops index for column `friend_id`
        $this->dropIndex(
            'idx-friends-friend_id',
            'friends'
        );

        $this->dropTable('friends');
    }
}
