<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 05.06.14
 * Time: 17:23
 * @var MapType[] $mapTypes
 */
foreach ($mapTypes as $mapType):
$size = $mapType->size();
?>
.tile<?=$mapType->id;?>{
    background-image:url(../<?=$mapType->image();?>);
    position:relative;
    left:<?=round((92-$size[0])/2);?>px;
    top:<?=round(48-$size[1]);?>px;
    width:<?=$size[0] ;?>px;
    height:<?=$size[1] ;?>px;
}
<?php if (file_exists($mapType->image('hover'))):?>
.hover .tile<?=$mapType->id;?>{
    background-image:url(../<?=$mapType->image('hover');?>);
}
<?php endif;?>
<?php if (file_exists($mapType->image('disabled'))):?>
.disabled .tile<?=$mapType->id;?>{
    background-image:url(../<?=$mapType->image('disabled');?>);
}
<?php endif;?>
<?php endforeach;?>