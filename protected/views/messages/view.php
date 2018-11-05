<?php
/**
 * @var Messages $model
 */

use components\Html;

?>
<table cellpadding="0" cellspacing="0" class="default">
    <tr>
        <th><?=Yii::$app->dateFormatter->formatDateTime($model->created, 'medium', 'short');?></th>
        <th><?=$model->title;?></th>
    </tr>
    <tr>
        <td valign="top">
        <?=$this->render('//users/_avatar', array('user' => $model->fromUser));?>
        </td>
        <td valign="top">
            <?=$model->content;?><br/>
            <?=Html::buttonWithHref(
                'Ответить',
                'images/info/letter.png',
                array('messages/create', 'id' => $model->user_first_id)
            );?>
        </td>
    </tr>
</table>