<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 18.07.12
 * Time: 21:44
 * To change this template use File | Settings | File Templates.
 * @var array $items
 * @var Items $item
 * @var EventController $this
 */

use components\Html;

?>
<?php if($items): ?>
<table class="default" cellpadding="0" cellspacing="0">
    <col width="400px">
    <col width="150px">
    <col width="200px">
    <tr>
        <th>Описание</th>
        <th>Характеристики</th>
        <th>Стоимость</th>
    </tr>
    <?php foreach ($items as $item): ?>
        <tr>
            <td valign="top">
                <img src="images/items/<?=$item->id;?>.png" style="float:left;margin:5px;"/>
                <h3><?=$item->name;?></h3>
                <?=$item->content;?>
            </td>
            <td>
                <?=$this->render('//stats/_view', array('stat' => $item->stat));?>
            </td>
            <td align="center">
                <?=Html::moneyButton(
                    'Купить за ',
                    'images/info/bay.png',
                    $item,
                    $this->getMarkUp(),
                    array('href' => $this->getUrl('buy', array('type' => $type, 'id' => $item->id)))
                );?>
            </td>
        </tr>
        <?php endforeach; ?>
</table>
<?php else: ?>
<div style="width:250px;margin:100px 270px">
    Никаких предложений по продаже данной категорий не обнаружено.
</div>
<?php endif; ?>