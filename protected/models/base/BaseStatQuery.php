<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\StatQuery;

/**
 * This is the ActiveQuery class for [[models\Stat]].
 * @method StatQuery filterByStatId($value, $criteria = null)
 * @method StatQuery filterByStat1($value, $criteria = null)
 * @method StatQuery filterByStat2($value, $criteria = null)
 * @method StatQuery filterByStat3($value, $criteria = null)
 * @method StatQuery filterByStat4($value, $criteria = null)
 * @method StatQuery filterByStat5($value, $criteria = null)
 * @method StatQuery filterByStat6($value, $criteria = null)
 * @method StatQuery filterByBonus1($value, $criteria = null)
 * @method StatQuery filterByBonus2($value, $criteria = null)
 * @method StatQuery filterByBonus3($value, $criteria = null)
 * @method StatQuery filterByBonus4($value, $criteria = null)
 * @method StatQuery filterByBonus5($value, $criteria = null)
 * @method StatQuery filterByBonus6($value, $criteria = null)
 * @method StatQuery filterByStatus($value, $criteria = null)
 * @method StatQuery filterByChanged($value, $criteria = null)
  * @method StatQuery orderByStatId($order = Criteria::ASC)
  * @method StatQuery orderByStat1($order = Criteria::ASC)
  * @method StatQuery orderByStat2($order = Criteria::ASC)
  * @method StatQuery orderByStat3($order = Criteria::ASC)
  * @method StatQuery orderByStat4($order = Criteria::ASC)
  * @method StatQuery orderByStat5($order = Criteria::ASC)
  * @method StatQuery orderByStat6($order = Criteria::ASC)
  * @method StatQuery orderByBonus1($order = Criteria::ASC)
  * @method StatQuery orderByBonus2($order = Criteria::ASC)
  * @method StatQuery orderByBonus3($order = Criteria::ASC)
  * @method StatQuery orderByBonus4($order = Criteria::ASC)
  * @method StatQuery orderByBonus5($order = Criteria::ASC)
  * @method StatQuery orderByBonus6($order = Criteria::ASC)
  * @method StatQuery orderByStatus($order = Criteria::ASC)
  * @method StatQuery orderByChanged($order = Criteria::ASC)
  * @method StatQuery withAnimals($params = [])
  * @method StatQuery joinWithAnimals($params = null, $joinType = 'LEFT JOIN')
  * @method StatQuery withBattleUsers($params = [])
  * @method StatQuery joinWithBattleUsers($params = null, $joinType = 'LEFT JOIN')
  * @method StatQuery withItems($params = [])
  * @method StatQuery joinWithItems($params = null, $joinType = 'LEFT JOIN')
  * @method StatQuery withItemBuieds($params = [])
  * @method StatQuery joinWithItemBuieds($params = null, $joinType = 'LEFT JOIN')
  * @method StatQuery withUsers($params = [])
  * @method StatQuery joinWithUsers($params = null, $joinType = 'LEFT JOIN')
  * @method StatQuery withUserAnimals($params = [])
  * @method StatQuery joinWithUserAnimals($params = null, $joinType = 'LEFT JOIN')
 */
class BaseStatQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Stat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Stat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\StatQuery     */
    public static function model()
    {
        return new \models\StatQuery(\models\Stat::class);
    }
}
