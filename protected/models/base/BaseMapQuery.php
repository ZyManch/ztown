<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\MapQuery;

/**
 * This is the ActiveQuery class for [[models\Map]].
 * @method MapQuery filterByMapId($value, $criteria = null)
 * @method MapQuery filterByParentMapId($value, $criteria = null)
 * @method MapQuery filterByLandTypeId($value, $criteria = null)
 * @method MapQuery filterByMapTypeId($value, $criteria = null)
 * @method MapQuery filterByX($value, $criteria = null)
 * @method MapQuery filterByY($value, $criteria = null)
 * @method MapQuery filterByUserId($value, $criteria = null)
 * @method MapQuery filterByStreetId($value, $criteria = null)
 * @method MapQuery filterByRoofId($value, $criteria = null)
 * @method MapQuery filterByHouse($value, $criteria = null)
 * @method MapQuery filterByLastSell($value, $criteria = null)
 * @method MapQuery filterByParam2($value, $criteria = null)
 * @method MapQuery filterByLevel($value, $criteria = null)
 * @method MapQuery filterByMarkup($value, $criteria = null)
 * @method MapQuery filterByStatus($value, $criteria = null)
 * @method MapQuery filterByChanged($value, $criteria = null)
  * @method MapQuery orderByMapId($order = Criteria::ASC)
  * @method MapQuery orderByParentMapId($order = Criteria::ASC)
  * @method MapQuery orderByLandTypeId($order = Criteria::ASC)
  * @method MapQuery orderByMapTypeId($order = Criteria::ASC)
  * @method MapQuery orderByX($order = Criteria::ASC)
  * @method MapQuery orderByY($order = Criteria::ASC)
  * @method MapQuery orderByUserId($order = Criteria::ASC)
  * @method MapQuery orderByStreetId($order = Criteria::ASC)
  * @method MapQuery orderByRoofId($order = Criteria::ASC)
  * @method MapQuery orderByHouse($order = Criteria::ASC)
  * @method MapQuery orderByLastSell($order = Criteria::ASC)
  * @method MapQuery orderByParam2($order = Criteria::ASC)
  * @method MapQuery orderByLevel($order = Criteria::ASC)
  * @method MapQuery orderByMarkup($order = Criteria::ASC)
  * @method MapQuery orderByStatus($order = Criteria::ASC)
  * @method MapQuery orderByChanged($order = Criteria::ASC)
  * @method MapQuery withHouses($params = [])
  * @method MapQuery joinWithHouses($params = null, $joinType = 'LEFT JOIN')
  * @method MapQuery withMafiaInfos($params = [])
  * @method MapQuery joinWithMafiaInfos($params = null, $joinType = 'LEFT JOIN')
  * @method MapQuery withLandType($params = [])
  * @method MapQuery joinWithLandType($params = null, $joinType = 'LEFT JOIN')
  * @method MapQuery withMapType($params = [])
  * @method MapQuery joinWithMapType($params = null, $joinType = 'LEFT JOIN')
  * @method MapQuery withParentMap($params = [])
  * @method MapQuery joinWithParentMap($params = null, $joinType = 'LEFT JOIN')
  * @method MapQuery withMaps($params = [])
  * @method MapQuery joinWithMaps($params = null, $joinType = 'LEFT JOIN')
  * @method MapQuery withRoof($params = [])
  * @method MapQuery joinWithRoof($params = null, $joinType = 'LEFT JOIN')
  * @method MapQuery withStreet($params = [])
  * @method MapQuery joinWithStreet($params = null, $joinType = 'LEFT JOIN')
  * @method MapQuery withUser($params = [])
  * @method MapQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
  * @method MapQuery withMapWorks($params = [])
  * @method MapQuery joinWithMapWorks($params = null, $joinType = 'LEFT JOIN')
  * @method MapQuery withMoneys($params = [])
  * @method MapQuery joinWithMoneys($params = null, $joinType = 'LEFT JOIN')
 */
class BaseMapQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Map[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Map|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\MapQuery     */
    public static function model()
    {
        return new \models\MapQuery(\models\Map::class);
    }
}
