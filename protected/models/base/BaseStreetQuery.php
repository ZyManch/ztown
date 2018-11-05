<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\StreetQuery;

/**
 * This is the ActiveQuery class for [[models\Street]].
 * @method StreetQuery filterByStreetId($value, $criteria = null)
 * @method StreetQuery filterByName($value, $criteria = null)
 * @method StreetQuery filterByLeftX($value, $criteria = null)
 * @method StreetQuery filterByRightX($value, $criteria = null)
 * @method StreetQuery filterByTopY($value, $criteria = null)
 * @method StreetQuery filterByBottomY($value, $criteria = null)
 * @method StreetQuery filterByStatus($value, $criteria = null)
 * @method StreetQuery filterByChanged($value, $criteria = null)
  * @method StreetQuery orderByStreetId($order = Criteria::ASC)
  * @method StreetQuery orderByName($order = Criteria::ASC)
  * @method StreetQuery orderByLeftX($order = Criteria::ASC)
  * @method StreetQuery orderByRightX($order = Criteria::ASC)
  * @method StreetQuery orderByTopY($order = Criteria::ASC)
  * @method StreetQuery orderByBottomY($order = Criteria::ASC)
  * @method StreetQuery orderByStatus($order = Criteria::ASC)
  * @method StreetQuery orderByChanged($order = Criteria::ASC)
  * @method StreetQuery withMaps($params = [])
  * @method StreetQuery joinWithMaps($params = null, $joinType = 'LEFT JOIN')
 */
class BaseStreetQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Street[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Street|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\StreetQuery     */
    public static function model()
    {
        return new \models\StreetQuery(\models\Street::class);
    }
}
