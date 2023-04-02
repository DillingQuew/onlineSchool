<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lesson".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $videoUrl
 *
 * @property UserLesson[] $userLessons
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'videoUrl'], 'required'],
            [['name', 'description', 'videoUrl'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'videoUrl' => 'Video Url',
        ];
    }

    /**
     * Gets query for [[UserLessons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserLessons()
    {
        return $this->hasMany(UserLesson::class, ['lesson_id' => 'id']);
    }

    public static function getCountLessons() {
      $count = (new \yii\db\Query())
            ->select('count(*)')->from('lesson')
            ->all();
      return $count[0]['count(*)'];
    }
}
