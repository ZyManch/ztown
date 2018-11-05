<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\MoneyQuery;

/**
 * This is the ActiveQuery class for [[models\Money]].
 * @method MoneyQuery filterByMoneyId($value, $criteria = null)
 * @method MoneyQuery filterByUserId($value, $criteria = null)
 * @method MoneyQuery filterByMapId($value, $criteria = null)
 * @method MoneyQuery filterByCurrencyId($value, $criteria = null)
 * @method MoneyQuery filterByValue($value, $criteria = null)
 * @method MoneyQuery filterByStatus($value, $criteria = null)
 * @method MoneyQuery filterByChanged($value, $criteria = null)
  * @method MoneyQuery orderByMoneyId($order = Criteria::ASC)
  * @method MoneyQuery orderByUserId($order = Criteria::ASC)
  * @method MoneyQuery orderByMapId($order = Criteria::ASC)
  * @method MoneyQuery orderByCurrencyId($order = Criteria::ASC)
  * @method MoneyQuery orderByValue($order = Criteria::ASC)
  * @method MoneyQuery orderByStatus($order = Criteria::ASC)
  * @method MoneyQuery orderByChanged($order = Criteria::ASC)
  * @method MoneyQuery withCurrency($params = [])
  * @method MoneyQuery joinWithCurrency($params = null, $joinType = 'LEFT JOIN')
  * @method MoneyQuery withMap($params = [])
  * @method MoneyQuery joinWithMap($params = null, $joinType = 'LEFT JOIN')
  * @method MoneyQuery withUser($params = [])
  * @method MoneyQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseMoneyQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Money[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Money|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\MoneyQuery     */
    public static function model()
    {
        return new \models\MoneyQuery(\models\Money::class);
    }
}
