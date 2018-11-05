<?php
/**
 * @var \models\User $user
 * @var boolean $ancor
 */

use components\Html;
if (!isset($ancor)) $ancor = true;
if (!isset($online)) $online = true;
?>
<?php if ($user):?>
    <?php $avatar = Html::img(
        'images/avatars/' . $user->avatar,
        array('class' => 'tile_info')
    );?>
    <?php if($ancor):?>
        <?=Html::a($avatar, array('user/view', 'id' => $user->user_id));?>
    <?php else:?>
        <?=$avatar;?>
    <?php endif;?>
    <?php if($online):?>
        <div>Статус:
        <?php if($user->isOnline()):?>
        <div class="online"></div>
        <?php else:?>
        <div class="offline"></div>
        <?php endif;?>
        </div>
    <?php endif;?>
<?php else:?>
    <?=Html::img(
        'images/avatars/default.jpg',
        array('class' => 'tile_info')
    );?>
<?php endif;?>