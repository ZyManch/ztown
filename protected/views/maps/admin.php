<?php
/**
 * @var \components\View $this
 * @var array $map
 * @var int $centerX
 * @var int $centerY
 * @var array $natures
 * @var array $mapTypes
 */

use components\Html;

$this->registerCssFile('/css/map.css');
$this->registerCssFile('/css/tiles.css');
$x = $centerX - models\Map::MAP_VIEW_SIZE;
$y = $centerY - models\Map::MAP_VIEW_SIZE;
?>
<div id="map" style="float:left">
    <?php foreach ($map as $i => $mapRow): ?>
        <?php foreach ($mapRow as $j => $tile):?>
            <div class="mapitem item<?=$i;?>_<?=$j;?>" id="item<?=$i;?>_<?=$j;?>">
                <div class="tile tile<?=$tile['map_type_id'];?> removed_tile" x="<?=($j+$x);?>" y="<?=($i+$y);?>">

                </div>
            </div>
        <?php endforeach;?>
    <?php endforeach;?>
    <?=Html::a('<div class="to_left"></div>', array('maps/admin', 'x' => $centerX, 'y' => $centerY + 1));?>
    <?=Html::a('<div class="to_right"></div>', array('maps/admin', 'x' => $centerX , 'y' => $centerY - 1));?>
    <?=Html::a('<div class="to_top"></div>', array('maps/admin', 'x' => $centerX - 1, 'y' => $centerY));?>
    <?=Html::a('<div class="to_bottom"></div>', array('maps/admin', 'x' => $centerX + 1, 'y' => $centerY));?>
</div>


<table cellpadding="0" cellspacing="0" class="default moved">
    <?php foreach ($mapTypes as $name => $items):?>
        <tr><th onclick="$('#tbody_<?=$name;?>').slideToggle();" colspan="2">
        <?=$name;?></th></tr>
        <tbody style="display:none" id="tbody_<?=$name;?>">
        <?php for($i=0;$i<sizeof($items);$i+=2):?>
            <tr>
                <td im="<?=$items[$i]->map_type_id;?>">
                    <img src="images/town/<?=$items[$i]->type;?>/tile<?=$items[$i]->map_type_id;?>.png"/>
                    <br><?=$items[$i]->name;?>
                </td>
                <?php if (isset($items[$i+1])):?>
                <td im="<?=$items[$i+1]->map_type_id;?>">
                    <img src="images/town/<?=$items[$i+1]->type;?>/tile<?=$items[$i+1]->map_type_id;?>.png"/>
                    <br><?=$items[$i+1]->name;?>
                </td>
                <?php else:?>
                <td>&nbsp;</td>
                <?php endif;?>
            </tr>
        <?php endfor;?>
        </tbody>
    <?php endforeach;?>
</table>