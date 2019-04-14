<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.03.2019
 * Time: 23:41
 */
namespace app\components;
use app\behaviors\LogMyBehavior;
use app\models\Activity;
use yii\base\Component;
use yii\validators\EmailValidator;
use yii\web\UploadedFile;
class ActivityComponent extends Component
{
    public $model_class;
    const EVENT_LOAD_IMAGES='load_imaged';
    public function behaviors()
    {
        return [
            LogMyBehavior::class
        ];
    }

    public function init()
    {
        parent::init();
        if (empty($this->model_class)) {
            throw new \Exception('Need model_class param');
        }
    }
    public function getModel()
    {
        return new $this->model_class;
    }

    public function getActivityForNotification($from){

    }

    public function createActivity(&$model, $post): bool
    {
        /** @var Activity $model */
        if ($model->load($post)) {
            $model->file=UploadedFile::getInstance($model,'file');
            if ($model->validate()) {
                $comp=\Yii::createObject(['class'=>FileServiceComponent::class]);
                if(!empty($file=$comp->saveUploadedFile($model->file))){
                    $this->trigger(self::EVENT_LOAD_IMAGES);
                  //  $this->on(self::EVENT_LOAD_IMAGES,function ())
                    $model->file=basename($file);
                }
                return true;
            }
        }
        return false;
    }
}