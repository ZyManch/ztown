<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\HouseQuery;

/**
 * This is the ActiveQuery class for [[models\House]].
 * @method HouseQuery filterByHouseId($value, $criteria = null)
 * @method HouseQuery filterByMapId($value, $criteria = null)
 * @method HouseQuery filterByUserId($value, $criteria = null)
 * @method HouseQuery filterByLastPay($value, $criteria = null)
 * @method HouseQuery filterByStatus($value, $criteria = null)
 * @method HouseQuery filterByChanged($value, $criteria = null)
  * @method HouseQuery orderByHouseId($order = Criteria::ASC)
  * @method HouseQuery orderByMapId($order = Criteria::ASC)
  * @method HouseQuery orderByUserId($order = Criteria::ASC)
  * @method HouseQuery orderByLastPay($order = Criteria::ASC)
  * @method HouseQuery orderByStatus($order = Criteria::ASC)
  * @method HouseQuery orderByChanged($order = Criteria::ASC)
  * @method HouseQuery withMap($params = [])
  * @method HouseQuery joinWithMap($params = null, $joinType = 'LEFT JOIN')
  * @method HouseQuery withUser($params = [])
  * @method HouseQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseHouseQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\House[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\House|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\HouseQuery     */
    public static function model()
    {
        return new \models\HouseQuery(\models\House::class);
    }
}
