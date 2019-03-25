<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.03.2019
 * Time: 21:31
 */

namespace app\controllers\action;


use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;
use yii\web\View;

class ActivityCreateAction extends Action
{
    public $name;

 public function run()
 {

     /** @var ActivityComponent $comp */
     // $comp=\Yii::$app->activity;
     $comp = \Yii::createObject([
         'class' => ActivityComponent::class,
         'model_class' => Activity::class
     ]);

     \Yii::$app->session->set('sd','');
     \Yii::$app->session->get('sd');

     $model = \Yii::$app->activity->getModel();
     // $model= new Activity();

     if (\Yii::$app->request->isPost) {
         $model->load(\Yii::$app->request->post());
         if ($comp->createActivity($model)) {


         //    if(!$model->validate()){
         //      print_r($model->getErrors());}
         //    $model->getAttributes(['title'=>'Мое название']);
         // $model->getAttributes(['title']);
     }

     //       $model->title=null;
 }
 return $this->controller->render('create', ['model'=>$model, 'name'=>$this->name]);
 }
}