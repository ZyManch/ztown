<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\PriceValueQuery;

/**
 * This is the ActiveQuery class for [[models\PriceValue]].
 * @method PriceValueQuery filterByPriceValueId($value, $criteria = null)
 * @method PriceValueQuery filterByPriceId($value, $criteria = null)
 * @method PriceValueQuery filterByCurrencyId($value, $criteria = null)
 * @method PriceValueQuery filterByValue($value, $criteria = null)
 * @method PriceValueQuery filterByStatus($value, $criteria = null)
 * @method PriceValueQuery filterByChanged($value, $criteria = null)
  * @method PriceValueQuery orderByPriceValueId($order = Criteria::ASC)
  * @method PriceValueQuery orderByPriceId($order = Criteria::ASC)
  * @method PriceValueQuery orderByCurrencyId($order = Criteria::ASC)
  * @method PriceValueQuery orderByValue($order = Criteria::ASC)
  * @method PriceValueQuery orderByStatus($order = Criteria::ASC)
  * @method PriceValueQuery orderByChanged($order = Criteria::ASC)
  * @method PriceValueQuery withCurrency($params = [])
  * @method PriceValueQuery joinWithCurrency($params = null, $joinType = 'LEFT JOIN')
  * @method PriceValueQuery withPrice($params = [])
  * @method PriceValueQuery joinWithPrice($params = null, $joinType = 'LEFT JOIN')
 */
class BasePriceValueQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\PriceValue[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\PriceValue|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\PriceValueQuery     */
    public static function model()
    {
        return new \models\PriceValueQuery(\models\PriceValue::class);
    }
}
