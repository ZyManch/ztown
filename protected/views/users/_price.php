<?php
/**
 * @var ActiveRecord $object
 * @var Price $price
 * @var \components\price\Contract $price
 * @var float $markUp
 * @var \components\View $this
 */

use yii\db\ActiveRecord;
?>
<?php foreach ($price->getMoneys() as $currencyId => $value):?>
    <?=$this->render('//users/_money', array(
          'money' => $value,
          'currencyId' => $currencyId
     ));?>
<?php endforeach;?>