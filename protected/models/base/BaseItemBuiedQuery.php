<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\ItemBuiedQuery;

/**
 * This is the ActiveQuery class for [[models\ItemBuied]].
 * @method ItemBuiedQuery filterByItemBuiedId($value, $criteria = null)
 * @method ItemBuiedQuery filterByItemId($value, $criteria = null)
 * @method ItemBuiedQuery filterByUserId($value, $criteria = null)
 * @method ItemBuiedQuery filterByStatId($value, $criteria = null)
 * @method ItemBuiedQuery filterByUsed($value, $criteria = null)
 * @method ItemBuiedQuery filterByLevel($value, $criteria = null)
 * @method ItemBuiedQuery filterByLight($value, $criteria = null)
 * @method ItemBuiedQuery filterByStatus($value, $criteria = null)
 * @method ItemBuiedQuery filterByChanged($value, $criteria = null)
  * @method ItemBuiedQuery orderByItemBuiedId($order = Criteria::ASC)
  * @method ItemBuiedQuery orderByItemId($order = Criteria::ASC)
  * @method ItemBuiedQuery orderByUserId($order = Criteria::ASC)
  * @method ItemBuiedQuery orderByStatId($order = Criteria::ASC)
  * @method ItemBuiedQuery orderByUsed($order = Criteria::ASC)
  * @method ItemBuiedQuery orderByLevel($order = Criteria::ASC)
  * @method ItemBuiedQuery orderByLight($order = Criteria::ASC)
  * @method ItemBuiedQuery orderByStatus($order = Criteria::ASC)
  * @method ItemBuiedQuery orderByChanged($order = Criteria::ASC)
  * @method ItemBuiedQuery withItem($params = [])
  * @method ItemBuiedQuery joinWithItem($params = null, $joinType = 'LEFT JOIN')
  * @method ItemBuiedQuery withStat($params = [])
  * @method ItemBuiedQuery joinWithStat($params = null, $joinType = 'LEFT JOIN')
  * @method ItemBuiedQuery withUser($params = [])
  * @method ItemBuiedQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseItemBuiedQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\ItemBuied[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\ItemBuied|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\ItemBuiedQuery     */
    public static function model()
    {
        return new \models\ItemBuiedQuery(\models\ItemBuied::class);
    }
}
