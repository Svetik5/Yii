<?php


namespace app\commands;


use app\components\ActivityDbComponent;
use app\components\NotificationComponent;
use app\models\Activity;
use yii\console\Controller;
use yii\helpers\Console;

class NotificationController extends Controller
{
    public $name;
    public $from;

    public function options($actionID)
    {
        return [
         //   'name',
            'from'
        ];
    }

    public function optionAliases()
    {
        return [
          'n'=>'name',
            'f'=>'from'
        ];
    }

    public function actionTest(){
      echo 'this is terminal'.PHP_EOL;
 //     print_r($args);
 //     echo $name.PHP_EOL;
        echo $this->ansiFormat($this->name,Console::FG_YELLOW).PHP_EOL;
  }
  public function actionSendNotification(){
        /** @var ActivityDbComponent $repository */
    $repository=\Yii::createObject(['class'=>ActivityDbComponent::class,'record_model_class'=>Activity::class,'model_class' => Activity::class]);
    $activities=$repository->getActivityForNotification($this->from);

   // print_r($activities);
      /**@var NotificationComponent $notification*/
      $notification=\Yii::createObject(['class'=>NotificationComponent::class,
          'mailer' =>\Yii::$app->mailer]);
      $notification->sendNotifications($activities);

  }
}