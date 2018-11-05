<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\MapTypeQuery;

/**
 * This is the ActiveQuery class for [[models\MapType]].
 * @method MapTypeQuery filterByMapTypeId($value, $criteria = null)
 * @method MapTypeQuery filterByImage($value, $criteria = null)
 * @method MapTypeQuery filterByName($value, $criteria = null)
 * @method MapTypeQuery filterByController($value, $criteria = null)
 * @method MapTypeQuery filterByModel($value, $criteria = null)
 * @method MapTypeQuery filterByInfo($value, $criteria = null)
 * @method MapTypeQuery filterByParams($value, $criteria = null)
 * @method MapTypeQuery filterByMarkupMax($value, $criteria = null)
 * @method MapTypeQuery filterByLevelMax($value, $criteria = null)
 * @method MapTypeQuery filterByBuildTypeId($value, $criteria = null)
 * @method MapTypeQuery filterByMainTypeId($value, $criteria = null)
 * @method MapTypeQuery filterByCanBuild($value, $criteria = null)
 * @method MapTypeQuery filterByCanTake($value, $criteria = null)
 * @method MapTypeQuery filterByType($value, $criteria = null)
 * @method MapTypeQuery filterByStatus($value, $criteria = null)
 * @method MapTypeQuery filterByChanged($value, $criteria = null)
  * @method MapTypeQuery orderByMapTypeId($order = Criteria::ASC)
  * @method MapTypeQuery orderByImage($order = Criteria::ASC)
  * @method MapTypeQuery orderByName($order = Criteria::ASC)
  * @method MapTypeQuery orderByController($order = Criteria::ASC)
  * @method MapTypeQuery orderByModel($order = Criteria::ASC)
  * @method MapTypeQuery orderByInfo($order = Criteria::ASC)
  * @method MapTypeQuery orderByParams($order = Criteria::ASC)
  * @method MapTypeQuery orderByMarkupMax($order = Criteria::ASC)
  * @method MapTypeQuery orderByLevelMax($order = Criteria::ASC)
  * @method MapTypeQuery orderByBuildTypeId($order = Criteria::ASC)
  * @method MapTypeQuery orderByMainTypeId($order = Criteria::ASC)
  * @method MapTypeQuery orderByCanBuild($order = Criteria::ASC)
  * @method MapTypeQuery orderByCanTake($order = Criteria::ASC)
  * @method MapTypeQuery orderByType($order = Criteria::ASC)
  * @method MapTypeQuery orderByStatus($order = Criteria::ASC)
  * @method MapTypeQuery orderByChanged($order = Criteria::ASC)
  * @method MapTypeQuery withIncomes($params = [])
  * @method MapTypeQuery joinWithIncomes($params = null, $joinType = 'LEFT JOIN')
  * @method MapTypeQuery withMaps($params = [])
  * @method MapTypeQuery joinWithMaps($params = null, $joinType = 'LEFT JOIN')
  * @method MapTypeQuery withMaps0($params = [])
  * @method MapTypeQuery joinWithMaps0($params = null, $joinType = 'LEFT JOIN')
  * @method MapTypeQuery withBuildType($params = [])
  * @method MapTypeQuery joinWithBuildType($params = null, $joinType = 'LEFT JOIN')
  * @method MapTypeQuery withMapTypes($params = [])
  * @method MapTypeQuery joinWithMapTypes($params = null, $joinType = 'LEFT JOIN')
  * @method MapTypeQuery withMainType($params = [])
  * @method MapTypeQuery joinWithMainType($params = null, $joinType = 'LEFT JOIN')
  * @method MapTypeQuery withMapTypes0($params = [])
  * @method MapTypeQuery joinWithMapTypes0($params = null, $joinType = 'LEFT JOIN')
  * @method MapTypeQuery withWorks($params = [])
  * @method MapTypeQuery joinWithWorks($params = null, $joinType = 'LEFT JOIN')
 */
class BaseMapTypeQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\MapType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\MapType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\MapTypeQuery     */
    public static function model()
    {
        return new \models\MapTypeQuery(\models\MapType::class);
    }
}
