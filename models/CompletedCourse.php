<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "completedCourse".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $lessonsDone
 * @property int|null $statusCourse
 *
 * @property User $user
 */
class CompletedCourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'completedCourse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'lessonsDone', 'statusCourse'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'lessonsDone' => 'Lessons Done',
            'statusCourse' => 'Status Course',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
