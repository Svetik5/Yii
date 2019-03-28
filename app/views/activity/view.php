<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.03.2019
 * Time: 23:08
 */
?>
<div class="row">
    <div class="col-md-12">
        <?=yii\helpers\Html::tag('p', 'Описание'. $model->discription)?>
        <p>Название:<strong><?=yii\helpers\Html::encode($model->title) ?></strong></p>
        <p><?=yii\helpers\Html::img('/images/'.$model->file,['width'=>150])?></p>
    </div>
</div>