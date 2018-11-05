<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\BattleQuery;

/**
 * This is the ActiveQuery class for [[models\Battle]].
 * @method BattleQuery filterByBattleId($value, $criteria = null)
 * @method BattleQuery filterByWinSide($value, $criteria = null)
 * @method BattleQuery filterByHash($value, $criteria = null)
 * @method BattleQuery filterByStatus($value, $criteria = null)
 * @method BattleQuery filterByChanged($value, $criteria = null)
  * @method BattleQuery orderByBattleId($order = Criteria::ASC)
  * @method BattleQuery orderByWinSide($order = Criteria::ASC)
  * @method BattleQuery orderByHash($order = Criteria::ASC)
  * @method BattleQuery orderByStatus($order = Criteria::ASC)
  * @method BattleQuery orderByChanged($order = Criteria::ASC)
  * @method BattleQuery withBattleArmies($params = [])
  * @method BattleQuery joinWithBattleArmies($params = null, $joinType = 'LEFT JOIN')
  * @method BattleQuery withBattleAttacks($params = [])
  * @method BattleQuery joinWithBattleAttacks($params = null, $joinType = 'LEFT JOIN')
  * @method BattleQuery withBattlePrizes($params = [])
  * @method BattleQuery joinWithBattlePrizes($params = null, $joinType = 'LEFT JOIN')
  * @method BattleQuery withBattleUsers($params = [])
  * @method BattleQuery joinWithBattleUsers($params = null, $joinType = 'LEFT JOIN')
 */
class BaseBattleQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Battle[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Battle|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\BattleQuery     */
    public static function model()
    {
        return new \models\BattleQuery(\models\Battle::class);
    }
}
