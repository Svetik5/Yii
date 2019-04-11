<?php


namespace app\widgets\daotable;


use yii\base\Widget;

class DaoTableWidgets extends Widget
{
    public $activities;
    public function run(){
        return $this->render('index',['users'=>$this->activities]);
    }
}