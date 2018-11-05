<?php

namespace models\base;
use ActiveGenerator\Criteria;
use models\FriendQuery;

/**
 * This is the ActiveQuery class for [[models\Friend]].
 * @method FriendQuery filterByFriendId($value, $criteria = null)
 * @method FriendQuery filterByFirstUserId($value, $criteria = null)
 * @method FriendQuery filterBySecondUserId($value, $criteria = null)
 * @method FriendQuery filterByType($value, $criteria = null)
 * @method FriendQuery filterByIsConfirmed($value, $criteria = null)
 * @method FriendQuery filterByStatus($value, $criteria = null)
 * @method FriendQuery filterByChanged($value, $criteria = null)
  * @method FriendQuery orderByFriendId($order = Criteria::ASC)
  * @method FriendQuery orderByFirstUserId($order = Criteria::ASC)
  * @method FriendQuery orderBySecondUserId($order = Criteria::ASC)
  * @method FriendQuery orderByType($order = Criteria::ASC)
  * @method FriendQuery orderByIsConfirmed($order = Criteria::ASC)
  * @method FriendQuery orderByStatus($order = Criteria::ASC)
  * @method FriendQuery orderByChanged($order = Criteria::ASC)
  * @method FriendQuery withFirstUser($params = [])
  * @method FriendQuery joinWithFirstUser($params = null, $joinType = 'LEFT JOIN')
  * @method FriendQuery withSecondUser($params = [])
  * @method FriendQuery joinWithSecondUser($params = null, $joinType = 'LEFT JOIN')
 */
class BaseFriendQuery extends \yii\db\ActiveQuery
{


    use \ActiveGenerator\base\RichActiveMethods;

    /**
     * @inheritdoc
     * @return \models\Friend[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \models\Friend|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \models\FriendQuery     */
    public static function model()
    {
        return new \models\FriendQuery(\models\Friend::class);
    }
}
