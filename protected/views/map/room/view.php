<?php
/**
 * @var array $houses
 * @var Houses $house
 * @var \models\map\MapRoom $map
 * @var \models\MapType $mapType
 * @var \components\View $this
 */

use components\Config;
use components\Html;
$rentPrice = $map->getRentPrice();
?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr><th colspan="2">Владельцы квартир</th></tr>
    <?php if($houses):?>
    <?php foreach ($houses as $house):?>
	<tr>
		<td>
            <?=$this->render('//users/_avatar', array(
            'user' => $house->user, 'ancor'=> true
        ));?>
        </td>
    	<td>
        <?php if($house->user->isMe()): ?>
            <br>
            Доход в день:
            <?=$this->render('//users/_money', array(
                'money'      => round($rentPrice->value),
                'currencyId' => $rentPrice->currency_id
            ));?>
            <hr>
            <?=Html::moneyButtonByPrices(
                'Продать за',
                'images/info/bay.png',
                $rentPrice,
                1,
                array('href' => $map->getUrl('sell'))
            );?>
            <?php endif; ?>
        <?php endforeach;	?>
        </td>
    </tr>
    <?php else: ?>
    <tr><td colspan="2">Список пуст</td></tr>
    <?php endif;?>

    <?php if(count($houses) <= Config::MAX_HOUSE_LIVE): ?>
    <tr><td colspan="2">
        <?=Html::moneyButtonByPrices(
            'Снять за',
            'images/info/bay.png',
            $rentPrice,
            1,
            array('href' => $map->getUrl('buy'))
        );?>
    </td></tr>
    <?php else: ?>
    <tr><td colspan="2"><input type="button" value="Пустых квартир нет" disabled></td></tr>
    <?php endif; ?>
</table>