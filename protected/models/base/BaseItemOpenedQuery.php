<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\ItemOpenedQuery;

/**
 * This is the ActiveQuery class for [[models\ItemOpened]].
 * @method ItemOpenedQuery filterByItemOpenedId($value, $criteria = null)
 * @method ItemOpenedQuery filterByItemId($value, $criteria = null)
 * @method ItemOpenedQuery filterByUserId($value, $criteria = null)
 * @method ItemOpenedQuery filterByStatus($value, $criteria = null)
 * @method ItemOpenedQuery filterByChanged($value, $criteria = null)
  * @method ItemOpenedQuery orderByItemOpenedId($order = Criteria::ASC)
  * @method ItemOpenedQuery orderByItemId($order = Criteria::ASC)
  * @method ItemOpenedQuery orderByUserId($order = Criteria::ASC)
  * @method ItemOpenedQuery orderByStatus($order = Criteria::ASC)
  * @method ItemOpenedQuery orderByChanged($order = Criteria::ASC)
  * @method ItemOpenedQuery withItem($params = [])
  * @method ItemOpenedQuery joinWithItem($params = null, $joinType = 'LEFT JOIN')
  * @method ItemOpenedQuery withUser($params = [])
  * @method ItemOpenedQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseItemOpenedQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\ItemOpened[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\ItemOpened|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\ItemOpenedQuery     */
    public static function model()
    {
        return new \models\ItemOpenedQuery(\models\ItemOpened::class);
    }
}
