<?php
/**
 * @var ActiveRecord $object
 * @var Price $price
 * @var float $markUp
 * @var \components\View $this
 */

use yii\db\ActiveRecord;

if (!isset($markUp)) {
    $markUp = 1;
}
?>
<?php foreach ($incomes as $income):?>
<?=$this->render('//users/_money', array(
     'money'      => round($income->value * $markUp),
     'currencyId' => $income->currency_id
));?>
<?php endforeach;?>