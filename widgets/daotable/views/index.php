<?php



/* @var $this \yii\web\View */
/* @var $users  */

?>
<table class="table table-bordered email">
    <tr>
        <?php foreach ($users[0] as $k => $v):?>
        <td>
            <?=yii\bootstrap\Html::encode($k)?>
        </td>
        <?php endforeach;?>
    </tr>
    <?php foreach ($users as $v):?>
    <tr>
        <?php foreach($v as $_v):?>
        <td><?=yii\bootstrap\Html::encode()?></td>
        <?php endforeach;?>
    </tr>
    <?php endforeach;?>
</table>
