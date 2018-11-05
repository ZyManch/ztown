<?php
/**
 * @var array $allWhoTry
 * @var Friends $family
 * @var User $user
 */

use components\Html;

?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th colspan="2">
            Ожидание ответа
        </th>
    </tr>
    <?php foreach($allWhoTry as $family):?>
        <tr>
            <td rowspan="2"  valign="top" align="center">
                <div>
                    <?=$this->render('//users/_avatar', array('user'=>$family->userTo));?>
                </div>
            </td>
            <td>
                <div>
                    <?=$family->userTo->login;?>
                </div>
                <?php if($family->userTo->group): ?>
                <div>
                    <?=$family->userTo->group->groupLabel()?>:
                    <?=Html::a(
                    $family->userTo->group->name,
                    array('groups/view', 'id' => $family->userTo->group->id)
                );?>
                </div>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>
                <div>
                    <?php if($user->sex == User::FAMALE):?>
                    <div>
                        <?=Html::buttonWithHref(
                        'Выйти замуж',
                        'images/info/friend.png',
                        $this->getUrl('accept', array('id' => $family->userTo->id))
                    );?>
                    </div>
                    <div>
                        <?=Html::buttonWithHref(
                        'Отказать',
                        'images/info/delete.png',
                        $this->getUrl('decline', array('id' => $family->userTo->id))
                    );?>
                    </div>
                    <?php else:?>
                    Ожидание ответа
                    <?php endif;?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
</table>