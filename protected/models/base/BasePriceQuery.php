<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\PriceQuery;

/**
 * This is the ActiveQuery class for [[models\Price]].
 * @method PriceQuery filterByPriceId($value, $criteria = null)
 * @method PriceQuery filterByAction($value, $criteria = null)
 * @method PriceQuery filterByObjectType($value, $criteria = null)
 * @method PriceQuery filterByObjectId($value, $criteria = null)
 * @method PriceQuery filterByLevel($value, $criteria = null)
 * @method PriceQuery filterByStatus($value, $criteria = null)
 * @method PriceQuery filterByChanged($value, $criteria = null)
  * @method PriceQuery orderByPriceId($order = Criteria::ASC)
  * @method PriceQuery orderByAction($order = Criteria::ASC)
  * @method PriceQuery orderByObjectType($order = Criteria::ASC)
  * @method PriceQuery orderByObjectId($order = Criteria::ASC)
  * @method PriceQuery orderByLevel($order = Criteria::ASC)
  * @method PriceQuery orderByStatus($order = Criteria::ASC)
  * @method PriceQuery orderByChanged($order = Criteria::ASC)
  * @method PriceQuery withPriceValues($params = [])
  * @method PriceQuery joinWithPriceValues($params = null, $joinType = 'LEFT JOIN')
  * @method PriceQuery withWorks($params = [])
  * @method PriceQuery joinWithWorks($params = null, $joinType = 'LEFT JOIN')
 */
class BasePriceQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Price[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Price|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\PriceQuery     */
    public static function model()
    {
        return new \models\PriceQuery(\models\Price::class);
    }
}
