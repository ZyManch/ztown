<?php
/**
 * @var string $text
 * @var int $money
 * @var bool $win
 * @var int $count
 * @var int $id
 */
?>
<table class="default" cellpadding="0" cellspacing="0" width="600px">
    <tr>
        <th>Результат скачек</th>
    </tr>
    <tr>
        <td align="center"><img src="images/info/skachki.jpg" width="602px" height="376px"/></td>
    </tr>
    <tr>
        <td>
            <?php if (!is_null($win)):?>
                <?php if ($win):?>
                    После ошеломительных скачек, Вы, помимо отличных впечатлений,
                    выйграли еще <?=$this->render('//users/_money', array('money' => $money*$count));?>.
                    А ведь шанс был <b>1</b> к <b><?=$count;?></b>.
                <?php else:?>
                    После ошеломительных скачек, в результате которых вы получили
                    море впечатлений, вам даже не жалко
                    <?=$this->render('//users/_money', array('money' => $money));?>.
                    Ведь деньги в жизне это не главное.
                <?php endif;?>
            <?php endif;?>
        </td>
    </tr>
    <tr>
        <td>
            <input type="button" onclick="location.reload()" value="Попробовать еще">
            <input type="button" onclick="location.href='<?=$this->getUrl('rice');?>'" value="Назад">
        </td>
    </tr>
</table>