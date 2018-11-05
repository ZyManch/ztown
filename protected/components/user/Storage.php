<?php
namespace components\user;
use components\Config;
use components\price\Contract;
use models\Currency;
use models\Money;
use models\User;

/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 05.11.2018
 * Time: 9:40
 */
class Storage {

    /** @var User  */
    protected $_user;

    public function __construct(User $user) {
        $this->_user = $user;
    }


    public function getMoney($currencyId = Config::VALUTA_ID_DEFAULT, $mapId = null) {
        $money = $this->_findMoney($currencyId, $mapId);
        return $money ? $money->value : 0;
    }

    public function getMoneys() {
        $result = [];
        foreach ($this->_user->moneys as $money) {
            if (!isset($result[$money->currency_id])) {
                $result[$money->currency_id] = 0;
            }
            $result[$money->currency_id]+=$money->value;
        }
        return $result;
    }

    /**
     * @param int $currencyId
     * @param null $mapId
     * @param bool $createNew
     * @return Money|null
     * @throws \Exception
     */
    protected function _findMoney($currencyId = Config::VALUTA_ID_DEFAULT, $mapId = null, $createNew = false) {
        foreach ($this->_user->moneys as $money) {
            if ($money->currency_id != $currencyId) {
                continue;
            }
            if (!$money->map_id && $money->map_id!=$mapId) {
                continue;
            }
            return $money;
        }
        if (!$createNew) {
            return null;
        }
        $currency = Currency::getValutes($currencyId);
        if (!$currency->weight) {
            $mapId = null;
        } else if (!$mapId) {
            throw new \Exception('Missed map_id for money');
        }
        $money = new Money();
        $money->user_id = $this->_user->user_id;
        $money->currency_id = $currencyId;
        $money->map_id = $mapId;
        $money->value = 0;
        return $money;
    }

    public function canBuy(Contract $price, $mapId = null) {
        foreach ($price->getMoneys() as $currencyId => $value) {
            if (-$value > $this->getMoney($currencyId, $mapId)) {
                return false;
            }
        }
        return true;
    }


    public function spendMoney(Contract $price, $mapId = null) {
        if (!$this->canBuy($price, $mapId)) {
            return false;
        }
        foreach ($price->getMoneys() as $currencyId => $value) {
            $this->_changeMoney(
                $value,
                $currencyId,
                $mapId
            );
        }
        return true;
    }

    protected function _changeMoney($addToMoney, $currencyId = Config::VALUTA_ID_DEFAULT, $mapId = null) {
        $money = $this->_findMoney($currencyId, $mapId, true);
        $money->value+=$addToMoney;
        if (!$money->save()) {
            return false;
        }
        return true;
    }

}