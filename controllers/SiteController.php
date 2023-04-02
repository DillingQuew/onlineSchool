<?php

namespace app\controllers;

use app\models\CompletedCourse;
use app\models\Lesson;
use app\models\User;
use app\models\UserLesson;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {


            $data = [];
            $user = User::find()->where(['id' => Yii::$app->user->id])->one();
            $users = User::find()->select('*')->where(['id' => $user])->with('userLessons')->all();
            $data['lessons'] = UserLesson::getViewLessonStatus($users[0]);
//            $data['count'] = Lesson::getCountLessons();
            $data['count'] = CompletedCourse::getCountLessons(Yii::$app->user->id);
//            var_dump($data['lessons']); die;
            $data['countAll'] = Lesson::getCountLessons();
            if ($data['count']->lessonsDone == Lesson::getCountLessons()) {
                $data['count']->statusCourse = 1;
                $data['count']->save();

                $data['congr'] = true;
            } else {
                $data['congr'] = false;
            }

            return $this->render('index', ['data' => $data]);
        }
        else  {
            return $this->render('index');
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = "привет") {
        return $this->render('say', ['message' => $message]);
    }


}
