<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\IncomeQuery;

/**
 * This is the ActiveQuery class for [[models\Income]].
 * @method IncomeQuery filterByIncomeId($value, $criteria = null)
 * @method IncomeQuery filterBySourceType($value, $criteria = null)
 * @method IncomeQuery filterBySourceId($value, $criteria = null)
 * @method IncomeQuery filterByMapTypeId($value, $criteria = null)
 * @method IncomeQuery filterByCurrencyId($value, $criteria = null)
 * @method IncomeQuery filterByIncomeType($value, $criteria = null)
 * @method IncomeQuery filterByValue($value, $criteria = null)
 * @method IncomeQuery filterByStatus($value, $criteria = null)
 * @method IncomeQuery filterByChanged($value, $criteria = null)
  * @method IncomeQuery orderByIncomeId($order = Criteria::ASC)
  * @method IncomeQuery orderBySourceType($order = Criteria::ASC)
  * @method IncomeQuery orderBySourceId($order = Criteria::ASC)
  * @method IncomeQuery orderByMapTypeId($order = Criteria::ASC)
  * @method IncomeQuery orderByCurrencyId($order = Criteria::ASC)
  * @method IncomeQuery orderByIncomeType($order = Criteria::ASC)
  * @method IncomeQuery orderByValue($order = Criteria::ASC)
  * @method IncomeQuery orderByStatus($order = Criteria::ASC)
  * @method IncomeQuery orderByChanged($order = Criteria::ASC)
  * @method IncomeQuery withCurrency($params = [])
  * @method IncomeQuery joinWithCurrency($params = null, $joinType = 'LEFT JOIN')
  * @method IncomeQuery withMapType($params = [])
  * @method IncomeQuery joinWithMapType($params = null, $joinType = 'LEFT JOIN')
 */
class BaseIncomeQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Income[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Income|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\IncomeQuery     */
    public static function model()
    {
        return new \models\IncomeQuery(\models\Income::class);
    }
}
