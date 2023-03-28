<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%completedCourse}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m230328_093715_create_completedCourse_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%completedCourse}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'lessonsDone' => $this->integer()->defaultValue(0),
            'statusCourse' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-completedCourse-user_id}}',
            '{{%completedCourse}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-completedCourse-user_id}}',
            '{{%completedCourse}}',
            'user_id',
            '{{%user}}',
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
            '{{%fk-completedCourse-user_id}}',
            '{{%completedCourse}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-completedCourse-user_id}}',
            '{{%completedCourse}}'
        );

        $this->dropTable('{{%completedCourse}}');
    }
}
