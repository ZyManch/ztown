<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 01.07.12
 * Time: 8:16
 * To change this template use File | Settings | File Templates.
 * @var User $user
 * @var Friends $friend
 */

use components\Html;

?>
<table class="default" cellpadding="0" cellspacing="0">

    <?php if ($user->sex == User::FAMALE):?>
    <tr>
        <td>Предложение может делать только будущий жених</td>
    </tr>
    <?php else:?>
        <tr>
            <th colspan="2">
                Выберите супруга
            </th>
        </tr>
        <?php $listEmpty = true;?>
        <?php foreach ($user->friends as $friend):?>
            <?php if(!$friend->userTo->family):?>
                <?php $listEmpty = false;?>
                <tr>
                    <td>
                        <?=$this->render('//users/_avatar', array('user' => $friend->userTo));?>
                    </td>
                    <td valign="top">
                        <?=Html::buttonWithHref(
                            $friend->userTo->sex == User::MALE ? 'Выйти замуж' : 'Жениться',
                            'images/info/letter.png',
                            $this->getUrl('view', array('id' => $friend->userTo->id))
                        );?>

                    </td>
                </tr>
            <?php endif;?>
        <?php endforeach;?>
        <?php if ($listEmpty):?>
        <tr>
            <td>У вас нет ни одной девушки в друзьях. Добавте свою возлюбленную в
                друзья чтобы сделать ей предложение!</td>
        </tr>
        <?php endif;?>
    <?php endif;?>
</table>