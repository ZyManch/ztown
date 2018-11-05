<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\GroupQuery;

/**
 * This is the ActiveQuery class for [[models\Group]].
 * @method GroupQuery filterByGroupId($value, $criteria = null)
 * @method GroupQuery filterByName($value, $criteria = null)
 * @method GroupQuery filterByLowerName($value, $criteria = null)
 * @method GroupQuery filterByMens($value, $criteria = null)
 * @method GroupQuery filterByTaked($value, $criteria = null)
 * @method GroupQuery filterByBalls($value, $criteria = null)
 * @method GroupQuery filterByCanTake($value, $criteria = null)
 * @method GroupQuery filterByType($value, $criteria = null)
 * @method GroupQuery filterByStatus($value, $criteria = null)
 * @method GroupQuery filterByChanged($value, $criteria = null)
  * @method GroupQuery orderByGroupId($order = Criteria::ASC)
  * @method GroupQuery orderByName($order = Criteria::ASC)
  * @method GroupQuery orderByLowerName($order = Criteria::ASC)
  * @method GroupQuery orderByMens($order = Criteria::ASC)
  * @method GroupQuery orderByTaked($order = Criteria::ASC)
  * @method GroupQuery orderByBalls($order = Criteria::ASC)
  * @method GroupQuery orderByCanTake($order = Criteria::ASC)
  * @method GroupQuery orderByType($order = Criteria::ASC)
  * @method GroupQuery orderByStatus($order = Criteria::ASC)
  * @method GroupQuery orderByChanged($order = Criteria::ASC)
  * @method GroupQuery withForums($params = [])
  * @method GroupQuery joinWithForums($params = null, $joinType = 'LEFT JOIN')
  * @method GroupQuery withGroupQueries($params = [])
  * @method GroupQuery joinWithGroupQueries($params = null, $joinType = 'LEFT JOIN')
  * @method GroupQuery withMafiaInfos($params = [])
  * @method GroupQuery joinWithMafiaInfos($params = null, $joinType = 'LEFT JOIN')
  * @method GroupQuery withUsers($params = [])
  * @method GroupQuery joinWithUsers($params = null, $joinType = 'LEFT JOIN')
 */
class BaseGroupQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Group[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Group|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\GroupQuery     */
    public static function model()
    {
        return new \models\GroupQuery(\models\Group::class);
    }
}
