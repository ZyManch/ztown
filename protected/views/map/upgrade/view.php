<?php
/**
 * @var array $items
 * @var ItemBuied $item
 */
?>
<table class="default" cellpadding="0" cellspacing="0">
    <col width="80px">
    <col width="">
    <col width="150px">
    <col width="231px">
    <tr>
        <th colspan="2">Ваша вещь</th>
        <th width="120px">Характеристики</th>
        <th width="240px">Улучшить</th>
    </tr>
    <?php if (sizeof($items)):?>
        <?php foreach($items as $item): ?>
            <tr>
                <td>
                    <div class="item_profile item<?=$item->item_id;?>">
                        <?php if($item->light != 'Standart'): ?>
                            <div class="item_lvl item_<?=strtolower($item->light);?>">
                                <?=$item->level;?>
                            </div>
                        <?php endif; ?>
                    </div>
                </td>
                <td>
                    <?=$item->item->content;?>
                </td>
                <td>
                    <?=$this->render('//stats/_view', array('stat' => $item->stat));?>
                </td>
                <td>
                    <?php $upgradeTypes = array(
                            ItemBuied::UPGRADE_ADVANCED,
                            ItemBuied::UPGRADE_VIP,
                            ItemBuied::UPGRADE_GOLD
                    );?>
                    <?php foreach ($upgradeTypes as $type):?>
                        <?php $price = Yii::$app->config->getUpgradePrice($item, $type);?>
                        <div>
                            <?=Html::moneyButtonByPrices(
                                   ItemBuied::labelUpgrade($type),
                                   '/images/info/update.png',
                                    Yii::$app->config->getUpgradePrice($item, $type),
                                    1,
                                    array(
                                         'href' => $this->getUrl('upgrade', array('item' => $item->id, 'type' => $type)),
                                         'style'=>'width:100%',
                                         'disabled' => in_array($item->light, array(ItemBuied::UPGRADE_STANDART, $type)) ? '' : 'disabled'
                                    )
                            );?>
                        </div>
                    <?php endforeach;?>
                </td>
            </tr>
        <?php endforeach;?>
    <?php else:?>
        <tr>
            <td colspan="4">Список пуст</td>
        </tr>
    <?php endif;?>
</table>