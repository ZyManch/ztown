<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\CurrencyQuery;

/**
 * This is the ActiveQuery class for [[models\Currency]].
 * @method CurrencyQuery filterByCurrencyId($value, $criteria = null)
 * @method CurrencyQuery filterByTitle($value, $criteria = null)
 * @method CurrencyQuery filterByExt($value, $criteria = null)
 * @method CurrencyQuery filterByColor($value, $criteria = null)
 * @method CurrencyQuery filterByType($value, $criteria = null)
 * @method CurrencyQuery filterByLevel($value, $criteria = null)
 * @method CurrencyQuery filterByDefaultCourse($value, $criteria = null)
 * @method CurrencyQuery filterByCourse($value, $criteria = null)
 * @method CurrencyQuery filterByWeight($value, $criteria = null)
 * @method CurrencyQuery filterByFixedValute($value, $criteria = null)
 * @method CurrencyQuery filterByCanBuy($value, $criteria = null)
 * @method CurrencyQuery filterByStatus($value, $criteria = null)
 * @method CurrencyQuery filterByChanged($value, $criteria = null)
  * @method CurrencyQuery orderByCurrencyId($order = Criteria::ASC)
  * @method CurrencyQuery orderByTitle($order = Criteria::ASC)
  * @method CurrencyQuery orderByExt($order = Criteria::ASC)
  * @method CurrencyQuery orderByColor($order = Criteria::ASC)
  * @method CurrencyQuery orderByType($order = Criteria::ASC)
  * @method CurrencyQuery orderByLevel($order = Criteria::ASC)
  * @method CurrencyQuery orderByDefaultCourse($order = Criteria::ASC)
  * @method CurrencyQuery orderByCourse($order = Criteria::ASC)
  * @method CurrencyQuery orderByWeight($order = Criteria::ASC)
  * @method CurrencyQuery orderByFixedValute($order = Criteria::ASC)
  * @method CurrencyQuery orderByCanBuy($order = Criteria::ASC)
  * @method CurrencyQuery orderByStatus($order = Criteria::ASC)
  * @method CurrencyQuery orderByChanged($order = Criteria::ASC)
  * @method CurrencyQuery withCourses($params = [])
  * @method CurrencyQuery joinWithCourses($params = null, $joinType = 'LEFT JOIN')
  * @method CurrencyQuery withIncomes($params = [])
  * @method CurrencyQuery joinWithIncomes($params = null, $joinType = 'LEFT JOIN')
  * @method CurrencyQuery withMoneys($params = [])
  * @method CurrencyQuery joinWithMoneys($params = null, $joinType = 'LEFT JOIN')
  * @method CurrencyQuery withPriceValues($params = [])
  * @method CurrencyQuery joinWithPriceValues($params = null, $joinType = 'LEFT JOIN')
  * @method CurrencyQuery withUserIncomes($params = [])
  * @method CurrencyQuery joinWithUserIncomes($params = null, $joinType = 'LEFT JOIN')
 */
class BaseCurrencyQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Currency[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Currency|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\CurrencyQuery     */
    public static function model()
    {
        return new \models\CurrencyQuery(\models\Currency::class);
    }
}
