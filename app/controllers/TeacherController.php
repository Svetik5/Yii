<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 21.03.2019
 * Time: 16:40
 */

namespace app\controllers;


use yii\web\Controller;

class TeacherController extends Controller
{
    public function actionStudents(){
        $name_student='Svetlana';
        return $this->render( 'student',['name'=>$name_student]);
    }
}