<?php
/**
 * @var string $type
 * @var ItemBuied $info
 */
?>
<?php if($info):?>
<?php $class = ($info->id?' item'.$info->item->id:'');?>
<div class="item_profile <?=strtolower($type).$class;?>">
    <div class="autohint">
        <h3><?=$info->item->name;?></h3>
        <div><?=$info->item->content;?></div>
        <?php if($info->item->stat):?>
            <?=$this->render('//stats/_view', array('stat' => $info->item->stat));?>
        <?php endif;?>
    </div>
    <?php if($info->level):?>
        <div class="item_lvl item_<?=strtolower($info->light);?>">
            <div class="autohint">
            <h3>Улучшен #<?=$info->level;?></h3>
            <?=$this->render('//stats/_view', array('stat' => $info->stat));?>
            </div>
        <?=$info->level;?></div>
    <?php endif;?>
    </div>
<?php else:?>
    <div class="item_profile <?=strtolower($type);?>"></div>
<?php endif;?>