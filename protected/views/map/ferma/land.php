<?php
/**
 * @var \components\View $this
 * @var models\map\MapFerma $map
 * @var models\MapType $mapType
 * @var models\map\MapCrop $lang
 */

?>
<table class="default" cellpadding="0" cellspacing="0">
    <col width="200px">
    <col>
    <col>
    <tr>
        <th>Посев</th>
        <th>Описание</th>
    </tr>
    <?php foreach ($map->getLands() as $land):?>
        <tr<?php if (!$land->secondsToHarvest()):?> class="active"<?php endif;?>>
            <td rowspan="2">
                <img src="<?=$land->mapType->image();?>" class="tile_info" alt="<?=$land->mapType->name;?>">
            </td>
            <td>
                Уровень #<?=$land->level;?><br>
                Урожай:
                <?=$this->render('//users/_price',['price'=>$land->mapType->getPriceIncome()]);?><br>
                Время до созревания:
                <span class="timer" seconds="<?=$land->secondsToHarvest();?>"><?=$land->timeToHarvest();?></span>
            </td>
        </tr>
        <tr<?php if (!$land->secondsToHarvest()):?> class="active"<?php endif;?>>
            <td align="right">
                <?php if (!$land->secondsToHarvest()):?>
                    <?=\components\Html::buttonWithHref(
                        'Собрать урожай',
                        'images/info/bay.png',
                        $map->getUrl('harvest',['map_id'=>$land->map_id])
                    );?>
                <?php endif;?>
                <?=\components\Html::buttonWithHref(
                    'Детали',
                    'images/info/update.png',
                    $land->getUrl('view')
                );?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
