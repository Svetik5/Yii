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

  public $is_blocked;

  public function rules(){
      return [
        ['title','required'],
        ['discription','string','min'=>10],
        ['is_blocked','boolean']
      ];
  }
  public  function attributeLabels()
  {
      return [
          'title'=>'Названия события',
          'discription'=>'Описание',
          'date_start'=>'Дата начала',
          'date_end' => 'Дата окончания',
          'is_blocked'=>'Весь день оповещать'
      ];
  }
}