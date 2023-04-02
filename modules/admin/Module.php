<?php

namespace app\modules\admin;

use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $layout = '/admin';

    public function behaviors()
    {
        return [
          'access' => [
              'class' => AccessControl::class,
              'denyCallback' => function($rule, $action) {
                throw new NotFoundHttpException();
              },
              'rules' => [
                  [
                      'allow' => true,
                      'matchCallback' => function($rule, $action) {
                          if(!Yii::$app->user->isGuest) {
                              return Yii::$app->user->identity->isAdmin;
                          } else {
                              throw new NotFoundHttpException();
                          }
                      }
                  ]
              ]
          ]
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
