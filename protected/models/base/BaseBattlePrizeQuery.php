<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\BattlePrizeQuery;

/**
 * This is the ActiveQuery class for [[models\BattlePrize]].
 * @method BattlePrizeQuery filterByBattlePrizeId($value, $criteria = null)
 * @method BattlePrizeQuery filterByBattleId($value, $criteria = null)
 * @method BattlePrizeQuery filterByUserId($value, $criteria = null)
 * @method BattlePrizeQuery filterByPrizeId($value, $criteria = null)
 * @method BattlePrizeQuery filterByPrizeType($value, $criteria = null)
 * @method BattlePrizeQuery filterByValue($value, $criteria = null)
 * @method BattlePrizeQuery filterByStatus($value, $criteria = null)
 * @method BattlePrizeQuery filterByChanged($value, $criteria = null)
  * @method BattlePrizeQuery orderByBattlePrizeId($order = Criteria::ASC)
  * @method BattlePrizeQuery orderByBattleId($order = Criteria::ASC)
  * @method BattlePrizeQuery orderByUserId($order = Criteria::ASC)
  * @method BattlePrizeQuery orderByPrizeId($order = Criteria::ASC)
  * @method BattlePrizeQuery orderByPrizeType($order = Criteria::ASC)
  * @method BattlePrizeQuery orderByValue($order = Criteria::ASC)
  * @method BattlePrizeQuery orderByStatus($order = Criteria::ASC)
  * @method BattlePrizeQuery orderByChanged($order = Criteria::ASC)
  * @method BattlePrizeQuery withBattle($params = [])
  * @method BattlePrizeQuery joinWithBattle($params = null, $joinType = 'LEFT JOIN')
  * @method BattlePrizeQuery withUser($params = [])
  * @method BattlePrizeQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseBattlePrizeQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\BattlePrize[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\BattlePrize|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\BattlePrizeQuery     */
    public static function model()
    {
        return new \models\BattlePrizeQuery(\models\BattlePrize::class);
    }
}
