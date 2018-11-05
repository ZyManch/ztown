<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\UserIncomeQuery;

/**
 * This is the ActiveQuery class for [[models\UserIncome]].
 * @method UserIncomeQuery filterByUserIncomeId($value, $criteria = null)
 * @method UserIncomeQuery filterByUserId($value, $criteria = null)
 * @method UserIncomeQuery filterByCurrencyId($value, $criteria = null)
 * @method UserIncomeQuery filterBySourceType($value, $criteria = null)
 * @method UserIncomeQuery filterBySourceId($value, $criteria = null)
 * @method UserIncomeQuery filterByIncomeType($value, $criteria = null)
 * @method UserIncomeQuery filterByValue($value, $criteria = null)
 * @method UserIncomeQuery filterByStatus($value, $criteria = null)
 * @method UserIncomeQuery filterByChanged($value, $criteria = null)
  * @method UserIncomeQuery orderByUserIncomeId($order = Criteria::ASC)
  * @method UserIncomeQuery orderByUserId($order = Criteria::ASC)
  * @method UserIncomeQuery orderByCurrencyId($order = Criteria::ASC)
  * @method UserIncomeQuery orderBySourceType($order = Criteria::ASC)
  * @method UserIncomeQuery orderBySourceId($order = Criteria::ASC)
  * @method UserIncomeQuery orderByIncomeType($order = Criteria::ASC)
  * @method UserIncomeQuery orderByValue($order = Criteria::ASC)
  * @method UserIncomeQuery orderByStatus($order = Criteria::ASC)
  * @method UserIncomeQuery orderByChanged($order = Criteria::ASC)
  * @method UserIncomeQuery withCurrency($params = [])
  * @method UserIncomeQuery joinWithCurrency($params = null, $joinType = 'LEFT JOIN')
  * @method UserIncomeQuery withUser($params = [])
  * @method UserIncomeQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseUserIncomeQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\UserIncome[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\UserIncome|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\UserIncomeQuery     */
    public static function model()
    {
        return new \models\UserIncomeQuery(\models\UserIncome::class);
    }
}
