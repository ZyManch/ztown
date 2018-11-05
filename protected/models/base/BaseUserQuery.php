<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\UserQuery;

/**
 * This is the ActiveQuery class for [[models\User]].
 * @method UserQuery filterByUserId($value, $criteria = null)
 * @method UserQuery filterByEmail($value, $criteria = null)
 * @method UserQuery filterByLogin($value, $criteria = null)
 * @method UserQuery filterByPassword($value, $criteria = null)
 * @method UserQuery filterByFirstName($value, $criteria = null)
 * @method UserQuery filterByLastName($value, $criteria = null)
 * @method UserQuery filterByGroupInfo($value, $criteria = null)
 * @method UserQuery filterByAvatar($value, $criteria = null)
 * @method UserQuery filterByLang($value, $criteria = null)
 * @method UserQuery filterByAccess($value, $criteria = null)
 * @method UserQuery filterByInfo($value, $criteria = null)
 * @method UserQuery filterBySex($value, $criteria = null)
 * @method UserQuery filterByGroupId($value, $criteria = null)
 * @method UserQuery filterByStatId($value, $criteria = null)
 * @method UserQuery filterByLevel($value, $criteria = null)
 * @method UserQuery filterByExp($value, $criteria = null)
 * @method UserQuery filterByX($value, $criteria = null)
 * @method UserQuery filterByY($value, $criteria = null)
 * @method UserQuery filterByLastVisit($value, $criteria = null)
 * @method UserQuery filterByLastCount($value, $criteria = null)
 * @method UserQuery filterByPageLoaded($value, $criteria = null)
 * @method UserQuery filterByEnergy($value, $criteria = null)
 * @method UserQuery filterByEnergyMax($value, $criteria = null)
 * @method UserQuery filterByEnergyDate($value, $criteria = null)
 * @method UserQuery filterByUrlFixed($value, $criteria = null)
 * @method UserQuery filterByUrlCount($value, $criteria = null)
 * @method UserQuery filterByStatus($value, $criteria = null)
 * @method UserQuery filterByChanged($value, $criteria = null)
  * @method UserQuery orderByUserId($order = Criteria::ASC)
  * @method UserQuery orderByEmail($order = Criteria::ASC)
  * @method UserQuery orderByLogin($order = Criteria::ASC)
  * @method UserQuery orderByPassword($order = Criteria::ASC)
  * @method UserQuery orderByFirstName($order = Criteria::ASC)
  * @method UserQuery orderByLastName($order = Criteria::ASC)
  * @method UserQuery orderByGroupInfo($order = Criteria::ASC)
  * @method UserQuery orderByAvatar($order = Criteria::ASC)
  * @method UserQuery orderByLang($order = Criteria::ASC)
  * @method UserQuery orderByAccess($order = Criteria::ASC)
  * @method UserQuery orderByInfo($order = Criteria::ASC)
  * @method UserQuery orderBySex($order = Criteria::ASC)
  * @method UserQuery orderByGroupId($order = Criteria::ASC)
  * @method UserQuery orderByStatId($order = Criteria::ASC)
  * @method UserQuery orderByLevel($order = Criteria::ASC)
  * @method UserQuery orderByExp($order = Criteria::ASC)
  * @method UserQuery orderByX($order = Criteria::ASC)
  * @method UserQuery orderByY($order = Criteria::ASC)
  * @method UserQuery orderByLastVisit($order = Criteria::ASC)
  * @method UserQuery orderByLastCount($order = Criteria::ASC)
  * @method UserQuery orderByPageLoaded($order = Criteria::ASC)
  * @method UserQuery orderByEnergy($order = Criteria::ASC)
  * @method UserQuery orderByEnergyMax($order = Criteria::ASC)
  * @method UserQuery orderByEnergyDate($order = Criteria::ASC)
  * @method UserQuery orderByUrlFixed($order = Criteria::ASC)
  * @method UserQuery orderByUrlCount($order = Criteria::ASC)
  * @method UserQuery orderByStatus($order = Criteria::ASC)
  * @method UserQuery orderByChanged($order = Criteria::ASC)
  * @method UserQuery withArenas($params = [])
  * @method UserQuery joinWithArenas($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withBattleAttacks($params = [])
  * @method UserQuery joinWithBattleAttacks($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withBattleAttacks0($params = [])
  * @method UserQuery joinWithBattleAttacks0($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withBattlePrizes($params = [])
  * @method UserQuery joinWithBattlePrizes($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withBattleUsers($params = [])
  * @method UserQuery joinWithBattleUsers($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withErrors($params = [])
  * @method UserQuery joinWithErrors($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withForums($params = [])
  * @method UserQuery joinWithForums($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withFriends($params = [])
  * @method UserQuery joinWithFriends($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withFriends0($params = [])
  * @method UserQuery joinWithFriends0($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withGroupQueries($params = [])
  * @method UserQuery joinWithGroupQueries($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withGroupQueries0($params = [])
  * @method UserQuery joinWithGroupQueries0($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withHouses($params = [])
  * @method UserQuery joinWithHouses($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withItemBuieds($params = [])
  * @method UserQuery joinWithItemBuieds($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withItemOpeneds($params = [])
  * @method UserQuery joinWithItemOpeneds($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withMafiaInfos($params = [])
  * @method UserQuery joinWithMafiaInfos($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withMaps($params = [])
  * @method UserQuery joinWithMaps($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withMaps0($params = [])
  * @method UserQuery joinWithMaps0($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withMessages($params = [])
  * @method UserQuery joinWithMessages($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withMessages0($params = [])
  * @method UserQuery joinWithMessages0($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withMoneys($params = [])
  * @method UserQuery joinWithMoneys($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withOauths($params = [])
  * @method UserQuery joinWithOauths($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withReports($params = [])
  * @method UserQuery joinWithReports($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withReports0($params = [])
  * @method UserQuery joinWithReports0($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withTopics($params = [])
  * @method UserQuery joinWithTopics($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withGroup($params = [])
  * @method UserQuery joinWithGroup($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withStat($params = [])
  * @method UserQuery joinWithStat($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withUserAnimals($params = [])
  * @method UserQuery joinWithUserAnimals($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withUserCanChangeNames($params = [])
  * @method UserQuery joinWithUserCanChangeNames($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withUserIncomes($params = [])
  * @method UserQuery joinWithUserIncomes($params = null, $joinType = 'LEFT JOIN')
  * @method UserQuery withUserViewPages($params = [])
  * @method UserQuery joinWithUserViewPages($params = null, $joinType = 'LEFT JOIN')
 */
class BaseUserQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\UserQuery     */
    public static function model()
    {
        return new \models\UserQuery(\models\User::class);
    }
}
