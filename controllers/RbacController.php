<?php


namespace app\controllers;


use app\assets\Base\BaseController;

class RbacController extends BaseController
{
    public function actionGen(){
        \Yii::$app->rbac->generateRbac();
    }
}