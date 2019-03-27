<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.03.2019
 * Time: 21:45
 */

namespace app\models;


use yii\base\Model;

class Activity extends Model
{
  public $title;

  public $discription;

  public $date_start;

  public $date_end;

  public $repeat_type;

  public $is_blocked;

  public $email;

  public $repeat_email;

  public $use_notification;

  protected static $repeat_types = [
    0 => 'Без повтора',
    1 => 'Ежедневно',
    2 => 'Еженедельно',
    3 => 'Ежемесячно',
    4 => 'Ежегодно'
  ];

  public function beforeValidate()
  {
      if( $this->date_start){
          $date=\DateTime::createFromFormat('d.m.Y',$this->date_start);
          if($date){
              $this->date_start=$date->format('Y-m-d');
          }
      }
      if( $this->date_end){
          $date=\DateTime::createFromFormat('d.m.Y',$this->date_end);
          if($date){
              $this->date_end=$date->format('Y-m-d');
          }
      }
      return parent::beforeValidate();
  }

    public function rules(){
      return [
        [['title', 'date_start', 'date_end'],'required'],
        [['title','discription'], 'trim'],
        ['discription','string','min' => 10, 'max' => 300],
        [['is_blocked','use_notification'],'boolean'],
        [['date_start','date_end'],'date','format' => 'php:Y-m-d'],
        ['email','email'],
      //  ['title','match','pattern' => '/w+{10,}/']
        ['repeat_email','compare', 'compareAttribute' => 'email', 'message' => 'Значения email должны быть равны '],
        ['email', 'required', 'when' => function($model ){
          return $model->use_notification==1?true:false;
        }],
      //  ['title','notAdmin'],
          ['title',NotAdminRule::class],
        ['repeat_type', 'in', 'range' => array_keys(self::$repeat_types)]
      ];
  }
  public  function notAdmin($attr){
    if($this->title=='admin'){
        $this->addError('title', 'Значение заголовка не должно быть admin');
    }
  }
  public  function attributeLabels()
  {
      return [
          'title'=>'Названия события',
          'use_notofocation' => 'Уведомлять о событии',
          'discription'=>'Описание',
          'date_start'=>'Дата начала',
          'date_end' => 'Дата окончания',
          'repeat_type' => 'Повтор',
          'is_blocked'=>'Оповещать?'
      ];
  }
    public function getRepeatTypes() {
        return array_merge(static::$repeat_types,[5=>'Не допустимо']);
    }
    public function getRepeatType($id) {
        $data = $this->getRepeatTypes();
        return array_key_exists($id, $data) ? $data[$id] : false;
    }
}