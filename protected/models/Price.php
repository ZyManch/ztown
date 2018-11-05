<?php

namespace models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property string $price_id
 * @property string $object_type
 * @property string $object_id
 * @property string $currency_id
 * @property string $value
 * @property string $status
 * @property string $changed
 *
 * @property Currency $currency
 * @property Work[] $works
 */
class Price extends base\BasePrice implements \components\price\Contract{

    const ACTION_UPDATE = 'update';
    const ACTION_INCOME = 'income';

    protected $_revert = false;
    protected $_markUp = 1;

    public function addToUser(User $user, $markUp = 1) {
        $user->changeMoney($markUp * $this->value, false, $this->currency_id);
    }

    public function removeFromUser(User $user, $markUp = 1) {
        $user->changeMoney(- $markUp * $this->value, false, $this->currency_id);
    }


    public function getMoneys() {
        $result = [];
        foreach ($this->priceValues as $value) {
            $result[$value->currency_id] = round($value->value * ($this->_revert ? -1 : 1) * $this->_markUp);
        }
        return $result;
    }

    public function revert() {
        $this->_revert = !$this->_revert;
        return $this;
    }

    public function markUp($markUp) {
        $this->_markUp = $markUp;
        return $this;
    }

}