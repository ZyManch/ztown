<?php
/**
 * @var string $error
 * @var bool $disabled
 */
?>
<table class="default" cellpadding="0" cellspacing="0" width="600px">
    <tr>
        <th colspan="2">Арена</th>
    </tr>
    <tr>
        <td colspan="2"><img src="images/info/arena.jpg"></td>
    </tr>
    <?php if($error):?>
    <tr>
        <td colspan="2" class="redtext"><?=$error;?></td>
    </tr>
    <?php endif ?>
    <tr>
        <td>Для участия нужно быть сильным и ловким, иначе соперник выйграет.</td>
        <td>
            <?=Html::buttonWithHref(
                'Участвовать',
                'images/info/box.png',
                $this->getUrl('fight'),
                array('disabled' => $disabled)
            );?>
        </td>
    </tr>
</table>