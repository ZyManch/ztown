<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\ArenaQuery;

/**
 * This is the ActiveQuery class for [[models\Arena]].
 * @method ArenaQuery filterByArenaId($value, $criteria = null)
 * @method ArenaQuery filterByUserId($value, $criteria = null)
 * @method ArenaQuery filterByLevel($value, $criteria = null)
 * @method ArenaQuery filterByStatus($value, $criteria = null)
 * @method ArenaQuery filterByChanged($value, $criteria = null)
  * @method ArenaQuery orderByArenaId($order = Criteria::ASC)
  * @method ArenaQuery orderByUserId($order = Criteria::ASC)
  * @method ArenaQuery orderByLevel($order = Criteria::ASC)
  * @method ArenaQuery orderByStatus($order = Criteria::ASC)
  * @method ArenaQuery orderByChanged($order = Criteria::ASC)
  * @method ArenaQuery withUser($params = [])
  * @method ArenaQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseArenaQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Arena[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Arena|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\ArenaQuery     */
    public static function model()
    {
        return new \models\ArenaQuery(\models\Arena::class);
    }
}
