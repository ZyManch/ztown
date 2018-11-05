<?php
/**
 * @var $data Reports
 */
?>
<tr>
    <td>
        <?=$data->id;?>
    </td>
    <td>
        <?=date('j.m.Y G:i', $data->Date);?>
    </td>
    <td>
        <?=$data->fromUser->login;?>&nbsp;
    </td>
    <td>
        <?=$data->toUser->login;?>&nbsp;
    </td>
    <td>
        <?=$data->title;?>&nbsp;
    </td>
    <td>
        <?=$this->render('//users/_money', array('money' => $data->Money));?>
    </td>
</tr>