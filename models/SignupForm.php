<?php

namespace app\models;

use yii\base\model;

class SignupForm extends Model {

    public $firstName;
    public $lastName;
    public $email;
    public $password;

    public function rules() {
        return [
            [['firstName', 'lastName', 'email', 'password'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute'=>'email']];
    }

}
