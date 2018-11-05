<?php
/**
 * @var Currency $currency
 */
?>
<?php foreach ($this->currencies as $pos => $currency):?>
$("#currency<?=$currency->id;?>").html("<?=sprintf('%.2f %s',$currency->course, Currency::getDefaultValute()->ext);?>");
$("#val<?=$currency->id;?>").attr("src","images/download/currency<?=$currency->id;?>.png?"+Math.random());
tr<?=$currency->id;?>.set_new_curse(<?=$currency->course;?>);
tr<?=$currency->id;?>.setdelay(<?=max($currency->lastChange(), 2);?>);
<?php endforeach;?>