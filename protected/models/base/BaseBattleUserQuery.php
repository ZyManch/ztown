<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\BattleUserQuery;

/**
 * This is the ActiveQuery class for [[models\BattleUser]].
 * @method BattleUserQuery filterByBattleUserId($value, $criteria = null)
 * @method BattleUserQuery filterByBattleId($value, $criteria = null)
 * @method BattleUserQuery filterByUserId($value, $criteria = null)
 * @method BattleUserQuery filterByStatId($value, $criteria = null)
 * @method BattleUserQuery filterBySide($value, $criteria = null)
 * @method BattleUserQuery filterByStatus($value, $criteria = null)
 * @method BattleUserQuery filterByChanged($value, $criteria = null)
  * @method BattleUserQuery orderByBattleUserId($order = Criteria::ASC)
  * @method BattleUserQuery orderByBattleId($order = Criteria::ASC)
  * @method BattleUserQuery orderByUserId($order = Criteria::ASC)
  * @method BattleUserQuery orderByStatId($order = Criteria::ASC)
  * @method BattleUserQuery orderBySide($order = Criteria::ASC)
  * @method BattleUserQuery orderByStatus($order = Criteria::ASC)
  * @method BattleUserQuery orderByChanged($order = Criteria::ASC)
  * @method BattleUserQuery withBattle($params = [])
  * @method BattleUserQuery joinWithBattle($params = null, $joinType = 'LEFT JOIN')
  * @method BattleUserQuery withStat($params = [])
  * @method BattleUserQuery joinWithStat($params = null, $joinType = 'LEFT JOIN')
  * @method BattleUserQuery withUser($params = [])
  * @method BattleUserQuery joinWithUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseBattleUserQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\BattleUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\BattleUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\BattleUserQuery     */
    public static function model()
    {
        return new \models\BattleUserQuery(\models\BattleUser::class);
    }
}
