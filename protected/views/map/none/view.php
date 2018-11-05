<?php
/**
 * @var models\MapType[] $mapTypes
 * @var models\MapType $mapType
 * @var models\Map $map
 * @var \components\View $this
 */

use components\Html;
?>
<table class="default" cellpadding="0" cellspacing="0">
    <tr>
        <th colspan="2">Построить</th>
    </tr>
    <?php foreach ($mapTypes as $buildMapType):?>
        <tr<?php if($buildMapType->map_type_id == $mapType->map_type_id):?> class="active"<?php endif; ?>>
            <td>
                <img src="<?=$buildMapType->image();?>" class="tile_info" alt="<?=$buildMapType->name;?>">
            </td>
            <td valign="top">
                <h3>
                    <?=$buildMapType->name;?>
                    <?php if ($buildMapType->map_type_id == $mapType->map_type_id):?>
                        <?php if ($map->hasMaxLevel()):?>
                            #<?=$map->level;?> (максимум)
                        <?php else:?>
                            #<?=$map->level+1;?>
                        <?php endif;?>
                    <?php else:?>
                        #1
                    <?php endif;?>
                </h3>


                <?php if ($buildMapType->info):?>
                    <hr>
                    <?=$buildMapType->info;?>
                <?php endif;?>

                <?php $price = $buildMapType->getPriceIncome($map->level);?>
                <?php if ($price->getMoneys()):?>
                    <hr>
                    Доход:
                    <?=$this->render('//users/_price',['price'=>$price]);?><br>
                <?php endif;?>

                <?php if ($buildMapType->map_type_id !== $mapType->map_type_id):?>
                    <hr>
                    <?=Html::moneyButtonByPrices(
                       'Построить',
                       'images/info/bay.png',
                       $buildMapType->getPriceForBuild(
                           $map
                       ),
                       [
                           'style' => 'width: 250px',
                           'href' => $map->getUrl('build',['map_type_id' => $buildMapType->map_type_id])
                        ]
                    );?>
                <?php elseif(!$map->hasMaxLevel()):?>
                    <hr>
                    <?=Html::moneyButtonByPrices(
                        'Улучшить',
                        'images/info/bay.png',
                        $buildMapType->getPriceForUpdate($map->level+1),
                        [
                            'style' => 'width: 250px',
                            'href' => $map->getUrl('upgrade')
                        ]
                    );?>
                <?php endif;?>

            </td>
        </tr>
        <?php endforeach; ?>
</table>