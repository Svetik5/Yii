<?php
/**Created by PhpStorm...
 *@var $model \app\models\Activity
 */
?>
<div class="row">
    <div class="col-md-6">

        <?//=Yii::getAlias('@app')?>

         <?//=$name?>

        <?php $form=\yii\bootstrap\ActiveForm::begin([
                'id' => 'activity-create',
                'method' => 'POST',
     //           'enableAjaxValidation'=> true,
        ]);?>

        <?=$form->field($model, 'title');?>
        <?=$form->field($model,'discription')->textarea();?>
        <?=$form->field($model, 'date_start');?>
        <?=$form->field($model, 'date_end');?>
        <?$form->field($model, 'repeat_type')->dropDownList($model->getRepeatTypes());?>
        <?=$form->field($model, 'is_blocked')->checkbox();?>
        <?=$form->field($model, 'use_notification')->checkbox();?>
        <?=$form->field($model, 'email',['enableAjaxValidation'=>true,
            'enableClientValidation'=>false]);?>
        <?=$form->field($model, 'repeat_email')?>
        <div class="form-group">
        <button type="submit">Сохранить</button>
        </div>
       <?=$form->field($model, 'file')->fileInput()?>
    <?php $form=\yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>