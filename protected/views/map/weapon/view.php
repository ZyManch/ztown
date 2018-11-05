<?php
/**
 * @var Items $weapon
 * @var int $group
 * @var array $weapons
 * @var EventController $this
 */

use components\Html;

?>
<?php if($weapons):?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th width="400px">Описание</th>
        <th width="100px">Характеристики</th>
        <th width="200px">Стоимость</th>
    </tr>
    <?php foreach ($weapons as $weapon): ?>
    <tr>
        <td valign="top">
            <img src="images/items/<?=$weapon->id;?>.png" style="float:left;margin:5px;">
            <h3><?=$weapon->name;?></h3>
            <?=$weapon->content;?>
        </td>
        <td>
            <?=$this->render('//stats/_view', array('stat' => $weapon->stat));?>
        </td>
        <td align="center">
            <?=Html::moneyButton(
                'Купить за ',
                'images/info/bay.png',
                $weapon,
                $this->getMarkUp(),
                array('href' => $this->getUrl('buy', array('id' => $weapon->id,'group_id' => $group)))
            );?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else:?>
<div style="width:250px;margin:100px 270px">
    Никаких предложений по продаже данной категорий не обнаружено.
</div>
<?php endif;?>