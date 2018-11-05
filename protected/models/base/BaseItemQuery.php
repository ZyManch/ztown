<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\ItemQuery;

/**
 * This is the ActiveQuery class for [[models\Item]].
 * @method ItemQuery filterByItemId($value, $criteria = null)
 * @method ItemQuery filterByName($value, $criteria = null)
 * @method ItemQuery filterByType($value, $criteria = null)
 * @method ItemQuery filterByGroup($value, $criteria = null)
 * @method ItemQuery filterByDelonuse($value, $criteria = null)
 * @method ItemQuery filterByStatId($value, $criteria = null)
 * @method ItemQuery filterByLevel($value, $criteria = null)
 * @method ItemQuery filterBySelling($value, $criteria = null)
 * @method ItemQuery filterByContent($value, $criteria = null)
 * @method ItemQuery filterByStatus($value, $criteria = null)
 * @method ItemQuery filterByChanged($value, $criteria = null)
  * @method ItemQuery orderByItemId($order = Criteria::ASC)
  * @method ItemQuery orderByName($order = Criteria::ASC)
  * @method ItemQuery orderByType($order = Criteria::ASC)
  * @method ItemQuery orderByGroup($order = Criteria::ASC)
  * @method ItemQuery orderByDelonuse($order = Criteria::ASC)
  * @method ItemQuery orderByStatId($order = Criteria::ASC)
  * @method ItemQuery orderByLevel($order = Criteria::ASC)
  * @method ItemQuery orderBySelling($order = Criteria::ASC)
  * @method ItemQuery orderByContent($order = Criteria::ASC)
  * @method ItemQuery orderByStatus($order = Criteria::ASC)
  * @method ItemQuery orderByChanged($order = Criteria::ASC)
  * @method ItemQuery withStat($params = [])
  * @method ItemQuery joinWithStat($params = null, $joinType = 'LEFT JOIN')
  * @method ItemQuery withItemBuieds($params = [])
  * @method ItemQuery joinWithItemBuieds($params = null, $joinType = 'LEFT JOIN')
  * @method ItemQuery withItemOpeneds($params = [])
  * @method ItemQuery joinWithItemOpeneds($params = null, $joinType = 'LEFT JOIN')
 */
class BaseItemQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Item[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Item|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\ItemQuery     */
    public static function model()
    {
        return new \models\ItemQuery(\models\Item::class);
    }
}
