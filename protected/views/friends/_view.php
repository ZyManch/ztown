<?php
/**
 * @var Friends $data
 */

use components\Html;
use yii\helpers\Url;

$user = $data->getFriend();
$friend = $user->getFriend();
?>
<tr>
    <td valign="top" width="30px" align="center"><?=$user->id;?></td>
    <td valign="top" width="80px">
        <?=$this->render('//users//_avatar', array('user' => $user, 'ancor' =>true));?>
    </td>
    <td valign="top">
        <?php $text = $data->Confirm ? $user->login : '<b>' . $user->login . '</b>';?>
        <?=Html::a($text, array('user/view', 'id' => $user->id));?>

        <?php if($user->isOnline()):?>
            <span class="online">(онлайн)</span>
        <?php endif;?>

        <?php if($user->group_id):?>
        <hr>
        <?=$user->group->groupLabel();?>:
        <?=Html::a($user->group->name, array('groups/view', 'id' => $user->group_id));?>
        <?php endif; ?>

        <hr>
        <?php if($friend && $friend->Confirm): ?>
        <div><button onclick="location.href='<?=Url::to(array('friends/delete', 'id' => $friend->id));?>';">
            <img src="images/info/delete.png"> Удалить из друзей
        </button></div>
        <?php else: ?>
        <div><button onclick="location.href='<?=Url::to(array('friends/invite', 'id' => $user->id));?>';">
            <img src="images/info/friend.png"> Принять приглашение
        </button></div>

        <div><button onclick="location.href='<?=Url::to(array('friends/delete', 'id' => $friend->id));?>';">
            <img src="images/info/delete.png"> Удалить из друзей
        </button></div>
        <?php endif; ?>
        </a>
    </td>
</tr>