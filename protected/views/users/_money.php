<?php
/**
 * @var int $money
 * @var int $currencyId
 * @var models\Currency $currency
 * @var int $round
 * @var \components\View $this
 */
if (!isset($currency) && isset($currencyId)) {
    $currency = models\Currency::getValutes($currencyId);
} else if(!isset($currency)) {
    $currency = models\Currency::getDefaultValute();
}
?>
<span class="money" <?php if(isset($id)):?>id="<?=$id;?>"<?php endif;?> currency="<?=$currency->currency_id;?>"
    style="color:<?php if($money < 0):?>red<?php else:?>#<?=$currency->color;?><?php endif;?>">
    <?=number_format($money, isset($round) ? $round : 0, '.', ',');?><?=$currency->ext;?>
</span>