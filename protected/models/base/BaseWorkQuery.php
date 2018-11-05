<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\WorkQuery;

/**
 * This is the ActiveQuery class for [[models\Work]].
 * @method WorkQuery filterByWorkId($value, $criteria = null)
 * @method WorkQuery filterByMapTypeId($value, $criteria = null)
 * @method WorkQuery filterByTitle($value, $criteria = null)
 * @method WorkQuery filterByImage($value, $criteria = null)
 * @method WorkQuery filterByDescription($value, $criteria = null)
 * @method WorkQuery filterByPriceId($value, $criteria = null)
 * @method WorkQuery filterByStatus($value, $criteria = null)
 * @method WorkQuery filterByChanged($value, $criteria = null)
  * @method WorkQuery orderByWorkId($order = Criteria::ASC)
  * @method WorkQuery orderByMapTypeId($order = Criteria::ASC)
  * @method WorkQuery orderByTitle($order = Criteria::ASC)
  * @method WorkQuery orderByImage($order = Criteria::ASC)
  * @method WorkQuery orderByDescription($order = Criteria::ASC)
  * @method WorkQuery orderByPriceId($order = Criteria::ASC)
  * @method WorkQuery orderByStatus($order = Criteria::ASC)
  * @method WorkQuery orderByChanged($order = Criteria::ASC)
  * @method WorkQuery withMapWorks($params = [])
  * @method WorkQuery joinWithMapWorks($params = null, $joinType = 'LEFT JOIN')
  * @method WorkQuery withMapType($params = [])
  * @method WorkQuery joinWithMapType($params = null, $joinType = 'LEFT JOIN')
  * @method WorkQuery withPrice($params = [])
  * @method WorkQuery joinWithPrice($params = null, $joinType = 'LEFT JOIN')
  * @method WorkQuery withWorkBonuses($params = [])
  * @method WorkQuery joinWithWorkBonuses($params = null, $joinType = 'LEFT JOIN')
 */
class BaseWorkQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Work[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Work|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\WorkQuery     */
    public static function model()
    {
        return new \models\WorkQuery(\models\Work::class);
    }
}
