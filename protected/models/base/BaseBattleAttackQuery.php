<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\BattleAttackQuery;

/**
 * This is the ActiveQuery class for [[models\BattleAttack]].
 * @method BattleAttackQuery filterByBattleAttackId($value, $criteria = null)
 * @method BattleAttackQuery filterByBattleId($value, $criteria = null)
 * @method BattleAttackQuery filterByFromUserId($value, $criteria = null)
 * @method BattleAttackQuery filterByToUserId($value, $criteria = null)
 * @method BattleAttackQuery filterByStep($value, $criteria = null)
 * @method BattleAttackQuery filterByText($value, $criteria = null)
 * @method BattleAttackQuery filterByPower($value, $criteria = null)
 * @method BattleAttackQuery filterByStatus($value, $criteria = null)
 * @method BattleAttackQuery filterByChanged($value, $criteria = null)
  * @method BattleAttackQuery orderByBattleAttackId($order = Criteria::ASC)
  * @method BattleAttackQuery orderByBattleId($order = Criteria::ASC)
  * @method BattleAttackQuery orderByFromUserId($order = Criteria::ASC)
  * @method BattleAttackQuery orderByToUserId($order = Criteria::ASC)
  * @method BattleAttackQuery orderByStep($order = Criteria::ASC)
  * @method BattleAttackQuery orderByText($order = Criteria::ASC)
  * @method BattleAttackQuery orderByPower($order = Criteria::ASC)
  * @method BattleAttackQuery orderByStatus($order = Criteria::ASC)
  * @method BattleAttackQuery orderByChanged($order = Criteria::ASC)
  * @method BattleAttackQuery withBattle($params = [])
  * @method BattleAttackQuery joinWithBattle($params = null, $joinType = 'LEFT JOIN')
  * @method BattleAttackQuery withFromUser($params = [])
  * @method BattleAttackQuery joinWithFromUser($params = null, $joinType = 'LEFT JOIN')
  * @method BattleAttackQuery withToUser($params = [])
  * @method BattleAttackQuery joinWithToUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseBattleAttackQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\BattleAttack[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\BattleAttack|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\BattleAttackQuery     */
    public static function model()
    {
        return new \models\BattleAttackQuery(\models\BattleAttack::class);
    }
}
