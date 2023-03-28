<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%userLesson}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%lesson}}`
 */
class m230328_093452_create_userLesson_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%userLesson}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'lesson_id' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(0),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-userLesson-user_id}}',
            '{{%userLesson}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-userLesson-user_id}}',
            '{{%userLesson}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `lesson_id`
        $this->createIndex(
            '{{%idx-userLesson-lesson_id}}',
            '{{%userLesson}}',
            'lesson_id'
        );

        // add foreign key for table `{{%lesson}}`
        $this->addForeignKey(
            '{{%fk-userLesson-lesson_id}}',
            '{{%userLesson}}',
            'lesson_id',
            '{{%lesson}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-userLesson-user_id}}',
            '{{%userLesson}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-userLesson-user_id}}',
            '{{%userLesson}}'
        );

        // drops foreign key for table `{{%lesson}}`
        $this->dropForeignKey(
            '{{%fk-userLesson-lesson_id}}',
            '{{%userLesson}}'
        );

        // drops index for column `lesson_id`
        $this->dropIndex(
            '{{%idx-userLesson-lesson_id}}',
            '{{%userLesson}}'
        );

        $this->dropTable('{{%userLesson}}');
    }
}
