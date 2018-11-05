<?php
namespace components;

use components\price\Contract;
use components\price\Fake;
use models\base\BasePricePeer;
use models\Price;
use yii\base\Exception;

/**
 * Trait PriceTrait
 * @package components
 * @property Price[] $prices
 */
trait PriceTrait {


    public function getPrices() {
        if (!defined('static::OBJECT_TYPE')) {
            throw new Exception(static::class.'::OBJECT_TYPE is not defined');
        }
        return $this->hasMany(Price::class, [BasePricePeer::OBJECT_ID => reset($this->tableSchema->primaryKey)])->
            andOnCondition([BasePricePeer::OBJECT_TYPE => self::OBJECT_TYPE]);
    }

    /**
     * @param $action
     * @return Contract
     */
    public function getPriceForAction($action, $level = null) {
        foreach ($this->prices as $price) {
            if ($price->action !== $action) {
                continue;
            }
            if ($level && $level!=$price->level) {
                continue;
            }
            return clone $price;
        }
        return new Fake();
    }
    
}