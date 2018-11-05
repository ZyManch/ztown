<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 19.01.14
 * Time: 14:46
 * @var Map $map
 * @var EventController $this
 */
?>
<table class="default" cellpadding="0" cellspacing="0">
    <col width="100px">
    <col>
    <tr>
        <th>Инфо</th>
        <th>Инфо</th>
    </tr>
    <tr>
        <td>
            <div class="tile<?=$map->map_type_id;?>" style="left: 0px;top: 0px;"></div>
        </td>
        <td valign="top">Улучшайте здание для увеличение дохода.</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td align="right">
            <?=Html::moneyButtonByPrices(
                'Улучшить за',
                '',
                $map->getPricesToLevelUp(),
                1,
                array('style' => 'width:auto','href'=>$this->getUrl('upgrade', array('confirm'=>1)))
            );?>
            <?=Html::buttonWithHref(
                'Отмена',
                '',
                $this->getUrl('view')
           );?>
        </td>
    </tr>
</table>