<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use Yii;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\IdentityInterface;
use yii\web\Response;

 class AuthController extends Controller {
    public
    function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('/auth/login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public
    function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();

    }

    public function actionTest() {
        $user = User::findOne(1);

       if(Yii::$app->user->isGuest) {
           Yii::$app->user->login($user);
           echo "Пользователь авторизован";
       } else {
           Yii::$app->user->logout();
           echo "Пользователь не авторизован";
       }
    }

    public function actionSignup() {
        $model = new SignupForm();
        return $this->render('signup', ['model'=>$model]);
    }

}