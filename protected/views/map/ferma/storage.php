<?php
/**
 * @var \components\View $this
 * @var models\map\MapFerma $map
 * @var models\MapType $mapType
 * @var models\map\MapCrop $lang
 */
$storage = $map->getStorage();
?>

<?php if (!$storage):?>
    asd
<?php else:?>
    <table class="default" cellpadding="0" cellspacing="0">
        <col width="100px">
        <col>
        <col>
        <tr>
            <th>Хранилище</th>
            <th>Описание</th>
        </tr>
        <tr>
            <td rowspan="2" valign="top">
                <img src="<?=$storage->mapType->image();?>" class="tile_info" alt="<?=$storage->mapType->name;?>">
            </td>
            <td>
                Уровень #<?=$storage->level;?><br>
                Вместительность:
                <?=$storage->getCurrentWeight();?>/<?=$storage->getMaxWeight();?>

            </td>
        </tr>
        <tr>
            <td>
                <?php if ($storage->parentMap->moneys):?>
                    Склад содержит:
                <?php else:?>
                    Склад пуст:
                <?php endif;?>
                <?php foreach ($storage->parentMap->moneys as $money):?>
                    <div>
                        <?=$this->render('//users/_money', array(
                            'money' => $money->value,
                            'currencyId' => $money->currency_id
                        ));?>
                    </div>
                <?php endforeach;?>
            </td>
        </tr>
    </table>

<?php endif;?>
