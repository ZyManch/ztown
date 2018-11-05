<?php
/**
 * @var Friends $family
 */
?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th colspan="2">
            <?php if($family->userTo->sex == User::MALE):?>
            Ваш муж
            <?php else:?>
            Ваша жена
            <?php endif;?>
        </th>
    </tr>
    <tr>
        <td valign="top" align="center">
            <div>
                <?=$this->render('//users/_avatar', array('user' => $family->userTo));?>
            </div>
        </td>
        <td>
            <div>
                <?=$family->userTo->login;?>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div>
                <button onclick="location.href='<?=Url::to('messages/create', array('id' => $family->id));?>';">
                    <img src="images/info/letter.png"> Отправить сообщение
                </button>
            </div>
        </td>
    </tr>
</table>