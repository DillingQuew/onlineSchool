<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $firstName
 * @property string|null $lastName
 * @property int|null $isAdmin
 * @property string $email
 * @property string $password
 *
 * @property CompletedCourse[] $completedCourses
 * @property UserLesson[] $userLessons
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isAdmin'], 'integer'],
            [['email', 'password'], 'required'],
            [['firstName', 'lastName', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'isAdmin' => 'Is Admin',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[CompletedCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompletedCourses()
    {
        return $this->hasMany(CompletedCourse::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserLessons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserLessons()
    {
        return $this->hasMany(UserLesson::class, ['user_id' => 'id']);
    }

    public function getLessons() {
        return $this->hasMany(Lesson::class, ['id' => 'lesson_id'])
            ->via('userLessons');
    }
    public function getLessonss() {
        return $this->hasMany(Lesson::class, ['id' => 'lesson_id'])
            ->via('userLessons');
    }

    public function create() {
        return $this->save(false);
    }

    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findByUsername($email) {
        return User::find()->where(['email'=>$email])->one();
    }
    public function validatePassword($password){
        return ($this->password == $password) ? true : false;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
