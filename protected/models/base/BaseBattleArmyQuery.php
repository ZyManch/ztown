<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\BattleArmyQuery;

/**
 * This is the ActiveQuery class for [[models\BattleArmy]].
 * @method BattleArmyQuery filterByBattleArmyId($value, $criteria = null)
 * @method BattleArmyQuery filterByParentId($value, $criteria = null)
 * @method BattleArmyQuery filterByBattleId($value, $criteria = null)
 * @method BattleArmyQuery filterByStat($value, $criteria = null)
 * @method BattleArmyQuery filterByName($value, $criteria = null)
 * @method BattleArmyQuery filterByStatus($value, $criteria = null)
 * @method BattleArmyQuery filterByChanged($value, $criteria = null)
  * @method BattleArmyQuery orderByBattleArmyId($order = Criteria::ASC)
  * @method BattleArmyQuery orderByParentId($order = Criteria::ASC)
  * @method BattleArmyQuery orderByBattleId($order = Criteria::ASC)
  * @method BattleArmyQuery orderByStat($order = Criteria::ASC)
  * @method BattleArmyQuery orderByName($order = Criteria::ASC)
  * @method BattleArmyQuery orderByStatus($order = Criteria::ASC)
  * @method BattleArmyQuery orderByChanged($order = Criteria::ASC)
  * @method BattleArmyQuery withBattle($params = [])
  * @method BattleArmyQuery joinWithBattle($params = null, $joinType = 'LEFT JOIN')
 */
class BaseBattleArmyQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\BattleArmy[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\BattleArmy|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\BattleArmyQuery     */
    public static function model()
    {
        return new \models\BattleArmyQuery(\models\BattleArmy::class);
    }
}
