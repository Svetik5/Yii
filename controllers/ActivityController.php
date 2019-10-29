<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.03.2019
 * Time: 20:44
 */

namespace app\controllers;


use app\assets\Base\BaseController;
use app\controllers\action\ActivityCreateAction;

class ActivityController extends BaseController
{
  public function actions() {
      return [
          'create'=>['class'=>ActivityCreateAction::class, 'name' => 'Sveta'],
          'new'=>['class'=>ActivityCreateAction::class, 'name' => 'Календарь']

      ];
  }
}