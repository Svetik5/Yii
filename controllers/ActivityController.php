<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.03.2019
 * Time: 20:44
 */

namespace app\controllers;


use app\assets\Base\BaseController;
use app\behaviors\DateCreatedBehavior;
use app\controllers\action\ActivityCreateAction;
use app\models\Activity;
use app\models\ActivitySearch;
use yii\db\ActiveRecord;
use yii\web\HttpException;

class ActivityController extends BaseController
{
  public function actions() {
      return [
          'create' => ['class' => ActivityCreateAction::class]

      ];
  }
  public function actionIndex(){
      $model =new ActivitySearch();
      $provider=$model->getDataProvider(\Yii::$app->request->queryParams);

      return $this->render('index',['model'=>$model,'provider'=>$provider]);
  }

  public function actionView($id){

      /** @var ActiveRecord $model*/
      $model= Activity::find()->andWhere(['id'=>$id])->one();//\Yii::$app->activity->getActivity($id);

      if (!$model){
          throw new HttpException(401,'activity not found');
      }
      if (!\Yii::$app->rbac->canViewActivity($model)){
          throw new HttpException(403,'not access show activity');
      }

      $model->attachBehavior('datecreated',[
          'class' =>DateCreatedBehavior::class,'attribute_name' => 'date_created'
      ]);

   //  return \Yii::$app->log();
     //   $model->detachBehavior('datecreated');
      return $this->render('view',
      ['model' =>$model]
      );
  }
}