<?php
namespace components\price;
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 03.11.2018
 * Time: 10:30
 */
class PriceMerge implements Contract{

    protected $_result = [];

    public function __construct() {
        /** @var Contract[] $prices */
        $prices = func_get_args();
        foreach ($prices as $price) {
            if ($price === null) {
                continue;
            }
            foreach ($price->getMoneys() as $currency => $money) {
                if (!isset($this->_result[$currency])) {
                    $this->_result[$currency] = 0;
                }
                $this->_result[$currency]+=$money;
            }
        }
    }

    public function getMoneys() {
        return array_map('round',$this->_result);
    }

    public function revert() {
        return $this->markUp(-1);
    }

    public function markUp($markUp) {
        foreach ($this->_result as $currency => $money) {
            $this->_result[$currency] = $money * $markUp;
        }
        return $this;
    }

}