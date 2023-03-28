<?php

namespace app\models;

use yii\base\model;

class SignupForm extends Model {

    public $firstName;
    public $lastName;
    public $email;
    public $password;

    public $rememberMe = true;


    public function rules() {
        return [
            [['firstName', 'lastName', 'email', 'password'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute'=>'email'],
            [['rememberMe'], 'boolean'],
        ];

    }

    public function singup() {
        if($this->validate() ) {

            $user = new User();

            $user->attributes = $this->attributes;

            return $user->create();
        }
    }

}
