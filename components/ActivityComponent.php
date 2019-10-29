<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 25.03.2019
 * Time: 13:13
 */

namespace app\components;


use yii\base\Component;

class ActivityComponent extends Component
{
 public $model_class;

    public function init()
    {
        parent::init();

        if (empty($this->model_class)) {
            throw new \Exception('Need model_class param');
        }
    }

    public function getModel(){
        return new $this->model_class;
    }
    public function createActivity(&$model){
        $model->load(\Yii::$app->request->post());
        if(!$model->validate()){
  //          print_r($model->getErrors());
            return false;
        }
return true;

}
}