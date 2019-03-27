<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.03.2019
 * Time: 21:21
 */

namespace app\models\rules;


use yii\validators\Validator;

class notAdminRule extends Validator
{
public function validateAttribute($model, $attribute)
{
    if($model->$attribute=='admin'){
        $model->addError($attribute, 'Значение заголовка не должно быть admin');
}
}