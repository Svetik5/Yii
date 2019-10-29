<?php
/**Created by PhpStorm...
 *@var $model \app\models\Activity
 */
?>
<div class="row">
    <div class="col-md-6">

        <?=Yii::getAlias('@app');?>

         <?=$name?>

        <?php $form=\yii\bootstrap\ActiveForm::begin([
                'id' => 'activity-create',
                'method' => 'POST'
        ]);?>

    <?=$form->field($model, 'title');?>

        <?=$form->field($model,'discription')->textarea(['data-id'=>'1']);?>

     <?=$form->field($model, 'date_start')->input('date');?>
        <?=$form->field($model, 'date_end')->input('date');?>
        <?=$form->field($model, 'is_blocked')->checkbox();?>
        <div class="form-group">
        <button type="submit">Сохранить</button>
        </div>
    <?php $form=\yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>