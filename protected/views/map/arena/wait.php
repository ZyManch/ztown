<?php
/**
 * @var bool $disabled
 */
?>
<table class="default" cellpadding="0" cellspacing="0" width="600px">
    <tr>
        <th colspan="2">Арена</th>
    </tr>
    <tr>
        <td>
            Для участия нужно быть сильным и ловким, иначе соперник выйграет.
        </td>
        <td>
            <?=Html::buttonWithHref(
                'Отозвать заявку',
                'images/info/box.png',
                $this->getUrl('stop'),
                array('disabled' => $disabled)
            );?>
        </td>
    </tr>
</table>