<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.03.2019
 * Time: 21:45
 */

namespace app\models;


use app\assets\base\BaseModel;
use app\behaviors\DateCreatedBehavior;
use app\behaviors\LogMyBehavior;
use app\models\rules\NotAdminRule;

class Activity extends ActivityBase
{
   public function behaviors()
    {
        return [
            ['class' => DateCreatedBehavior::class,
              'attribute_name' => 'date_created' ],
            LogMyBehavior::class
        ];
    }

    public $file;

    public function beforeValidate()
    {
        if($this->date_start){
            $date=\DateTime::createFromFormat('d.m.Y',$this->date_start);
            if($date){
                $this->date_start=$date->format('Y-m-d');
            }
        }
        return parent::beforeValidate();
    }
    public function rules()
    {
        return array_merge([
            [['title','date_start'], 'required'],
            [['title','description'],'trim'],
            ['description', 'string', 'min' => 10, 'max' => 300],
            [['is_blocked','use_notification'], 'boolean'],
            ['date_start','date','format' => 'php:Y-m-d'],
            ['email','email'],
//            ['title','match','pattern' => '/w+{10,}/'],
            ['repeat_email','compare','compareAttribute' => 'email' ,'message' => 'Значения email должны быть равны'],
            ['email','required','when' => function($model){
                return $model->use_notification==1?true:false;
            }],
            ['file','file','extensions' => ['jpg','png']],
//            ['title','notAdmin'],
            [['title','description'],NotAdminRule::class],
            ['repeat_type','in','range' => array_keys(self::$repeat_types)]
        ],parent::rules());
    }
    public function notAdmin($attr){
        if($this->title=='admin'){
            $this->addError('title','Значения заголовка не должно быть admin');
        }
    }

    public function getRepeatTypes() {
        return array_merge(static::$repeat_types,[5=>'Не допустимо']);
    }
    public function getRepeatTypeName($id) {
        $data = $this->getRepeatTypes();
        return array_key_exists($id, $data) ? $data[$id] : false;
    }
}