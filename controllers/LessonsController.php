<?php
namespace app\controllers;
use app\models\CompletedCourse;
use app\models\Lesson;
use app\models\UserLesson;
use Yii;
use yii\web\Controller;

class LessonsController extends Controller {
    public function actionLesson($id) {
        $user = UserLesson::getLessonWithStatus($id);

        $lesson = Lesson::findOne($user->lesson_id);
        return $this->render('lesson', ['lesson' => $lesson]);
    }
    public function actionDone($id) {
        $lesson = UserLesson::getLessonWithStatus($id);
        $lessonsDone = CompletedCourse::getCountLessons(Yii::$app->user->id);
        if (Lesson::getCountLessons()[0])
        $lessonsDone->lessonsDone += 1;

        $lessonsDone->save();
        $lesson->status = 1;
        $lesson->save();
//        var_dump($lesson); die;
        $this->redirect('/');
    }
}
